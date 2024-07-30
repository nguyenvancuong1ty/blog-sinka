<?php

namespace App\Classes\Services\Service;

use App\Classes\Repositories\Interfaces\IPostRepository;
use App\Classes\Services\Interfaces\IPostService;
use Illuminate\Support\Facades\Log;

class PostService extends BaseService implements IPostService
{
    protected IPostRepository $postRepository;

    public function __construct(
        IPostRepository $postRepository
    )
    {
        $this->postRepository = $postRepository;
    }

    public function find(array $data, array $relation = []) {
        return $this->postRepository->find($data, $relation);
    }
    
    public function createOrUpdate(array $data)
    {
        try {      
            if (empty($data['id'])) {
                return $this->postRepository->create($data);
            } 
            else {
                $id = $data['id'];
                $post = $this->postRepository->findById($id);
                return $this->postRepository->update($post, $data);
            }
        } catch (\Exception $e) {
            Log::error('Error create or update post: ' . $e->getMessage());
            return [];
        }
    }

    /** 
     * @inheritDoc 
    */
     public function paginate($data){
        $conditions = ["category_id" => $data['category_id'], "title" => $data['search']];
        $defaults = [
            'relation' => ['images'],
            'conditions' => $conditions,
            'limit' => []
        ];
        $defaults = array_merge($defaults, $data);
        
        Log::info("DEFAULT", $defaults);
        return $this->postRepository->paginate($defaults);
     }

    /** @inheritDoc */
    public function findById($id)
    {
        return $this->postRepository->findById($id);
    }

    /** @inheritDoc */
    public function delete($id): bool
    {
        return 1;
        return $this->postRepository->deleteById($id);
    }
}
