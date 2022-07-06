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

    public final function getRouteKeyName(): string
    {
        return 'form_code';
    }

    public final function scopeAssignmentStatus($query)
    {
        return $query->where('assignment_status', 1);
    }

    public final function form(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Form::class, 'form_code', 'form_code');
    }


}
