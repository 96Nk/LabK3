<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReviewOfficer extends Model
{
    use HasFactory;

    protected $table = 'review_officers';
    protected $primaryKey = 'review_officer_id';
    protected $guarded = ['review_officer_id'];

//    public final function employee(): \Illuminate\Database\Eloquent\Relations\HasOne
//    {
//        return $this->hasOne(RefEmployee::class, 'nip_nik', 'nip_nik')
//            ->join('ref_positions', 'ref_positions.position_id', '=', 'ref_employees.position_id')
//            ->orderBy('ref_positions.position_status');
//    }
}
