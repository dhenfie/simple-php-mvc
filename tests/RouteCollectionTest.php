<?php
namespace Tests;
use System\Routing\Collection;

class RouteCollectionTest extends TestCase
{
    private Collection $collection;

    public function setUp(): void {
        $this->collection = new Collection();
    }

    public function testAdd(){
        $this->collection->add('/', 'TestController::main');
        $this->collection->add('auth/login', 'TestController::login');
        self::assertEquals([
            ['_path' => '/', '_handler' => 'TestController::main'],
            ['_path' => 'auth/login','_handler' => 'TestController::login']
        ], $this->collection->getRoutes());
    }

    public function testNotDuplicatePath(){
        $this->collection->add('auth/login', 'TestController::main');
        $this->collection->add('auth/login', 'TestController::main');
        self::assertEquals([['_path' => 'auth/login', '_handler' => 'TestController::main']], $this->collection->getRoutes());
    }

    public function testIsExist(){
        $this->collection->add('auth/login', 'TestController::login');
        $this->collection->add('auth/register', 'TestController::login');
        $column = array_column($this->collection->getRoutes(), '_path');
        self::assertTrue(in_array('auth/login', $column));
    }

    public function testAddErrorPath(){
        $this->collection->setError('TestController::error');
        self::assertEquals([['_path' => '_error', '_handler' => 'TestController::error']], $this->collection->getRoutes());
    }
}
