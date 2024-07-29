<?php
namespace App\Classes\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Model;

interface IBaseRepository {

    /**
     * Find all records that match a given conditions
     *
     * @param array $conditions
     *
     * @return Collection
     */
    public function find(array $conditions, array $relation); 

    /**
     * Find pagination records that match a given conditions
     *
     * @param array $conditions
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(array $conditions, array $relation, int $limit); 


    /**
     * Find a specific record that matches a given conditions
     *
     * @param array $conditions
     *
     * @return Model
     */
    public function findOne(array $conditions, array $relation);


    /**
     * Find a specific record that matches id
     *
     * @param array $conditions
     *
     * @return Model
     */
    public function findById(int $id);

    /**
     * Create a record
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $data);

    /**
     * Update a record
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function update(Model $model, array $data);


    /**
     * Save a given record
     *
     * @param Model $model
     *
     * @return boolean
     */
    public function save(Model $model);

    /**
     * Delete the record from the database.
     *
     * @param Model $model
     *
     * @return bool
     *
     * @throws Exception
     */
    public function delete(Model $model);

    /**
     * delete the record by id from the database.
     *
     * @param  int $id
     *
     *
     * @return bool
     *
     * @throws Exception
     */
    public function deleteById(int $id);
    
}