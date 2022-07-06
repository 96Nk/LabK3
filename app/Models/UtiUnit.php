<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiUnit extends Model
{
    use HasFactory;

    protected $table = 'uti_unit';
    protected $primaryKey = 'unit_id';
    protected $guarded = ['unit_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
