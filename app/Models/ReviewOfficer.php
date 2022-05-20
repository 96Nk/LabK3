<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewOfficer extends Model
{
    use HasFactory;

    protected $table = 'review_officers';
    protected $primaryKey = 'review_officer_id';
    protected $guarded = ['review_officer_id'];
}
