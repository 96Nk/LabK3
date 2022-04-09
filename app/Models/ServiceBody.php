<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBody extends Model
{
    use HasFactory;

    protected $table = 'service_body';
    protected $primaryKey = 'service_body_id';
    protected $guarded = ['service_body_id'];
}
