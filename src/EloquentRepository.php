<?php

namespace Laracruds;

use Exception;
use Laracruds\Traits\SearchValidators;

abstract class EloquentRepository
{
    use SearchValidators;

    protected $model;

    protected $validator;

    public function __construct($model, $validator = null)
    {
        $this->model = $model;
        $this->validator = $validator != null ? $validator :
            $this->getValidatorFromClass($model);
    }

    public function create($data)
    {
        if (!$this->validator->validate($data)) {
            throw new Exception("Invalid data parameters");
        }
        return $this->model->create($data);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function update($entity, $data)
    {
        if (!$this->validator->validate(array_merge($data, [$entity->getKeyName() => $entity->id]))) {
            throw new Exception("Invalid data parameters");
        }

        $entity->fill($data)->save();
        return $entity;
    }

    public function deleteById($id)
    {
        return $this->model->destroy($id);
    }

    public function batchDelete($idArray)
    {
        return $this->model->destroy($idArray);
    }

    /**
     * Returns the validator instance.
     *
     * @return Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }
}
