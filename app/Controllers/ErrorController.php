<?php
namespace App\Controllers;
use System\Response\Response;

class ErrorController
{

    public function error()
    {
        return new Response(404, 'Halaman tidak di temukan');
    }
}