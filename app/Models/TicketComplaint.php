<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketComplaint extends Model
{
    use HasFactory;

    protected $table = 'ticket_complaints';
    protected $primaryKey = 'complaint_id';
    protected $guarded = ['complaint_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public final function getRouteKeyName(): string
    {
        return 'complaint_code';
    }

    public final function scopeComplaintStatus($query)
    {
        return $query->where('complaint_status', 1);
    }

    public final function feedbacks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TicketFeedback::class, 'complaint_code', 'complaint_code');
    }

}
