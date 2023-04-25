<?php
namespace App\Controllers;

use App\Support\Models\Auth;
use System\View\View;

class AuthController
{

    public function login() : string
    {
        if (Auth::check()) {
            header('Location: /');
            exit;
        }

        $error = '';

        if (isset($_POST['submit'])) {

            $email    = trim(strip_tags($_POST['email']));
            $password = strip_tags($_POST['password']);

            if (empty($email) || empty($password)) {
                $error = 'Email atau password tidak boleh kosong.';
            } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Email tidak valid.';
            }

            if (empty($error)) {
                $credentials = ['email' => $email, 'password' => $password];

                if (Auth::attempt($credentials)) {
                    header('Location: /');
                    exit;

                } else {
                    $error = 'Email atau password salah.';
                }
            }
        }

        return View::render('login.php', ['error' => $error]);
    }

    public function logout()
    {
        Auth::logout();
        header('Location: /auth/login');
        exit;
    }
}
