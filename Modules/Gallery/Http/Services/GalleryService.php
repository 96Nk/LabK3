<?php

namespace Modules\Gallery\Http\Services;

use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class GalleryService
{
    public function __construct()
    {
    }

    public final function addCategory(Request $request): \Illuminate\Database\Eloquent\Model|GalleryCategory
    {
        $attributes = $request->validate([
            'gallery_category_name' => 'required',
        ]);
        return GalleryCategory::create($attributes);
    }

    public final function updateCategory(Request $request): bool|int
    {
        return GalleryCategory::where('gallery_category_id', $request->gallery_category_id)
            ->update([
                'gallery_category_name' => $request->gallery_category_name
            ]);
    }

    public final function addItem(Request $request)
    {
        $request->validate([
            'image' => 'required|image|file|max:4096',
        ]);


        return GalleryCategory::create($attributes);
    }

}
