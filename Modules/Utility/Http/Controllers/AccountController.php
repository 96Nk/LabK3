<?php

namespace Modules\Utility\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\UtiAccount;
use App\Models\UtiLetterSigner;
use App\Models\UtiRegulation;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Utility\Http\Requests\SignerRequest;
use Modules\Utility\Http\Services\SignerService;

class AccountController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $account = UtiAccount::first();
        return view('utility::account.index', compact('account'));
    }

    public function update(Request $request)
    {
        try {
            $attributes = $request->validate([
                'account_number' => 'required',
                'account_bank' => 'required',
                'account_name' => 'required',
            ]);
            UtiAccount::where(['account_id' => $request->post('account_id')])->update($attributes);
            $this->setFlash('Update Account', true);
        } catch (\Exception $exception) {
            $this->setFlash($exception->getMessage());
        }
        return back();
    }
}
