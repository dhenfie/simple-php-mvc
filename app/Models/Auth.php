<?php

namespace App\Models;

use App\Models\User;
use stdClass;

class Auth
{
    /** @var User */
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Proses pemeriksaan login
     *
     * @param array $credentials sebuah array assosiatif berupa informasi kredensial seperti email dan password
     *
     * @return bool Returns true jika otentikasi berhasil atau false jika gagal
     */
    public function attempt(array $credentials) : bool
    {
        $user = $this->userModel->getUserByColumn('email', $credentials['email']);
        if (is_null($user)) {
            return false;
        } else {

            if (password_verify($credentials['password'], $user->password)) {

                $_SESSION['_ID']    = $user->id;
                $_SESSION['_EMAIL'] = $user->email;
                return true;
            }
            return false;
        }
    }

    /**
     * Cek pengguna apakah sudah dalam posisi login
     *
     * @return bool
     */
    public function check() : bool
    {
        if (isset($_SESSION['_ID']) && isset($_SESSION['_EMAIL'])) {
            return true;
        }

        return false;
    }

    /**
     * Mengembalikan object user yang sedang aktif dalam posisi sudah login
     * jika tidak akan mengembalikan null
     *
     * @return ?stdClass
     */
    public function user() : ?stdClass
    {
        if ($this->check()) {
            $id   = $_SESSION['_ID'];
            $user = $this->userModel->findById($id);
            return $user;
        }
        return null;
    }

    /**
     * Logout user dan hapus semua data session dan cookie
     */
    public function logout() : void
    {
        unset($_SESSION);
        session_unset();
        session_destroy();
    }
}
