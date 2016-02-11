<?php

namespace Laracruds\Contracts;

interface RepositoryContract
{

    /**
     * Create an instance of the model.
     *
     * @param  array $data
     * @return $model
     */
    public function create(array $data);

    /**
     * Find the model by it's primary key.
     *
     * @param  mixed $id
     * @return $model
     */
    public function findById($id);

    /**
     * Update the model.
     *
     * @param model $entity
     * @param  array $data
     * @return $model
     */
    public function update($entity, $data);

    /**
     * Delete a model by it's primary key.
     *
     * @param  mixed $id
     * @return bool
     */
    public function deleteById($id);

    /**
     * Batch deletes models.
     *
     * @param  array $idArray
     * @return int
     */
    public function batchDelete(array $idArray);
}
