<?php

namespace App\Http\Controllers\Api;

use App\Classes\Services\Interfaces\ICategoryService;
use App\Classes\Services\Interfaces\ITestService;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    
    protected ICategoryService $categoryService;
    
    public function __construct(ICategoryService $_categoryService)
    {
        $this->categoryService = $_categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->categoryService->find($data);
        return $this->sendResponseSuccess(['data'=>$result]);
    }

    public function createOrUpdate(CategoryRequest $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->categoryService->createOrUpdate($data);
        return $this->sendResponseSuccess(['data'=>$result, 'status' => 201]);
    }

    public function paginate(Request $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->categoryService->paginate($data);
        return $this->sendResponseSuccess(['data'=>$result]);
    }
    public function delete(Request $request) : JsonResponse {
        $result = $this->categoryService->delete($request->id);
        if($result) {
            return $this->sendResponseSuccess(['message'   => "delete category success",]);
        }
        return $this->sendResponseError(['message'   => "delete category false",]);
    }
}
