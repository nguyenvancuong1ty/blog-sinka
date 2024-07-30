<?php

namespace App\Http\Controllers\Api;

use App\Classes\Services\Interfaces\IPostService;
use App\Http\Requests\PostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    protected IPostService $postService;
    
    public function __construct(IPostService $_postService)
    {
        $this->postService = $_postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->postService->find($data);
        return $this->sendResponseSuccess(['data'=>$result]);
    }

    public function createOrUpdate(PostRequest $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->postService->createOrUpdate($data);
        return $this->sendResponseSuccess(['data'=>$result, 'status' => 201]);
    }

     public function paginate(Request $request): JsonResponse
    {
        $data = $request->all();
        $result = $this->postService->paginate($data);
        return $this->sendResponseSuccess(['data'=>$result]);
    }
}
