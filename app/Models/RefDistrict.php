<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefDistrict extends Model
{
    use HasFactory;

    protected $table = 'ref_districts';
    protected $primaryKey = 'districts_id';
    protected $guarded = [];
}
