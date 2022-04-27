<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $table = 'gallery_categories';
    protected $primaryKey = 'gallery_category_id';
    protected $guarded = ['gallery_category_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public final function scopeActive($query)
    {
        return $query->where('gallery_category_status', 1);
    }

    public function gallery(){
        return $this->hasMany('', '','');
    }

}
