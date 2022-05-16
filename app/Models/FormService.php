<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class FormService extends Model
{
    use HasFactory;

    protected $table = 'form_services';
    protected $primaryKey = 'form_service_id';
    protected $guarded = ['form_service_id'];
    protected $hidden = ['created_at', 'updated_at'];

//    protected $with = ['service_detail'];

    protected final function totalCost(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['service_detail_cost'] * $attributes['point_sample'],
        );
    }

//    public function service_detail()
//    {
//        return $this->belongsTo(ServiceDetail::class, 'service_detail_id', 'service_detail_id');
//    }

//    public final function getTotalCostAttribute(): float|int
//    {
//        return $this->service_detail_cost * $this->point_sample;
//    }


}
