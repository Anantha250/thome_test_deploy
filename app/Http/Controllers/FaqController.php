<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Faq;
use App\Models\FaqTag;
use App\Models\FaqTranslation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FaqController extends Controller
{

    function get_all() {}

    function manage(Request $request)
    {
        $query = Faq::query();
        $tags = FaqTag::all();

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';

            $query->whereHas('translations', function ($q) use ($searchTerm) {
                $q->where('question', 'like', $searchTerm)
                    ->orWhere('answer', 'like', $searchTerm);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('faqTags', function ($q) use ($request) {
                $q->where('faq_tag_id', $request->tag);
            });
        }

        if ($request->has('page') && $request->page > $articles = $query->paginate(9)->lastPage()) {
            return redirect()->route('admin.faq.manage', array_merge($request->except('page'), ['page' => 1]));
        }

        $faqs = $query->paginate(8)->appends($request->except('page'));

        foreach ($faqs as $faq) {
            $faq->translation = $faq->translation();
            $faq->tags = $faq->faqTags->map(function ($tag) {
                return $tag->translation();
            });
        }

        foreach ($tags as $tag) {
            $tag->translation = $tag->translation();
            $tag->th = $tag->translation('th');
            $tag->en = $tag->translation('en');
            $tag->cn = $tag->translation('cn');
        }
        return view('admin.faq.manage', compact('faqs', 'tags'));
    }

    function create_store(Request $request)
    {
        try {
            $request->validate([
                'locale' => 'required|string|max:5',
                'question' => 'required|string',
                'answer' => 'required|string',
                'tags' => 'array',
            ]);

            $faq = Faq::create();

            $faq->translations()->create([
                'locale' => $request['locale'],
                'question' => $request['question'],
                'answer' => $request['answer'],
            ]);

            $faq->faqTags()->attach($request['tags']);
            return response()->json(['message' => 'FAQ created successfully.']);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating FAQ: ' . $e->getMessage()], 500);
        }
    }

    function edit_store($id, Request $request)
    {

        try {
            $request->validate([
                'locale' => 'required|string|max:5',
                'question' => 'required|string',
                'answer' => 'required|string',
                'tags' => 'array',
            ]);

            $faq = Faq::findOrFail($id);
            $faq->translations()->updateOrCreate(
                ['locale' => $request['locale']],
                [
                    'question' => $request['question'],
                    'answer' => $request['answer'],
                ]
            );

            if (is_array($request['tags'])) {
                $faq->faqTags()->sync($request['tags']);
            }

            return response()->json(['message' => 'FAQ updated successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error updating FAQ: ' . $e->getMessage()], 500);
        }
    }

    function delete($id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->delete();
            return response()->json(['message' => 'FAQ deleted successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error deleting FAQ: ' . $e->getMessage()], 500);
        }
    }

    function create_tag(Request $request)
    {
        try {
            $request->validate([
                'locale' => 'required|string|max:5',
                'name' => 'required|string',
            ]);

            $tag = FaqTag::create();

            $tag->translations()->create([
                'locale' => $request['locale'],
                'name' => $request['name'],
            ]);

            return response()->json(['message' => 'Tag created successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error creating tag: ' . $e->getMessage()], 500);
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

            $tag = FaqTag::findOrFail($request->id);
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

    function delete_tag($id)
    {
        try {
            $tag = FaqTag::findOrFail($id);
            $tag->delete();
            return response()->json(['message' => 'Tag deleted successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error deleting tag: ' . $e->getMessage()], 500);
        }
    }


    function get_translate($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->th = $faq->translation('th');
        $faq->en = $faq->translation('en');
        return response()->json($faq);
    }

    function get_faq_and_available_lang($id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->tags = $faq->faqTags->map(function ($tag) {
                return $tag->translation();
            });

            // $tags = $faq->faqTags()->get();
            // foreach ($tags as $tag) {
            //     $tag->translation = $tag->translation();
            // }
            return response()->json($faq, 200);
            // return response()->json(['translation'=> $faq->translations, 'tags' => $tags], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error fetching FAQ: ' . $e->getMessage()], 500);
        }
    }
}
