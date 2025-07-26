<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleHashTag;
use App\Models\ArticleTag;
use App\Models\ArticleTranslation;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DOMDocument;

class ArticleController extends Controller
{
    static public function get_latest_articles($count = 5, $except_id = null)
    {
        $articles = Article::orderBy("created_at", "desc")->where('id', '!=', $except_id)->take($count)->get();

        foreach ($articles as $article) {
            $article->translation = $article->translation();
            $article->tags = $article->articleTags->map(function ($tag) {
                return $tag->translation();
            });
        }
        return $articles;
    }


    function index(Request $request)
    {
        $query = Article::query();
        $tags = ArticleTag::all();

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->whereHas('translations', function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('articleTags.translations', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->tag . '%');
            });
        }

        $articles = $query->paginate(9)->appends($request->except('page'));

        foreach ($articles as $article) {
            $article->translation = $article->translation();
            $article->tags = $article->articleTags->map(function ($tag) {
                return $tag->translation();
            });
        }

        foreach ($tags as $tag) {
            $tag->translation = $tag->translation();
        }

        return view('home.article.index', compact('articles', 'tags'));
    }

    public function show_article(Request $request)
    {
        $news_id = $request->news_id;
        $article = Article::where('id', $news_id)->firstOrFail();

        $article->translation = $article->translation();
        $article->tags = $article->articleTags->map(function ($tag) {
            return $tag->translation();
        });
        $article->hashtags = $article->articleHashTags->translation();

        $latest_articles = $this->get_latest_articles(3, $article->id);

        $related_articles = [];
        foreach ($article->articleTags as $tag) {
            $related_articles = array_unique(
                array_merge(
                    $related_articles,
                    $tag->articles->where('id', '!=', $article->id)->all()
                )
            );
        }

        // Get 3 random related articles
        $related_articles = collect($related_articles)->unique('id')->shuffle()->take(3)->values();
        foreach ($related_articles as $related_article) {
            $related_article->translation = $related_article->translation();
        }

        return view('home.article.show_article', compact('article', 'latest_articles', 'related_articles'));
    }


    ////////////////////
    // admin
    function manage(Request $request)
    {
        $query = Article::query();
        $tags = ArticleTag::all();

        $query->whereHas('translations');

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%'; // กำหนดตัวแปรสำหรับคำค้นหา

            $query->whereHas('translations', function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('articleTags', function ($q) use ($request) {
                $q->where('article_tag_id', $request->tag);
            });
        }

        $articles = $query->paginate(8)->appends($request->except('page'));

        foreach ($articles as $article) {
            $article->translation = $article->translation();
            $article->tags = $article->articleTags->map(function ($tag) {
                return $tag->translation();
            });
            $availablelang = [];
            foreach ($article->translations as $translation) {
                $availablelang[] = $translation->locale;
            }
            $article->availablelang = $availablelang;
        }

        foreach ($tags as $tag) {
            $tag->translation = $tag->translation();
            $tag->th = $tag->translation('th');
            $tag->en = $tag->translation('en');
            $tag->cn = $tag->translation('cn');
        }

        return view('admin.article.manage', compact('articles', 'tags'));
    }

    function delete($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->delete();
            return response()->json(['message' => 'Article deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Article not found.'], 404);
        }
    }

    public function create_view()
    {
        $tags = ArticleTag::all();
        foreach ($tags as $tag) {
            $tag->translation = $tag->translation();
        }
        return view('admin.article.create', compact('tags'));
    }

    // ok
    public function create_store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'coverPageImg' => 'required',
                'tags' => 'required|array',
                'hashtags' => 'required|array',
            ]);

            $article = Article::create();

            $folderName = 'article/' . $article->folder_id . '/';
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


            $article->translations()->create([
                'locale' => 'th',
                'title' => $request["title"],
                'content' => $updatedContent,
                'coverPageImg' => $updateCoverPage,
            ]);

            $article->articleTags()->attach($request['tags']);
            $article->articleHashTags()->create([
                'locale' => $request->hashtags,
            ]);
            return response()->json(['message' => 'Article created successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating Article: ' . $e->getMessage()], 500);
        }
    }

    public function edit_view($id, Request $request)
    {
        $lang = $request->lang;

        $article = Article::where('id', $id)->firstOrFail();
        $article->translation = $article->translation($lang);
        $article->tags = $article->articleTags->map(function ($tag) {
            return $tag->translation();
        });

        // $article->hashtags = $article->articleHashTagsTranslation;
        $article->hashtags = $article->articleHashTags->locale;

        $tags = ArticleTag::all();
        foreach ($tags as $tag) {
            $tag->translation = $tag->translation();
        }

        return view('admin.article.create', compact('article', 'tags'));
    }

    public function edit_store(Request $request, $id)
    {
        $article = Article::where('id', $id)->first();
        try {
            $folderName = "article/$article->folder_id/";
            $newCoverName = basename($request->coverPageImg);
            $oldCoverPage = $article->translation($request->lang)->coverPageImg;
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

            $oldContent = $article->translation($request->lang)->content;
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

            $article->translation($request->lang)->update([
                'title' => $request["title"],
                'content' => $updatedContent,
                'coverPageImg' => $updateCoverPage
            ]);

            $article->articleTags()->sync($request['tags']);
            $article->articleHashTags()->update(['locale' => $request['hashtags']]);
            return response()->json(['message' => 'Article update successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating FAQ: ' . $e->getMessage()], 500);
        }
    }

    public function add_lang_view($id, Request $request)
    {
        $lang = $request->lang;

        $article = Article::where('id', $id)->firstOrFail();
        $article->translation = $article->translation();
        // $article->tags = $article->articleTags->map(function ($tag) {
        //     return $tag->translation();
        // });

        // $article->hashtags = $article->articleHashTags->locale;

        $tags = ArticleTag::all();
        foreach ($tags as $tag) {
            $tag->translation = $tag->translation();
        }

        return view('admin.article.create', compact('article', 'tags'));
    }

    public function add_lang_store(Request $request, $id)
    {
        try {
            $article = Article::where('id', $id)->first();

            $folderName = 'article/' . $article->folder_id . '/';
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


            $article->translations()->create([
                'locale' => $request->lang,
                'title' => $request["title"],
                'content' => $updatedContent,
                'coverPageImg' => $updateCoverPage,
            ]);

            return response()->json(['message' => 'Article add lang successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating Article: ' . $e->getMessage()], 500);
        }
    }

    function create_tag(Request $request)
    {
        try {
            $tag = ArticleTag::create();
            foreach ($request->all() as $lang) {
                $tag->translations()->create($lang);
            }
            return response()->json($request, 200);
            // return response()->json(['message' => 'Tag created successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage(), 'request' => $request->all()], 500);
        }
    }

    function edit_tag(Request $request)
    {
        try {
            // return response()->json(['message' => $request['locale']], 400);
            $request->validate([
                'locale' => 'required|string|max:5',
                'name' => 'required|string',
            ]);

            $tag = ArticleTag::findOrFail($request->id);
            if (!$tag) {
                return response()->json(['message' => 'Tag not found.'], 404);
            }
            $tag->translations()->updateOrCreate(
                ['locale' => $request['locale']],
                ['name' => $request['name']]
            );

            return response()->json(['message' => 'Tag created successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating tag: ' . $e->getMessage()], 500);
        }
    }

    function edit_id(Request $request, $id)
    {
        try {
            $change_id = $request->change_id;

            $isAvailable = Article::where('id', $change_id)->exists();
            if ($isAvailable) {
                return response()->json(['message' => 'id already used'], 400);
            }
            $tag = Article::findOrFail($id);
            $tag->update(['id' => $change_id]);
            return response()->json(['message' => 'ID updated successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating tag ID: ' . $e->getMessage()], 500);
        }
    }

    function delete_tag($id)
    {
        try {
            $tag = ArticleTag::findOrFail($id);
            $tag->delete();
            return response()->json(['message' => 'Tag deleted successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error deleting tag: ' . $e->getMessage()], 500);
        }
    }
}
