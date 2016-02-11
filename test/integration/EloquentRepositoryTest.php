
<?php

use Test\Model;
use Test\ModelRepository;

class EloquentRepositoryTest extends Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setup();

        $migrationsPath = realpath('test/database/migrations');
        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--realpath' => $migrationsPath,
        ]);

        $this->testData = [
            'email' => 'test@testing.com',
            'password' => '$2y$10$tDy/6LDmIyIdCwdhlMWOR.a5.QWSxugr5eIBQqX23UGrJ7MrAx5j.'
        ];

        $model = new Model;
        $this->repository = new ModelRepository($model);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup test config
        $app['config']->set('laracruds.validators-path', 'Test');
        $app['config']->set('laracruds.validators-sufix', 'Validator');

        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * @test
     */
    public function create()
    {
        $model = $this->repository->create($this->testData);

        $this->assertInstanceOf('Test\Model', $model);
    }

    /**
     * @test
     */
    public function findById()
    {
        $model = $this->repository->create($this->testData);

        $model = $this->repository->findById($model->id);

        $this->assertInstanceOf('Test\Model', $model);
    }

    /**
     * @test
     */
    public function update()
    {
        $model = $this->repository->create($this->testData);

        $model = $this->repository->update($model, ['password' => '$2y$10$W/OVtk/fY7ffJIdyKxPiCeUMiJi2yMCJQ189/lHPZJwFsuBZn2/d.']);

        $this->assertEquals($model->password, '$2y$10$W/OVtk/fY7ffJIdyKxPiCeUMiJi2yMCJQ189/lHPZJwFsuBZn2/d.');
    }

    /**
     * @test
     */
    public function deleteById()
    {
        $model = $this->repository->create($this->testData);

        $this->assertEquals(1, $this->repository->deleteById($model->id));
    }

    /**
     * @test
     */
    public function batchDelete()
    {
        $first_model = $this->repository->create($this->testData);
        $second_model = $this->repository->create(['email' => 'anothertestemail@test.com',
            'password' => '$2y$10$W/OVtk/fY7ffJIdyKxPiCeUMiJi2yMCJQ189/lHPZJwFsuBZn2/d.'
        ]);

        $this->assertEquals(2, $this->repository->batchDelete([$first_model->id, $second_model->id]));
    }
}
