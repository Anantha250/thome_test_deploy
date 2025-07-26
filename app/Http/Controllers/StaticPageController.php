<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageVariable;
use Illuminate\Support\Facades\Redirect;
use App\Models\Pastwork;
use App\Models\PastWorkTag;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StaticPageController extends Controller
{
    //
    protected $projectPath = ['hinspector', 'hinterior', 'hconstruction', 'hbutler', 'other'];

    public function index()
    {
        return view('admin.static_page.index');
    }

    public function home()
    {
        $page = PageVariable::where('page', 'home')->first();
        $page = $page ? $page->var : [];
        return view(
            'admin.static_page.home',
            [
                'dev' => $page['dev'],
                'project' => $page['project'],
                'house' => $page['house'],
                'satisfaction' => $page['satisfaction']
            ]
        );
    }

    public function home_store()
    {
        $page = PageVariable::where("page", "home")->first();
        $page->var = [
            'dev' => request('dev', ''),
            'project' => request('project', ''),
            'house' => request('house', ''),
            'satisfaction' => request('satisfaction', '')
        ];
        $page->save();
        return Redirect::back()->with('status', 'Variables updated');
        // return redirect()->back()->with('success', 'Variables updated');
        // return Redirect::route('profile.edit')->with('status', 'profile-updated')
    }



    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // project
    public function manage_project($pageName, Request $request)
    {
        if (!in_array($pageName, $this->projectPath)) {
            return redirect()->back()->with('error', 'Invalid project path');
        }

        $query = Pastwork::query();
        $tags = PastworkTag::where('page', '=', $pageName)->get();

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->whereHas('translations', function ($q) use ($searchTerm) {
                $q->where('question', 'like', $searchTerm)
                    ->orWhere('answer', 'like', $searchTerm);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('PastWorkTag', function ($q) use ($request) {
                $q->where('past_work_tag_id', $request->tag);
            });
        }

        if ($request->has('page') && $request->page > $articles = $query->paginate(9)->lastPage()) {
            return redirect()->route('admin.static_page.manage_project', array_merge($request->except('page'), ['page' => 1]));
        }

        $projects = $query->paginate(8)->appends($request->except('page'));

        foreach ($projects as $project) {
            $project->translation = $project->translation();
            $translations = [];
            $translations[] = [
                'locale' => 'th',
                'title' => $project->translation('th')['title'],
                'detail' => $project->translation('th')['detail']
            ];
            if (isset($project->title['en'])) {
                $translations[] = [
                    'locale' => 'en',
                    'title' => $project->translation('en')['title'],
                    'detail' => $project->translation('en')['detail']
                ];
            }
            if (isset($project->title['cn'])) {
                $translations[] = [
                    'locale' => 'cn',
                    'title' => $project->translation('cn')['title'],
                    'detail' => $project->translation('cn')['detail']
                ];
            }

            $project->translations = $translations;
            $project->tag = $project->pastWorkTag;
            $project->tag->translation = $project->tag->translation();
        }

        foreach ($tags as $tag) {
            $tag->translation = $tag->translation();
            $tag->th = $tag->translation('th');
            $tag->en = $tag->translation('en');
            $tag->cn = $tag->translation('cn');
        }



        return view('admin.static_page.manage_project', compact('projects', 'tags', 'pageName'));
    }


    public function create_project_view($pageName)
    {
        if (!in_array($pageName, $this->projectPath)) {
            return redirect()->back()->with('error', 'Invalid project path');
        }
        $tags = PastWorkTag::where('page', $pageName)->get();
        foreach ($tags as $tag) {
            $tag->translation = $tag->translation();
        }

        return view('admin.static_page.create_project', compact('pageName', 'tags'));
    }

    public function edit_project_view($pageName, $projectId)
    {
        $project = Pastwork::find($projectId);
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        if ($project->page !== $pageName) {
            return redirect()->back()->with('error', 'Project does not belong to this page');
        }

        $project->tag = $project->pastWorkTag;

        if (!in_array($pageName, $this->projectPath)) {
            return redirect()->back()->with('error', 'Invalid project path');
        }
        $tags = PastWorkTag::where('page', $pageName)->get();
        foreach ($tags as $tag) {
            $tag->translation = $tag->translation();
        }

        return view('admin.static_page.create_project', compact('pageName', 'tags', 'project'));
    }

    public function create_project(Request $request, $pageName)
    {
        $request->validate([
            'tag' => 'required|exists:past_work_tags,id',
            'coverPageImg' => 'required|string',
            'title' => 'required|string',
            'detail' => 'required|string',
            'images' => 'required|array',
        ]);


        $tag = PastWorkTag::findOrFail($request->input('tag'));
        if ($tag->page !== $pageName) {
            return response()->json(['message' => 'Tag does not belong to this page'], 400);
        }

        $project = $tag->pastworks()->create([
            'page' => $pageName,
            'title' => ['th' => $request->input('title')],
            'detail' => ['th' => $request->input('detail')],
        ]);
        try {
            $images = $request->input('images');
            $folderName = 'project/' . $pageName . '/' . $project->id . '/';

            $coverPageImg = $request->input('coverPageImg');
            $fileName = basename($coverPageImg);
            if (Storage::exists('public/temp_uploads/' . $fileName)) {
                Storage::move('public/temp_uploads/' . $fileName, 'public/' . $folderName . $fileName);
                $coverPageImg = "/storage" . "/" . $folderName . $fileName;
            }

            for ($index = 0; $index < count($images); $index++) {
                $fileName = basename($images[$index]);
                if (Storage::exists('public/temp_uploads/' . $fileName)) {
                    Storage::move('public/temp_uploads/' . $fileName, 'public/' . $folderName . $fileName);
                    $images[$index] = "/storage" . "/" . $folderName . $fileName;
                }
                else if($coverPageImg == "/storage" . "/" . $folderName . $fileName) {
                    $images[$index] = $coverPageImg;
                }
            }

            $project->images = $images;
            $project->coverPageImg = $coverPageImg;
            $project->save();

            return response()->json(['message' => $images], 200);
        } catch (Exception $e) {
            $project->delete();
            return  response()->json(['message' => 'Error creating project: ' . $e->getMessage()], 500);
        }
    }


    public function edit_project(Request $request, $pageName, $id)
    {
        try {
            $request->validate([
                'tag' => 'required|exists:past_work_tags,id',
                'coverPageImg' => 'required|string',
                'images' => 'required|array',
            ]);

            $project = Pastwork::where('id', $id)->firstOrFail();

            $folderName = 'project/' . $pageName . '/' . $project->id . '/';
            $oldCoverPage = $project->coverPageImg;
            $newCoverName = basename($request->input('coverPageImg'));
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

            // relate image part
            $images = $request->input('images');
            for ($index = 0; $index < count($images); $index++) {
                $fileName = basename($images[$index]);
                if (Storage::exists('public/temp_uploads/' . $fileName)) {
                    Storage::move('public/temp_uploads/' . $fileName, 'public/' . $folderName . $fileName);
                    $images[$index] = "/storage" . "/" . $folderName . $fileName;
                }
            }

            $oldImages = $project->images;
            foreach ($oldImages as $old) {
                if (!in_array($old, $images)) {
                    $fileName = basename($old);
                    if (Storage::exists("public/$folderName$fileName")) {
                        Storage::delete("public/$folderName$fileName");
                    }
                }
            }

            $project->images = $images;
            $project->coverPageImg = $updateCoverPage;
            $project->tag = $request->input('tag');
            $project->save();
        } catch (Exception $e) {
            return response()->json(['message' => 'Error editing project: ' . $e->getMessage()], 500);
        }
    }

    public function edit_project_lang(Request $request, $pageName, $id)
    {
        try {
            $request->validate([
                'locale' => 'required|string|max:5',
                'detail' => 'required|string',
                'title' => 'required|string',
            ]);

            $project = Pastwork::findOrFail($id);
            if ($project->page !== $pageName) {
                return redirect()->back()->with('error', 'Project does not belong to this page');
            }

            $title = $project->title;
            $detail = $project->detail;
            $title[$request->locale] = $request->title;
            $detail[$request->locale] = $request->detail;
            $project->title = $title;
            $project->detail = $detail;
            $project->save();
            return redirect()->back()->with('status', 'Project language edited successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error editing project language: ' . $e->getMessage());
        }
    }




    function create_tag($pageName, Request $request)
    {
        try {
            $request->validate([
                'locale' => 'required|string|max:5',
                'title' => 'required|string',
            ]);

            $tag = PastWorkTag::create(
                [
                    'title' => [
                        'th' => $request['title'],
                    ],
                    'page' => $pageName
                ]
            );

            return response()->json(['message' => 'Tag created successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating tag: ' . $e->getMessage()], 500);
        }
    }

    function edit_tag($pageName, Request $request)
    {
        try {
            // return response()->json(['message' => $request['locale']], 400);
            $request->validate([
                'locale' => 'required|string|max:5',
                'title' => 'required|string',
            ]);
            $tag = PastWorkTag::findOrFail($request->id);
            if (!$tag) {
                return response()->json(['message' => 'Tag not found.'], 404);
            }

            $title = $tag->title;
            $title[$request['locale']] = $request['title'];
            $tag->title = $title;
            $tag->save();

            return response()->json(['message' => 'Tag created successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating tag: ' . $e->getMessage()], 500);
        }
    }

    function delete_project($pageName, $id)
    {
        try {
            $project = Pastwork::findOrFail($id);
            if ($project->page !== $pageName) {
                return response()->json(['message' => 'Project does not belong to this page'], 400);
            }
            $project->delete();
            return redirect()->back()->with('status', 'Project deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error deleting project: ' . $e->getMessage());
        }
    }

    function delete_tag($pageName, $id)
    {
        try {
            $tag = PastWorkTag::findOrFail($id);
            $tag->delete();
            return response()->json(['message' => 'Tag deleted successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error deleting tag: ' . $e->getMessage()], 500);
        }
    }
}
