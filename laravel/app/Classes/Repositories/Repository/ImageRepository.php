<?php
namespace App\Classes\Repositories\Repository;

use App\Classes\Repositories\Interfaces\IImageRepository;
use App\Classes\Repositories\Repository\BaseRepository;
use App\Models\Image;

class ImageRepository extends BaseRepository implements IImageRepository{
    
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }
}