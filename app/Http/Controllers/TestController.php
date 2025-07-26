<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\ArticleTagTranslation;
use App\Models\ArticleTranslation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class TestController extends Controller
{
    //
    function setLocale($locale)
    {
        if (! in_array($locale, ['en', 'th', 'cn'])) {
            abort(400);
        }
        Cookie::queue(Cookie::make('locale', $locale, 60 * 24 * 365));
        // Session::put('locale', $locale);
        return redirect()->back();
    }

    function index()
    {
        return view('test.index');
    }

    function create_article()
    {
        Article::create([
            'slug' => 'test-article',
            'status' => '1',
        ]);
        return response()->json(['message' => 'Article created successfully']);
    }

    function create_tag()
    {
        for ($i = 1; $i <= 5; $i++) {
            $tag = ArticleTag::create();
            $tag->translations()->create([
                'locale' => 'en',
                'name' => 'Tag ' . $i,
            ]);
            $tag->translations()->create([
                'locale' => 'th',
                'name' => 'แท็ก ' . $i,
            ]);
        }
    }

    function delete_tag()
    {
        $tag = ArticleTag::find(10);
        if ($tag) {
            $tag->delete();
            return response()->json(['message' => 'Tag deleted successfully']);
        }
        return response()->json(['message' => 'Tag not found'], 404);
    }

    function create_tag_article()
    {
        $article = Article::find(9);
        $article->articleTags()->attach([
            7 => ['created_at' => now(), 'updated_at' => now()],
            8 => ['created_at' => now(), 'updated_at' => now()],
            9 => ['created_at' => now(), 'updated_at' => now()],
        ]);
        return response()->json(['message' => 'Tag attached to article successfully']);
    }
}
