<?php

namespace Laracruds;

use Illuminate\Support\Facades\Validator;

abstract class BaseValidator
{
    protected $class;

    protected $errors;

    public function __construct($class, array $data = null)
    {
        $this->class = $class;

        if ($data) {
            return $this->validate($data);
        }
    }

    public function validate(array $data)
    {
        if ($this->validator($data)->fails()) {
            $this->errors = $this->validator($data)->getMessageBag();
            return false;
        }

        return true;
    }

    /**
     * return the errors detected by the validator.
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors ? $this->errors->toArray() : null;
    }

    /**
     * Removes required rules from rules array.
     * The rule should be always the first one.
     *
     * @param  array $rulesArray
     * @param  int $id
     * @return array
     */
    public function makeRules($rulesArray, $id)
    {
        if (! empty($id)) {
            return array_map(function ($rule) {
                return str_replace('required|', '', $rule);
            }, $rulesArray);
        }
        return $rulesArray;
    }

    /**
     * return a Validator class instance.
     *
     * @param  array  $data
     * @return Validator
     */
    public function validator(array $data)
    {
        $keyname = $this->class->getKeyName();
        $id = array_key_exists($keyname, $data) ? ','.$data[$keyname]  : "";
        return Validator::make($data, $this->makeRules($this->rules($id), $id));
    }
}
