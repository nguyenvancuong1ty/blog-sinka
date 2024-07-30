<?php
namespace App\Classes\Repositories\Repository;

use App\Classes\Repositories\Interfaces\IPostRepository;
use App\Classes\Repositories\Repository\BaseRepository;
use App\Models\Post;

class PostRepository extends BaseRepository implements IPostRepository{
    
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }
}