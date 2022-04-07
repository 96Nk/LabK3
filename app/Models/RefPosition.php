<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefPosition extends Model
{
    use HasFactory;

    protected $table = 'ref_positions';
    protected $primaryKey = 'position_id';
    protected $guarded = ['position_id'];
}
