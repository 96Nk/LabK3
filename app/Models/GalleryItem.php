<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $table = 'gallery_items';
    protected $primaryKey = 'gallery_item_id';
    protected $guarded = ['gallery_item_id'];
    protected $hidden = ['created_at', 'updated_at'];

}
