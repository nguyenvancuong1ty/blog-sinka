<?php

namespace App\Classes\Services\Service;

use App\Classes\Repositories\Interfaces\ICategoryRepository;
use App\Classes\Services\Interfaces\ICategoryService;
use Illuminate\Support\Facades\Log;

class CategoryService extends BaseService implements ICategoryService
{
    protected ICategoryRepository $categoryRepository;

    public function __construct(
        ICategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function find(array $data, array $relation = []) {
        return $this->categoryRepository->find($data, $relation);
    }
    
    public function createOrUpdate(array $data)
    {
        try {      
            if (empty($data['id'])) {
                return $this->categoryRepository->create($data);
            } 
            else {
                $id = $data['id'];
                $category = $this->categoryRepository->findById($id);
                return $this->categoryRepository->update($category, $data);
            }
        } catch (\Exception $e) {
            Log::error('Error create or update Category: ' . $e->getMessage());
            return [];
        }
    }

    /** 
     * @inheritDoc 
    */
     public function paginate($data){
        $defaults = [
            'relation' => ['posts'],
            'conditions' => [],
            'limit' => []
        ];
        $defaults = array_merge($defaults, $data);
        return $this->categoryRepository->paginate($defaults);
     }

    /** @inheritDoc */
    public function findById($id)
    {
        return $this->categoryRepository->findById($id);
    }

    /** @inheritDoc */
    public function delete($id): bool
    {
        return 1;
        return $this->categoryRepository->deleteById($id);
    }
}
