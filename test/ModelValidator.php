<?php

namespace Test;

use Laracruds\BaseValidator;

class ModelValidator extends BaseValidator
{
    public function rules($id)
    {
        return [
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:6'
        ];
    }
}