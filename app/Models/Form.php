<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Form extends Model
{
    use HasFactory;

    protected $table = 'forms';
    protected $primaryKey = 'form_id';
    protected $guarded = ['form_id'];
//    protected $with = ['form_services', 'form_services_head', 'form_services_body'];

    protected $hidden = ['created_at', 'updated_at'];


    public final function form_services(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FormService::class, 'form_code', 'form_code');
    }

    public final function form_services_head(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FormService::class, 'form_code', 'form_code')
            ->select('form_services.form_code', 'service_head.service_head_id', 'service_head.service_head_name', DB::raw('sum(form_services.service_detail_cost * form_services.point_sample) as total_head'))
            ->join('service_head', 'service_head.service_head_id', '=', 'form_services.service_head_id')
            ->groupBy('form_services.service_head_id');
    }

    public final function form_services_body(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FormService::class, 'form_code', 'form_code')
            ->select('form_services.form_code',
                'form_services.service_head_id',
                'form_services.service_body_id',
                'service_body.service_body_name',
                DB::raw('sum(form_services.service_detail_cost * form_services.point_sample) as total_body')
            )
            ->join('service_body', 'service_body.service_body_id', '=', 'form_services.service_body_id')
            ->groupBy('form_services.service_body_id');
    }


    public final function getRouteKeyName(): string
    {
        return 'form_code';
    }

    public function scopeFormStatus($query)
    {
        return $query->where('form_status', 1);
    }

    public function scopeReviewStatus($query)
    {
        return $query->where('review_status', 1);
    }
}
