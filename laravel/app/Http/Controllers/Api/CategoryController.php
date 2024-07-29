<?php

namespace App\Http\Controllers\Api;

use App\Classes\Services\Interfaces\ICategoryService;
use App\Classes\Services\Interfaces\ITestService;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        return $this->sendResponseSuccess($result);
    }

    public function createOrUpdate(CategoryRequest $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->categoryService->createOrUpdate($data);
        dd(9);
        return $this->sendResponseSuccess($result);
    }

    
}
