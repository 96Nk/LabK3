<?php

namespace Modules\Services\Http\Services;

use App\Models\ServiceBody;
use Illuminate\Http\Request;

class BodyService
{

    public final function addBody(Request $request): \Illuminate\Database\Eloquent\Model|ServiceBody
    {
        return ServiceBody::create($request->all());
    }

    public final function updateBody(Request $request): bool|int
    {
        $data = ['service_body_name' => $request->service_body_name];
        return ServiceBody::where('service_body_id', $request->service_body_id)
            ->update($data);
    }
}
