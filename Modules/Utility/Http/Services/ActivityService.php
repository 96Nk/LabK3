<?php

namespace Modules\Utility\Http\Services;

use App\Models\UtiActivity;
use App\Models\UtiLetterSigner;
use Illuminate\Http\Request;

class ActivityService
{

    public final function addActivity(Request $request)
    {
        $attributes = $request->validate(['activity_desc' => 'required']);
        return UtiActivity::create($attributes);
    }

    public final function updateActivity(Request $request,int $id): bool|int
    {
        $data = ['activity_desc' => $request->activity_desc];
        return UtiActivity::where('activity_id', $id)
            ->update($data);
    }
}
