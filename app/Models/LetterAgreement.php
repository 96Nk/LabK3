<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterAgreement extends Model
{
    use HasFactory;

    protected $table = 'letter_agreements';
    protected $primaryKey = 'agreement_id';
    protected $guarded = ['agreement_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public final function getRouteKeyName(): string
    {
        return 'form_code';
    }
}
