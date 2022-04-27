<?php

namespace Modules\Gallery\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Modules\Gallery\Http\Services\GalleryService;

class CategoryController extends Controller
{

    public function __construct(
        private GalleryService $galleryService
    )
    {
    }

    public function index()
    {
        $get = [
            'categories' => GalleryCategory::active()->get(),
        ];
        return view('gallery::index', $get);
    }

    public function store(Request $request)
    {
        try {
            $id = $request->post('gallery_category_id');
            $status = $id
                ? $this->galleryService->updateCategory($request)
                : (bool)$this->galleryService->addCategory($request);
            $response = ResponseHelper::statusAction($id ? 'Update data Gallery Category ' : 'Input data Gallery Category', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function destroy(GalleryCategory $category)
    {
        try {
            $status = $category->delete();
            $response = ResponseHelper::statusAction('Delete data Gallery Category', $status);
        } catch (\Exception $exception) {
            $response = ResponseHelper::statusAction($exception->getMessage(), false);
        }
        return response()->json($response);
    }

}
