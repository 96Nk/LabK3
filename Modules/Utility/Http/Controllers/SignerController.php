<?php

namespace Modules\Utility\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\UtiLetterSigner;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Utility\Http\Requests\SignerRequest;
use Modules\Utility\Http\Services\SignerService;

class SignerController extends Controller
{

    public function __construct(private SignerService $signerService)
    {
    }

    public function index()
    {
        $get = ['signers' => UtiLetterSigner::all()];
        return view('utility::signer.index', $get);
    }

    public function store(SignerRequest $request)
    {
        try {
            $id = $request->post('signer_id');
            $status = $id
                ? $this->signerService->updateSigner($request)
                : (bool)$this->signerService->addSigner($request);
            $response = ResponseHelper::statusAction($id ? 'Update data signer' : 'Input data signer', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public function destroy(UtiLetterSigner $letterSigner)
    {
        try {
            $status = $letterSigner->delete();
            $response = ResponseHelper::statusAction('Delete data signer', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}
