<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DOMDocument;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function extractImagePathsFromHtml($htmlContent, $folderName)
    {
        $paths = [];
        $doc = new DOMDocument();
        @$doc->loadHTML('<?xml encoding="utf-8" ?>' . $htmlContent); // Suppress HTML5 warnings
        $images = $doc->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            $name = basename($src);

            if (Storage::exists("public/$folderName/$name")) {
                $paths[] = $name;
            }
        }
        return array_unique($paths); // คืนค่า path ที่ไม่ซ้ำกัน
    }
}
