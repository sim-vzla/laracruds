
<?php

use Test\Model;
use Test\ModelValidator;

class BaseValidatorTest extends Orchestra\Testbench\TestCase
{
    /**
     * @test
     */
    public function dynamicRulesMaking()
    {
        $validator = new ModelValidator(new Model);

        $newRules = $validator->makeRules($validator->rules(1), 1);

        $this->assertFalse(strpos('required', $newRules['email']));
    }

}
