<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewOfficerTemp extends Model
{
    use HasFactory;
    protected $table = 'review_officers_temp';
    protected $primaryKey = 'temp_id';
    protected $guarded  =['temp_id'];
}
