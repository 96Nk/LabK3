<?php

namespace Modules\LandingPageService\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\ServiceLanding;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LandingPageServiceController extends Controller
{

    public function __construct()
    {
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $data['services'] = ServiceLanding::all();
        return view('landingpageservice::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('landingpageservice::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'service_landing_image' => 'required|image|file',
            ]);
            $serviceLandingImageName = $request->file('service_landing_image')->store('landingpage/service');
            ServiceLanding::create([
                'service_landing_title' => $request->post('service_landing_title'),
                'service_landing_body' => $request->post('service_landing_body'),
                'service_landing_image' => $serviceLandingImageName,
                'service_landing_active' => 'Y',
            ]);
            $response = ResponseHelper::statusAction('Success', true);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    /**
     * Show the specified resource.
     * @param int $serviceLandingId
     * @return Renderable
     */
    public function show($serviceLandingId): Renderable
    {
        $data['serviceLanding'] = ServiceLanding::find($serviceLandingId);
        return view('landingpageservice::show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $serviceLandingId
     * @return Renderable
     */
    public function edit($serviceLandingId): Renderable
    {
        $data['serviceLanding'] = ServiceLanding::find($serviceLandingId);
        return view('landingpageservice::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $serviceLandingId
     * @return RedirectResponse
     */
    public function update(Request $request, $serviceLandingId): RedirectResponse
    {
        try {
            $update = [
                'service_landing_title' => $request->post('service_landing_title'),
                'service_landing_body' => $request->post('service_landing_body'),
                'service_landing_active' => 'Y',
            ];
            if ($request->file('service_landing_image')) {
                $request->validate([
                    'service_landing_image' => 'required|image|file',
                ]);
                $serviceLandingImageName = $request->file('service_landing_image')->store('landingpage/service');
                $update['service_landing_image'] = $serviceLandingImageName;
            }
            ServiceLanding::where('service_landing_id', $serviceLandingId)->update($update);
            $response = ResponseHelper::statusAction('Success', true);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $serviceLandingId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Routing\Redirector|RedirectResponse
     */
    public function destroy($serviceLandingId): \Illuminate\Contracts\Foundation\Application|RedirectResponse|\Illuminate\Routing\Redirector
    {
        try {
            ServiceLanding::where('service_landing_id', $serviceLandingId)->delete();
            $response = ResponseHelper::statusAction('Success', true);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        $this->setFlash($response['message'], $response['status']);
        return redirect('/landing-page/services');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $ckeditorLandingImageName = $request->file('upload')->store('landingpage/ckeditor');
            $CKEditorFuncNum = $request->input('CKEditorFuncNum') ? $request->input('CKEditorFuncNum') : 0;
            $url = asset('/storage/' . $ckeditorLandingImageName);
            $msg = 'Image successfully uploaded';
            $renderHtml = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            if ($CKEditorFuncNum > 0) {
                @header('Content-type: text/html; charset=utf-8');
                echo $renderHtml;
            } else {
                return response()->json([
                    'uploaded' => '1',
                    'fileName' => $ckeditorLandingImageName,
                    'url' => $url
                ]);
            }

        }

    }
}
