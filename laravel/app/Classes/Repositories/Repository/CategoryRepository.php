<?php
namespace App\Classes\Repositories\Repository;

use App\Classes\Repositories\Interfaces\ICategoryRepository;
use App\Classes\Repositories\Repository\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements ICategoryRepository{
    
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}