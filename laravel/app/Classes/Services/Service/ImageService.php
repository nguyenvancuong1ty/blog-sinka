<?php

namespace App\Classes\Services\Service;

use App\Classes\Repositories\Interfaces\IImageRepository;
use App\Classes\Services\Interfaces\IImageService;
use Illuminate\Support\Facades\Log;

class ImageService extends BaseService implements IImageService
{
    protected IImageRepository $imageRepository;

    public function __construct(
        IImageRepository $imageRepository
    )
    {
        $this->imageRepository = $imageRepository;
    }

    public function find(array $data, array $relation = []) {
        return $this->imageRepository->find($data, $relation);
    }
    
    public function createOrUpdate(array $data)
    {
        try {      
            if (empty($data['id'])) {
                return $this->imageRepository->create($data);
            } 
            else {
                $id = $data['id'];
                $post = $this->imageRepository->findById($id);
                return $this->imageRepository->update($post, $data);
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
        $defaults = [
            'relation' => [],
            'conditions' => [],
            'limit' => []
        ];
        $defaults = array_merge($defaults, $data);
        return $this->imageRepository->paginate($defaults);
     }

    /** @inheritDoc */
    public function findById($id)
    {
        return $this->imageRepository->findById($id);
    }

    /** @inheritDoc */
    public function delete($id): bool
    {
        return 1;
        return $this->imageRepository->deleteById($id);
    }
}
