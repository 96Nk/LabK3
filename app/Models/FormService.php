<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormService extends Model
{
    use HasFactory;

    protected $table = 'form_services';
    protected $primaryKey = 'form_service_id';
    protected $guarded = ['form_service_id'];
}
