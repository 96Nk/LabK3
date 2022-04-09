<?php

namespace Modules\Services\Http\Services;

use App\Models\ServiceHead;
use Illuminate\Http\Request;

class HeadService
{

    public final function addHead(Request $request): \Illuminate\Database\Eloquent\Model|ServiceHead
    {
        return ServiceHead::create($request->all());
    }

    public final function updateHead(Request $request): bool|int
    {
        $data = ['service_head_name' => $request->service_head_name,];
        return ServiceHead::where('service_head_id', $request->service_head_id)
            ->update($data);
    }
}
