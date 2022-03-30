<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCity extends Model
{
    use HasFactory;

    protected $table = 'ref_cities';
    protected $primaryKey = 'city_id';
    protected $guarded = [];
}
