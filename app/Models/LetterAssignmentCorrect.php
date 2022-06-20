<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterAssignmentCorrect extends Model
{
    use HasFactory;

    protected $table = 'letter_assignment_corrects';
    protected $primaryKey = 'assignment_correct_id';
    protected $guarded = ['assignment_correct_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
