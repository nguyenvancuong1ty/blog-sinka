<?php

namespace App\Classes\Services\Interfaces;

interface IPostService
{

    public function find(array $conditions, array $relation = []);

    /**
     * Get by ID
     * @param $id
     */
    /**
     * Create or Update Projects
     * @param array $data
     */
    public function createOrUpdate(array $data);

     /**
     * Get paginate
     * @param $id
     */
    public function paginate($id);

    /**
     * Get by ID
     * @param $id
     */
    public function findById($id);

    /**
     * Delete by id
     * @param $id
     * @return boolean
     */
    public function delete($id): bool;
}
