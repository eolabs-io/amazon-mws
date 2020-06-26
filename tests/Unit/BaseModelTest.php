<?php

namespace EolabsIo\AmazonMws\Tests\Unit;

use EolabsIo\AmazonMws\Tests\Concerns\RequiresModelFactories;
use EolabsIo\AmazonMws\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;

abstract class BaseModelTest extends TestCase
{
	use RefreshDatabase,
        RequiresModelFactories;

    public function setUp(): void
    {
        parent::setUp();

        $this->seedDatabase();
    }

    public function seedDatabase()
    {
        
    }

   /** @test */
    public function it_can_find_models()
    {
        $modelsInDb = $this->factory(10)->create();
        $modelClass = $this->getModelClass();

        $models = $modelClass::All();

        $this->assertArraysEqual($models->toArray(), $modelsInDb->toArray());
    }

   /** @test */
    public function it_can_create_a_model()
    {
        $data = $this->factory()->make()->toArray();
        $modelClass = $this->getModelClass();

        $model = $modelClass::create($data);
        $table = $model->getTable();
        
        $this->assertInstanceOf($modelClass, $model);
        $this->assertDatabaseHas($table, $model->toArray());
    }

    /** @test */
    public function it_can_find_a_model()
    {
        $model = $this->factory()->create();
        $primaryKey = $this->getPrimaryKeyValue($model);
        $modelClass = $this->getModelClass();

        $found = $modelClass::find($primaryKey);
        
        $this->assertInstanceOf($modelClass, $found);
        $this->assertEquals($found->toArray(), $model->toArray());
    }

    /** @test */
    public function it_can_update_a_model()
    {
        $model = $this->factory()->create();
        $table = $model->getTable();
        $data = $this->removePrimaryKeyFromModel( $this->factory()->make() );

        $update = $model->update($data);

        $this->assertTrue($update);
        $this->assertDatabaseHas($table, $model->toArray());
    }


    /** @test */
    public function it_can_delete_a_model()
    {
        $model = $this->factory()->create();
        $table = $model->getTable();

        $model->delete();

        $this->assertDatabaseMissing($table, $model->toArray());
    }

    // Helpers //
    public function assertArraysEqual($array1, $array2){

        $sortedArray1 = Arr::sortRecursive($array1);
        $sortedArray2 = Arr::sortRecursive($array2);

        // return
        $this->assertEquals($sortedArray1, $sortedArray2);
    }
}
