<?php

namespace App\Http\Controllers;

use App\Models\ReviewHome;
use App\Models\ReviewHomeProject;
use App\Models\ReviewHomeTranslation;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DOMDocument;

class ReviewHomeController extends Controller
{
    static public function get_latest_houses($count = 5, $except_id = null)
    {
        $houses = ReviewHome::orderBy("created_at", "desc")->where('id', '!=', $except_id)->take($count)->get();

        foreach ($houses as $house) {
            $house->translation = $house->translation();
            $house->project = $house->reviewHomeProject->translation();
        }
        return $houses;
    }

    function index(Request $request)
    {
        $query = ReviewHome::query();
        $projects = ReviewHomeProject::all();

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->whereHas('translations', function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm);
            });
        }

        if ($request->filled('project')) {
            $query->whereHas('reviewHomeProject', function ($q) use ($request) {
                $q->where('locale', 'like', '%' . $request->project . '%');
            });
        }

        $houses = $query->paginate(9)->appends($request->except('page'));

        foreach ($houses as $house) {
            $house->translation = $house->translation();
            $house->project = $house->reviewHomeProject->translation();
        }

        foreach ($projects as $project) {
            $project->translation = $project->translation();
        }

        return view('home.review_home.index', compact('houses', 'projects'));
    }
    public function show(Request $request)
    {
        $news_id = $request->news_id;
        $house = ReviewHome::where('id', $news_id)->firstOrFail();

        $house->translation = $house->translation();
        $house->project = $house->reviewHomeProject->translation();
        $house->hashtags = $house->reviewHomeHashtags->translation();

        $latest_reviews = $this->get_latest_houses(3, $house->id);

        $related_reviews = $house->reviewHomeProject->reviewHomes->where('id', '!=', $house->id)->take(3)->values();
        foreach ($related_reviews as $related_review) {
            $related_review->translation = $related_review->translation();
        }


        return view('home.review_home.show_review_home', compact('house', 'related_reviews', 'latest_reviews'));
    }


    ////////////////////
    // admin
    function manage(Request $request)
    {
        $query = ReviewHome::query();
        $projects = ReviewHomeProject::all();

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%'; // กำหนดตัวแปรสำหรับคำค้นหา

            $query->whereHas('translations', function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm);
            });
        }

        if ($request->filled('project')) {
            $query->where('project_id', $request->project);
        }

        $houses = $query->paginate(8)->appends($request->except('page'));

        foreach ($houses as $house) {
            $house->translation = $house->translation();
            $house->project = $house->reviewHomeProject->translation();
            // dd($house->project);
            $availablelang = [];
            foreach ($house->translations as $translation) {
                $availablelang[] = $translation->locale;
            }
            $house->availablelang = $availablelang;
        }

        foreach ($projects as $project) {
            $project->translation = $project->translation();
            $project->th = $project->translation('th');
            $project->en = $project->translation('en');
            if ($project->hasTranslation('cn')) {
                $project->cn = $project->translation('cn');
            }
        }
        return view('admin.review_home.manage', compact('houses', 'projects'));
    }

    function delete($id)
    {
        try {
            $house = ReviewHome::findOrFail($id);
            $house->delete();
            return response()->json(['message' => 'ReviewHome deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['message' => 'ReviewHome not found.'], 404);
        }
    }

    public function create_view()
    {
        $projects = ReviewHomeProject::all();
        foreach ($projects as $project) {
            $project->translation = $project->translation();
        }
        return view('admin.review_home.create', compact('projects'));
    }

    // ok
    public function create_store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'coverPageImg' => 'required',
                'project' => 'required',
                'hashtags' => 'required|array',
            ]);

            $project = ReviewHomeProject::where('id', $request['project'])->first();
            if (!$project->exists()) {
                return response()->json(['message' => 'Project not found.'], 404);
            }

            $house = $project->reviewHomes()->create();

            $folderName = 'review_home/' . $house->folder_id . '/';
            $tempCoverName = basename($request->coverPageImg);
            $updateCoverPage = "";

            if (Storage::exists('public/temp_uploads/' . $tempCoverName)) {
                $updateCoverPage = "/storage" . "/" . $folderName . $tempCoverName;
                Storage::move('public/temp_uploads/' . $tempCoverName, 'public/' . $folderName . $tempCoverName);
            }

            $content = $request->input('content');

            $doc = new DOMDocument();
            @$doc->loadHTML('<?xml encoding="utf-8" ?>' . $content);
            $images = $doc->getElementsByTagName('img');

            foreach ($images as $img) {
                $currentSrc = $img->getAttribute('src');
                $tempFileName = basename($currentSrc);
                $newPath = $folderName . $tempFileName;

                if (Str::startsWith($currentSrc, '/storage/temp_uploads/' == false)) {
                    continue;
                }
                if (Storage::exists('public/temp_uploads/' . $tempFileName)) {
                    Storage::move('public/temp_uploads/' . $tempFileName, 'public/' . $newPath);
                    $img->setAttribute('src', '/storage' . '/' . $newPath);
                }
            }
            $updatedContent = $doc->saveHTML();


            $house->translations()->create([
                'locale' => 'th',
                'title' => $request["title"],
                'content' => $updatedContent,
                'coverPageImg' => $updateCoverPage,
            ]);

            $house->reviewHomeHashtags()->create([
                'locale' => $request['hashtags'],
            ]);
            return response()->json(['message' => 'ReviewHome created successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating ReviewHome: ' . $e->getMessage()], 500);
        }
    }

    public function edit_view($id, Request $request)
    {
        $lang = $request->lang;

        $house = ReviewHome::where('id', $id)->firstOrFail();
        $house->translation = $house->translation($lang);
        $house->project = $house->reviewHomeProject->translation();

        // $house->hashprojects = $house->houseHashTagsTranslation;
        $house->hashtags = $house->reviewHomeHashtags->locale;

        $projects = ReviewHomeProject::all();
        foreach ($projects as $project) {
            $project->translation = $project->translation();
        }

        return view('admin.review_home.create', compact('house', 'projects'));
    }

    public function edit_store(Request $request, $id)
    {
        $house = ReviewHome::where('id', $id)->first();
        try {
            $project = ReviewHomeProject::where('id', $request['project'])->first();
            if (!$project) {
                return response()->json(['message' => 'Project not found.'], 404);
            }

            $folderName = "review_home/$house->folder_id/";
            $newCoverName = basename($request->coverPageImg);
            $oldCoverPage = $house->translation($request->lang)->coverPageImg;
            $updateCoverPage = $oldCoverPage;

            if (Storage::exists('public/temp_uploads/' . $newCoverName)) {
                if ($newCoverName != basename($oldCoverPage)) {
                    $updateCoverPage = "/storage/$folderName/$newCoverName";
                    Storage::move("public/temp_uploads/$newCoverName", "public/$folderName/$newCoverName");
                    Storage::delete(Str::replaceFirst('/storage', 'public', $oldCoverPage));
                } else {
                    Storage::delete("public/temp_uploads/$newCoverName");
                }
            }

            $content = $request->input('content');
            $doc = new DOMDocument();
            @$doc->loadHTML('<?xml encoding="utf-8" ?>' . $content);
            $images = $doc->getElementsByTagName('img');
            $newImgUse = [];

            foreach ($images as $img) {
                $currentSrc = $img->getAttribute('src');
                $newFileName = basename($currentSrc);
                $newPath = $folderName . $newFileName;

                if (Str::startsWith($currentSrc, '/storage/temp_uploads/') && (Storage::exists('public/temp_uploads/' . $newFileName))) {
                    Storage::move('public/temp_uploads/' . $newFileName, 'public/' . $newPath);
                    $img->setAttribute('src', '/storage' . '/' . $newPath);
                }
                $newImgUse[] = basename($img->getAttribute('src'));
            }
            $updatedContent = $doc->saveHTML();


            $oldContent = $house->translation($request->lang)->content;
            $oldDoc = new DOMDocument();
            @$oldDoc->loadHTML('<?xml encoding="utf-8" ?>' . $oldContent);
            $oldImages = $oldDoc->getElementsByTagName('img');

            foreach ($oldImages as $oldImg) {
                $oldSrc = $oldImg->getAttribute('src');
                $oldName = basename($oldSrc);

                if (!in_array($oldName, $newImgUse)) {
                    if (Storage::exists("public/$folderName$oldName")) {
                        Storage::delete("public/$folderName$oldName");
                    }
                }
            }

            $house->translation($request->lang)->update([
                'title' => $request["title"],
                'content' => $updatedContent,
                'coverPageImg' => $updateCoverPage
            ]);



            $house->reviewHomeProject()->associate($project);
            $house->reviewHomeHashtags()->update(['locale' => $request['hashtags']]);
            $house->save();
            return response()->json(['message' => 'ReviewHome update successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating FAQ: ' . $e->getMessage()], 500);
        }
    }

    public function add_lang_view($id, Request $request)
    {
        $lang = $request->lang;

        $house = ReviewHome::where('id', $id)->firstOrFail();
        $house->translation = $house->translation();

        $projects = ReviewHomeProject::all();
        foreach ($projects as $project) {
            $project->translation = $project->translation();
        }

        return view('admin.review_home.create', compact('house', 'projects'));
    }

    public function add_lang_store(Request $request, $id)
    {
        try {
            $house = ReviewHome::where('id', $id)->first();

            $folderName = 'review_home/' . $house->folder_id . '/';
            $tempFileName = basename($request->coverPageImg);
            $updateCoverPage = "";

            if (Storage::exists('public/temp_uploads/' . $tempFileName)) {
                $updateCoverPage = "/storage" . "/" . $folderName . $tempFileName;
                Storage::move('public/temp_uploads/' . $tempFileName, 'public/' . $folderName . $tempFileName);
            }

            $content = $request->input('content');

            $doc = new DOMDocument();
            @$doc->loadHTML('<?xml encoding="utf-8" ?>' . $content);
            $images = $doc->getElementsByTagName('img');

            foreach ($images as $img) {
                $currentSrc = $img->getAttribute('src');
                $tempFileName = basename($currentSrc);
                $newPath = $folderName . $tempFileName;

                if (Str::startsWith($currentSrc, '/storage/temp_uploads/' == false)) {
                    continue;
                }
                if (Storage::exists('public/temp_uploads/' . $tempFileName)) {
                    Storage::move('public/temp_uploads/' . $tempFileName, 'public/' . $newPath);
                    $img->setAttribute('src', '/storage' . '/' . $newPath);
                }
            }
            $updatedContent = $doc->saveHTML();


            $house->translations()->create([
                'locale' => $request->lang,
                'title' => $request["title"],
                'content' => $updatedContent,
                'coverPageImg' => $updateCoverPage,
            ]);
            return response()->json(['message' => 'ReviewHome add lang successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating FAQ: ' . $e->getMessage()], 500);
        }
    }

    function create_project(Request $request)
    {
        try {
            $project = ReviewHomeProject::create([
                'locale' => ['en' => '', 'th' => '']
            ]);

            // typeof locale
            // In PHP, you can use gettype() to check the type
            // Example: gettype($project->locale)

            $locales = $project->locale;
            // return response()->json(['type' => gettype($locales)], 400);
            // return response()->json(['message' => 'Project '], 400);
            // return response()->json(['error' => 'ok'], 500);
            foreach ($request->all() as $lang => $name) {
                $locales[$lang] = $name;
            }

            $project->locale = $locales;
            $project->save();

            return response()->json($request, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'request' => $request->all()], 500);
        }
    }

    function edit_project(Request $request)
    {
        try {
            // return response()->json(['message' => $request['locale']], 400);
            $request->validate([
                'locale' => 'required|string|max:5',
                'name' => 'required|string',
            ]);

            $project = ReviewHomeProject::findOrFail($request->id);
            if (!$project) {
                return response()->json(['message' => 'Tag not found.'], 404);
            }
            $locales = $project['locale'];
            $locales[$request->locale] = $request->name;
            $project->locale = $locales;
            $project->save();
            return response()->json(['message' => 'Tag created successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating project: ' . $e->getMessage()], 500);
        }
    }

    function delete_project($id)
    {
        try {
            $project = ReviewHomeProject::findOrFail($id);
            $project->delete();
            return response()->json(['message' => 'Tag deleted successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error deleting project: ' . $e->getMessage()], 500);
        }
    }

    function edit_id(Request $request, $id)
    {
        try {
            $change_id = $request->change_id;

            $isAvailable = ReviewHome::where('id', $change_id)->exists();
            if ($isAvailable) {
                return response()->json(['message' => 'id already used'], 400);
            }
            $tag = ReviewHome::findOrFail($id);
            $tag->update(['id' => $change_id]);
            return response()->json(['message' => 'ID updated successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating tag ID: ' . $e->getMessage()], 500);
        }
    }
}
