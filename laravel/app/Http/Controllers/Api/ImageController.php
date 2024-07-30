<?php

namespace App\Http\Controllers\Api;

use App\Classes\Services\Interfaces\IImageService;
use App\Http\Requests\ImageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    
    protected IImageService $imageService;
    
    public function __construct(IImageService $_imageService)
    {
        $this->imageService = $_imageService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->imageService->find($data);
        return $this->sendResponseSuccess(['data'=>$result]);
    }

    public function createOrUpdate(ImageRequest $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->imageService->createOrUpdate($data);
        return $this->sendResponseSuccess(['data'=>$result, 'status' => 201]);
    }

     public function paginate(Request $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->imageService->paginate($data);
        return $this->sendResponseSuccess(['data'=>$result]);
    }
}
