<?php

namespace App\Controllers\Tests;
use System\Response;

class TestController
{

    public function main()
    {
        return 'Halaman Index';
    }

    public function login()
    {
        return 'Halaman Login';
    }

    public function error()
    {
        return 'Halaman Error';
    }
}