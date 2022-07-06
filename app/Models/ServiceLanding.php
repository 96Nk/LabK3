<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLanding extends Model
{
    use HasFactory;

    protected $table = 'service_landing';
    protected $primaryKey = 'service_landing_id';
    protected $guarded = ['service_landing_id'];
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
