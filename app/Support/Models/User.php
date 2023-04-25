<?php
namespace App\Support\Models;

use App\Support\Facades;

/**
 * @method static stdClass|false create(array $attributes = [])
 * @method static bool delete(int $id)
 * @method static bool update(int $id, array $attributes = [])
 * @method static ?stdClass findById(int $id)
 * @method static ?array findAll()
 * @method static ?stdClass getUserByColumn(string $column, string $value)
 */
class User extends Facades
{
    public static function getAccessor() : string
    {
        return 'App\Models\User';
    }

}
