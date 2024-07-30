<?php

namespace App\Classes\Repositories\Repository;

use App\Classes\Repositories\Interfaces\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements IBaseRepository {

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function find(array $conditions = [], array $relation = []) {
        return $this->model->with($relation)->where($conditions)->get();
    }

    /**
     * @inheritdoc
     */     
    public function paginate(array $options) {
        return $this->model->with($options['relation'])->where($options['conditions'])->paginate($options['limit']);
    }

    /**$conditions = [], array $relation = [], int $limit
     * @inheritdoc
     */    
    public function findOne(array $conditions = [], array $relation = []){
        return $this->model->with($relation)->where($conditions)->first();
    }

    /**
     * @inheritdoc
     */   
    public function findById(int $id){
        return $this->model->findOrFail($id);
    }

    /**
     * @inheritdoc
     */   
    public function create(array $data){
        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */   
    public function update(Model $model, array $data){
        return $model->update($data);
    }

    /**
     * @inheritdoc
     */   
    public function save(Model $model){
        return $model->save();
    }

    /**
     * @inheritdoc
     */  
    public function delete(Model $model){
        return $model->delete();
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $id){
        return $this->model->destroy($id);
    }
}
