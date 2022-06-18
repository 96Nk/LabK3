<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiRegulation extends Model
{
    use HasFactory;

    protected $table = 'uti_regulation';
    protected $primaryKey = 'regulation_id';
    protected $guarded = ['regulation_id'];
}
