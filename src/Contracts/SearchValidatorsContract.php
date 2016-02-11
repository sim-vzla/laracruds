<?php

namespace Laracruds\Contracts;

interface SearchValidatorsContract
{
    /**
     * Gets an instance of the validator class using the class name
     * as search parameter.
     *
     * @param  mixed $class
     * @return $validator
     */
    public function getValidatorFromClass($class);
}
