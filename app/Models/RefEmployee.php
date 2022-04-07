<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefEmployee extends Model
{
    use HasFactory;

    protected $table = 'ref_employees';
    protected $primaryKey = 'employee_id';
    protected $guarded = ['employee_id'];

    protected $with = ['position'];

    public final function position(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RefPosition::class, 'position_id', 'position_id');
    }
}
