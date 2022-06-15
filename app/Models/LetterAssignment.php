<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterAssignment extends Model
{
    use HasFactory;

    protected $table = 'letter_assignments';
    protected $guarded = ['assignment_id'];
    protected $primaryKey = 'assignment_id';
    protected $hidden = ['created_at', 'updated_at'];

}
