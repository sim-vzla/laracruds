<?php

namespace Test;

use Test\Model;
use Laracruds\EloquentRepository;

class ModelRepository extends EloquentRepository
{
	public function __construct()
	{
		parent::__construct(new Model);
	}
}
