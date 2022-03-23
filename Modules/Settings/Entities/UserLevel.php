<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
