<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAdditional extends Model
{
    use HasFactory;

    protected $table = 'form_additionals';
    protected $primaryKey = 'form_additional_id';
    protected $guarded = ['form_additional_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
