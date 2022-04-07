<?php

namespace Modules\Referensi\Http\Services;

use App\Models\RefPosition;
use Illuminate\Http\Request;
use Modules\Referensi\Http\Requests\PositionRequest;

class PositionService
{

    public final function addPosition(PositionRequest $request): \Illuminate\Database\Eloquent\Model|RefPosition
    {
        return RefPosition::create($request->all());
    }

    public final function updatePosition(PositionRequest $request): bool|int
    {
        $data = [
            'position_name' => $request->position_name,
            'position_status' => $request->position_status
        ];
        return RefPosition::where('position_id', $request->position_id)
            ->update($data);
    }

}
