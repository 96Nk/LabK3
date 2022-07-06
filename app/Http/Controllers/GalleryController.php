<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;

class GalleryController extends Controller
{
    public function index($galleryCategoryId)
    {
        $data = [
            'items' => GalleryCategory::where('gallery_category_id', $galleryCategoryId)->first(),
        ];
        return view('landing-page.gallery', $data);
    }
}
