<?php
namespace App\Controllers;

use App\Support\Models\Auth;
use System\View\View;

class HomeController
{
    public function main()
    {
        return View::render('home.php', ['user' => Auth::user()]);
    }

    public function about()
    {
        return 'Halaman About';
    }
}
