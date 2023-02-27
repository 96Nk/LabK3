<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterReceipt extends Model
{
    use HasFactory;

    protected $table = 'letter_receipts';
    protected $guarded = ['receipt_id'];
    protected $primaryKey = 'receipt_id';
    protected $hidden = ['created_at', 'updated_at'];

    public final function getRouteKeyName(): string
    {
        return 'form_code';
    }

    public final function scopeReceiptStatus($query)
    {
        return $query->where('receipt_status', 1);
    }

    public final function form(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Form::class, 'form_code', 'form_code');
    }


}
