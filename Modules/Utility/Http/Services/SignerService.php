<?php

namespace Modules\Utility\Http\Services;

use App\Models\UtiLetterSigner;
use Illuminate\Http\Request;

class SignerService
{

    public final function addSigner(Request $request): \Illuminate\Database\Eloquent\Model|UtiLetterSigner
    {
        return UtiLetterSigner::create($request->all());
    }

    public final function updateSigner(Request $request): bool|int
    {
        $data = [
            'nip' => $request->nip,
            'signer_name' => $request->signer_name,
            'signer_position' => $request->signer_position,
        ];
        return UtiLetterSigner::where('signer_id', $request->signer_id)
            ->update($data);
    }
}
