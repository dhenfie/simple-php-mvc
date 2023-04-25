<?php

namespace App\Support\Models;
use App\Support\Facades;

/**
 * @method static bool check()
 * @method static ?stdClass user()
 * @method static void logout()
 * @method static bool attempt(array $credentials)
 */
class Auth extends Facades
{
    public static function getAccessor(): string{
        return 'App\Models\Auth';
    }
}
