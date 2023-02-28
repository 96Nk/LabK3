<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketFeedback extends Model
{
    use HasFactory;

    protected $table = 'ticket_feedbacks';
    protected $primaryKey = 'feedback_id';
    protected $guarded = ['feedback_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
