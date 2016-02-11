<?php

namespace Laracruds\Traits;

trait SearchValidators
{
    protected function getValidatorFromClass($class)
    {
        $className = get_class($class);

        $validatorClassName = app()['config']['laracruds']['validators-path'].'\\'.
            explode("\\", $className)[1]. app()['config']['laracruds']['validators-sufix'];

        $validatorClass = new $validatorClassName($class);

        return $validatorClass;
    }
}
