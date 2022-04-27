<?php

namespace Modules\Gallery\Http\Services;

use App\Models\GalleryCategory;
use App\Models\GalleryItem;
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

    public final function addItem(Request $request): \Illuminate\Database\Eloquent\Model|GalleryItem
    {
        $request->validate([
            'image' => 'required|image|file|max:4096',
        ]);
        $data['gallery_category_id'] = $request->post('gallery_category_id');
        $data['gallery_item_image'] = $request->file('image')->store('gallery');
        return GalleryItem::create($data);
    }

}
