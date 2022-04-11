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
    protected $hidden = ['created_at', 'updated_at'];

    public final function service_body(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ServiceBody::class, 'service_body_id', 'service_body_id');
    }

}
