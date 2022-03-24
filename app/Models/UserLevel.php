<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    use HasFactory;

    protected $table = 'user_levels';
    protected $primaryKey = 'level_id';
    protected $guarded = [];

    protected $with = ['permissions'];

    public final function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Menu::class, UserPermission::class, 'level_id', 'menu_id')
            ->withPivot('action');
    }

}
