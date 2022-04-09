<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHead extends Model
{
    use HasFactory;

    protected $table = 'service_head';
    protected $primaryKey = 'service_head_id';
    protected $guarded = ['service_head_id'];

}
