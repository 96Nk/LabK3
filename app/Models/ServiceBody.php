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

    protected $with = ['service_details'];

    protected $hidden = ['created_at', 'updated_at'];

    public final function service_details(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ServiceDetail::class, 'service_body_id', 'service_body_id');
    }
}
