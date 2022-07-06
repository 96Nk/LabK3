<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiAccount extends Model
{
    use HasFactory;

    protected $table = 'uti_account';
    protected $primaryKey = 'account_id';
    protected $guarded = ['account_id'];
}
