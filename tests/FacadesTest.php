<?php
namespace Tests;

use App\Support\Models\User;
use Tests\TestCase;

class FacadesTest extends TestCase
{

    public function testSingleton()
    {
        $token1 = User::getInstance();
        $token2 = User::getInstance();
        self::assertSame($token1, $token2);
    }
}
