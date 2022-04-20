<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $primaryKey = 'company_id';
    protected $guarded = ['company_id'];
    protected $hidden = ['created_at', 'updated_at'];
//    protected $with = ['user'];
//
//    public function user()
//    {
//        return $this->hasOne(User::class, 'company_id', 'company_id');
//    }
}
