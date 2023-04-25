<?php

namespace Tests;

use System\Response\Response;

class ResponseTest extends TestCase
{
    public function testOutput()
    {
        self::expectOutputString('Hello World');
        echo new Response(200, 'Hello World');
    }

    public function testOutputSend()
    {
        self::expectOutputString('Hello World');
        $response = new Response();
        $response->setContentType('text/html');
        $response->setHttpCode(200);
        $response->setMessage('Hello World');
        echo $response->send();
    }
}
