<?php

namespace Test;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{

	protected $table = 'users';

	protected $connection = 'testbench';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [

    ];

}
