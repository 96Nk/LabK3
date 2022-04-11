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
    protected $hidden = ['created_at', 'updated_at'];
    protected $with = ['service_bodies'];

    public final function service_bodies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ServiceBody::class, 'service_head_id', 'service_head_id');
    }

}
