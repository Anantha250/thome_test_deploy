<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Privilege;
use App\Models\PrivilegeTranslation;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DOMDocument;

class PrivilegeController extends Controller
{
    static public function get_latest_privileges($count = 5, $except_id = null)
    {
        $privileges = Privilege::orderBy("created_at", "desc")->where('id', '!=', $except_id)->take($count)->get();

        foreach ($privileges as $privilege) {
            $privilege->translation = $privilege->translation();
        }
        return $privileges;
    }


    function index(Request $request)
    {
        $query = Privilege::query();

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->whereHas('translations', function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm);
            });
        }

        $privileges = $query->paginate(9)->appends($request->except('page'));

        foreach ($privileges as $privilege) {
            $privilege->translation = $privilege->translation();
        }

        return view('home.privilege.index', compact('privileges'));
    }

    public function show(Request $request)
    {
        $news_id = $request->news_id;
        $privilege = Privilege::where('id', $news_id)->firstOrFail();

        $privilege->translation = $privilege->translation();
        $privilege->hashtags = $privilege->hashtagTranslation();

        $latest_privileges = $this->get_latest_privileges(3, $privilege->id);

        $related_privileges = [];
        // foreach ($privilege->privilegeTags as $tag) {
        //     $related_privileges = array_unique(
        //         array_merge(
        //             $related_privileges,
        //             $tag->privileges->where('id', '!=', $privilege->id)->all()
        //         )
        //     );
        // }

        // Get 3 random related privileges
        // $related_privileges = collect($related_privileges)->unique('id')->shuffle()->take(3)->values();
        // foreach ($related_privileges as $related_privilege) {
        //     $related_privilege->translation = $related_privilege->translation();
        // }

        return view('home.privilege.show_privilege', compact('privilege', 'latest_privileges', 'related_privileges'));
    }


    ////////////////////
    // admin
    function manage(Request $request)
    {
        $query = Privilege::query();

        $query->whereHas('translations');

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%'; // กำหนดตัวแปรสำหรับคำค้นหา

            $query->whereHas('translations', function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm);
            });
        }

        $privileges = $query->paginate(8)->appends($request->except('page'));

        foreach ($privileges as $privilege) {
            $privilege->translation = $privilege->translation();
            // $privilege->hashtags = $privilege->hashtagTranslation;
            $availablelang = [];
            foreach ($privilege->translations as $translation) {
                $availablelang[] = $translation->locale;
            }
            $privilege->availablelang = $availablelang;
        }

        return view('admin.privilege.manage', compact('privileges'));
    }

    function delete($id)
    {
        try {
            $privilege = Privilege::findOrFail($id);
            $privilege->delete();
            return response()->json(['message' => 'Privilege deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Privilege not found.'], 404);
        }
    }

    public function create_view()
    {
        return view('admin.privilege.create');
    }

    // ok
    public function create_store(Request $request)
    {
        try {

            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'coverPageImg' => 'required',
                'hashtags' => 'required|array',
            ]);

            $privilege = Privilege::create();

            $folderName = 'privilege/' . $privilege->folder_id . '/';
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


            $privilege->translations()->create([
                'locale' => 'th',
                'title' => $request["title"],
                'content' => $updatedContent,
                'coverPageImg' => $updateCoverPage,
            ]);

            $privilege->hashtags = (array) $request->hashtags;
            $privilege->save();
            // return response()->json(['message' => 'Privilege created successfully.'], 500);
            return response()->json(['message' => 'Privilege created successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating Privilege: ' . $e->getMessage()], 500);
        }
    }

    public function edit_view($id, Request $request)
    {
        $lang = $request->lang;

        $privilege = Privilege::where('id', $id)->firstOrFail();
        $privilege->translation = $privilege->translation($lang);

        return view('admin.privilege.create', compact('privilege'));
    }

    public function edit_store(Request $request, $id)
    {
        $privilege = Privilege::where('id', $id)->first();
        try {
            $folderName = "privilege/$privilege->folder_id/";
            $newCoverName = basename($request->coverPageImg);
            $oldCoverPage = $privilege->translation($request->lang)->coverPageImg;
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


            $oldContent = $privilege->translation($request->lang)->content;
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

            $privilege->translation($request->lang)->update([
                'title' => $request["title"],
                'content' => $updatedContent,
                'coverPageImg' => $updateCoverPage
            ]);

            $privilege->hashtags = $request['hashtags'];
            $privilege->save();

            return response()->json(['message' => 'Privilege update successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating FAQ: ' . $e->getMessage()], 500);
        }
    }

    public function add_lang_view($id, Request $request)
    {
        $lang = $request->lang;

        $privilege = Privilege::where('id', $id)->firstOrFail();
        $privilege->translation = $privilege->translation();


        return view('admin.privilege.create', compact('privilege'));
    }

    public function add_lang_store(Request $request, $id)
    {
        try {
            $privilege = Privilege::where('id', $id)->first();

            $folderName = 'privilege/' . $privilege->folder_id . '/';
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


            $privilege->translations()->create([
                'locale' => $request->lang,
                'title' => $request["title"],
                'content' => $updatedContent,
                'coverPageImg' => $updateCoverPage,
            ]);

            return response()->json(['message' => 'Privilege add lang successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating Privilege: ' . $e->getMessage()], 500);
        }
    }

    function edit_id(Request $request, $id)
    {
        try {
            $change_id = $request->change_id;

            $isAvailable = Privilege::where('id', $change_id)->exists();
            if ($isAvailable) {
                return response()->json(['message' => 'id already used'], 400);
            }
            $tag = Privilege::findOrFail($id);
            $tag->update(['id' => $change_id]);
            return response()->json(['message' => 'ID updated successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating tag ID: ' . $e->getMessage()], 500);
        }
    }
}
