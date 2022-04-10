<?php

namespace Modules\Services\Http\Services;

use App\Models\ServiceDetail;
use Illuminate\Http\Request;

class DetailService
{

    public final function addDetail(Request $request): \Illuminate\Database\Eloquent\Model|ServiceDetail
    {
        return ServiceDetail::create($request->all());
    }

    public final function updateDetail(Request $request): bool|int
    {
        $data = [
            'service_detail_unit' => $request->service_detail_unit,
            'service_detail_name' => $request->service_detail_name,
            'service_detail_cost' => $request->service_detail_cost,
        ];
        return ServiceDetail::where('service_detail_id', $request->service_detail_id)
            ->update($data);
    }
}
