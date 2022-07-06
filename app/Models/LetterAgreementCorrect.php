<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterAgreementCorrect extends Model
{
    use HasFactory;

    protected $table = 'letter_agreement_corrects';
    protected $primaryKey = 'agreement_correct_id';
    protected $guarded = ['agreement_correct_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
