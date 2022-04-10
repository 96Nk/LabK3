<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;

    protected $table = 'service_details';
    protected $primaryKey = 'service_detail_id';
    protected $guarded = ['service_detail_id'];
}
