<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiLetterSigner extends Model
{
    use HasFactory;

    protected $table = 'uti_letter_singer';
    protected $primaryKey = 'signer_id';
    protected $guarded = ['signer_id'];

}
