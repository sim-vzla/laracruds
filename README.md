##Laracruds
####A repository pattern helpers and validators for Laravel Framework

This package can help you be more productive when writing cruds for eloquent models providing you with a simple but powerful set of tools.

#####Instalation


#####Usage
Lets say you wanna create a User model repository. Well then just extend the base repository class of the package:

```php
	<?php

	namespace App\Repositories;

	use Laracruds\EloquentRepository as BaseRepository;

	use App\User;

	class UserRepository extends BaseRepository
	{
		public function __construct()
		{
			parent::__construct(new User);
		}
	}

```

This class have some CRUD methods for you:

- create($data)

- findById($id)

- update($model, $data)

- deleteById($id)

- batchDelete($idArray)

You can find more info about them in the api reference.

Till now everything is pretty standard, but here comes the magic:

The EloquentRepository class takes an optional second parameter that expects and instance of `Laracruds\BaseValidator` to validate the data in the create and update methods. But if you don't provide one the class is gonna use the name of the model class and its gonna try to find one for you (using the parameters contained in the config file).

So by default if your passing an instance of `App\User` to the constructor of EloquentRepository the class is gonna assume there is a `UserValidator` located in `App\Helpers\Validators' folder.

#####Validation

A validation class is gonna look like this:

```php

	<?php

	namespace App\Helpers\Validators;

	use Laracruds\BaseValidator;

	class UserValidator extends BaseValidator
	{
	    public function rules($id)
	    {
	        return [
	            'email' => 'required|email|unique:users,email,'.$id,
	            'password' => 'required|min:6'
	        ];
	    }
	}

```

You just need to put the rules (from the ones availables by defult in laravel) you wanna apply in the ```rules()``` method, Laracruds is gonna take of using them when needed.

But we wanna be able to use the same rules array for creation and update. So thats leaves us with the problem of required and unique rules... Dont worry... we already solved this for you:
When the ```validate()``` method of the ```BaseValidator``` class is called in the update method all the ```required``` rules are removed dinamically from the array, just be sure to make it the first rule you declare in they keys that use it:

	'email' => 'required|email',
	'name' => 'required|string'

and to avoid the unique rules on update you just need to append the $id parameter received automatically by the ```rules()``` function to the end of the array key. Just be sure to place the unique rule at the end of the key like this:

		public function rules($id)
	    {
	        return [
	            'email' => 'required|email|unique:users,email,'.$id,
	            'password' => 'required|min:6'
	        ];
	    }

To get validation errors just retrive the validator from the repository class with the ```getValidator()``` method:

	$validator = $repository->getValidator()

and then call the errors method:

	$validator->errors();
