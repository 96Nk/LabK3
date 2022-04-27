<?php

namespace Modules\Gallery\Http\Controllers;

use App\Models\GalleryCategory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Gallery\Http\Services\GalleryService;

class ItemController extends Controller
{

    public function __construct(private GalleryService $galleryService)
    {
    }

    public function index(GalleryCategory $category)
    {
        return view('gallery::items.index', compact('category'));
    }

    public function store(Request $request)
    {
        try {
            $path = 'gallery';
            $request->file('image')->store($path);
            $data['gallery_item_name'] = $request->file('image');
            $data['gallery_item_path'] = $path . '/';
        } catch (\Exception $exception) {

        }
    }


}
