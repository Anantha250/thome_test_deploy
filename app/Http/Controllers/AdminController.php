<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\ArticleTranslation;
use Exception;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AdminController extends Controller

{
    //
    function index()
    {
        $article = Article::where('id', 1)->first();
        $translation = $article->translation(); // ได้ title/content ตามภาษา
        return view('admin.index', ['translation' => $translation]);
    }

    public function upload_image(Request $request)
    {
        try {
            if (!$request->hasFile('image')) {
                return response()->json(['message' => 'No image file provided'], 400);
            }
            $imageFile = $request->file('image');
            $fileName = md5_file($imageFile->getRealPath());
            $fileExtension = $imageFile->getClientOriginalExtension() ?? 'jpg';
            Storage::putFileAs('public/temp_uploads/', $imageFile, $fileName . '.' . $fileExtension);
            return response("/storage/temp_uploads/$fileName" . '.' . $fileExtension, 200)
                ->header('Content-Type', 'text/plain');
            // $fullPath = storage_path('app/public/temp_uploads/' . $fileName . '.' . $imageFile->getClientOriginalExtension());
            // Storage::disk('public')->makeDirectory('temp_uploads');

            // $img = Image::make($imageFile->getRealPath());
            // $img->resize(1200, null, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // });

            // $img->save($fullPath, 90);

        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to upload image: ' . $e->getMessage()], 500);
        }
    }

    // function change_password()
    // {
    //     return view('admin.change_password');
    // }

    // function user_manage()
    // {
    //     $user = auth()->user();
    //     // if IsSuperAdmin
    //     if (auth()->user()->id != 1){
    //         $query = User::query();
    //         $users = $query->where('id', '!=', 1);
    //         $users = $users->get();
    //         return view('admin.profile.edit', compact('users'));
    //     }
    //     else {

    //         return view('admin.profile.edit');
    //     }
    // }
}
