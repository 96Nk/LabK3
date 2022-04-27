<?php

namespace Modules\Gallery\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Modules\Gallery\Http\Services\GalleryService;

class ItemController extends Controller
{

    public function __construct(private GalleryService $galleryService)
    {
    }

    public function index(GalleryCategory $category)
    {
        return view('gallery::items.index', compact('category'));
    }

    public final function store(Request $request)
    {
        try {
            $status = (bool)$this->galleryService->addItem($request);
            $response = ResponseHelper::statusAction('Input data Gallery', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }


}
