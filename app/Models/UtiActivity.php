<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiActivity extends Model
{
    protected $table = 'uti_activity';
    protected $primaryKey = 'activity_id';
    protected $guarded = ['activity_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
