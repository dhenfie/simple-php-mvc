<?php
namespace Tests;

use System\Routing\Route;

class RouteTest extends TestCase
{

    public function tearDown() : void
    {
        Route::reset();
    }

    public function testGetRouteIndexPage()
    {
        Route::add('/', 'testIndex');
        Route::add('other', 'testOther');
        self::assertEquals(array('_path' => '/', '_handler' => 'testIndex'), Route::getRouteIndexPage());
    }

    public function testGetRouteErrorPage()
    {
        Route::add('/', 'testIndex');
        Route::setError('TestError');

        self::assertEquals(['_path' => '_error', '_handler' => 'TestError'], Route::getRouteErrorPage());
    }

    public function testSetNamespace()
    {
        Route::setNamespace('App\\Controllers\\');
        self::assertEquals('App\\Controllers\\', Route::getNamespace());
    }

    public function testRegexPattern()
    {
        $request = '/auth/login';
        $pattern = '/auth/login';
        $matches = preg_match('#^' . $pattern . '$#', $request, $result);
        // self::dump($result);
        self::assertTrue((bool) $matches);
    }

    public function testGetRouteFromPath()
    {
        Route::add('/', 'HomeController::main');
        Route::add('auth/login', 'AuthController::login');
        Route::add('auth/register', 'AuthController::register');
        $collection = Route::getRoutes();

        $getRoute = function (string $path) use ($collection) {
            foreach ($collection as $route) {
                if ($route['_path'] === $path) {
                    return $route;
                }
            }
            return null;
        };

        // self::dump($getRoute('/'));
        self::assertEquals(array('_path' => '/', '_handler' => 'HomeController::main'), $getRoute('/'));

        self::assertEquals(array('_path' => '/', '_handler' => 'HomeController::main'), Route::getRouteFromPath('/'));
    }

    public function testParseController()
    {
        $controller = 'HomeController::main';
        $split = explode('::', $controller);
        self::assertIsArray($split);
    }

    public function testMatcher()
    {
        Route::add('auth/login', 'AuthController::login');
        Route::add('/', 'HomeController::main');
        Route::add('auth/register', 'AuthController::register');

        self::assertTrue(Route::matcher('/'));
    }

    public function testExecute()
    {

        Route::setNamespace('App\\Controllers\\Tests\\');
        Route::add('/auth-login', 'TestController::login');
        Route::add('/', 'TestController::main');
        Route::setError('TestController::error');

        $_SERVER['PATH_INFO'] = 'auth-login';
        self::assertEquals('Halaman Login', Route::launch());

        $_SERVER['PATH_INFO'] = '/';
        self::assertEquals('Halaman Index', Route::launch());

        $_SERVER['PATH_INFO'] = '/test-notdoud';
        self::assertEquals('Halaman Error', Route::launch());
    }
}
