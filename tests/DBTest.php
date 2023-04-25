<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use System\Database\DB;

class DBTest extends TestCase
{
    // test singleton instance dari class DB
    public function testSingletonInstance()
    {
        $instance  = DB::connect();
        $instance2 = DB::connect();

        self::assertSame($instance, $instance2);
    }

    /**
     * Generate perintah SQL untuk insert data
     *
     * @return void
     */
    public function testGenerateSQLForInsert()
    {
        // Define the table and columns to insert data into.
        $tableExample  = 'users';
        $columnExample = [
            'email',
            'password',
            'first_name',
            'last_name',
            'age',
            'about',
            'created_at',
            'updated_at'
        ];

        $columnString      = rtrim(implode(', ', $columnExample), ',');
        $columnPlaceHolder = ':' . rtrim(implode(', :', $columnExample), ',');

        $querySQL = 'INSERT INTO ' . $tableExample . ' (' . $columnString . ')' . ' VALUES ' . '(' . $columnPlaceHolder . ')';

        // Ekspetasi
        $expected = 'INSERT INTO users (email, password, first_name, last_name, age, about, created_at, updated_at) VALUES (:email, :password, :first_name, :last_name, :age, :about, :created_at, :updated_at)';

        self::assertEquals($expected, $querySQL);
    }

    public function testGenerateSQLForUpdate()
    {

        $tableExample  = 'users';
        $columnExample = [
            'email',
            'password',
            'first_name',
            'last_name',
            'age',
            'about',
            'created_at',
            'updated_at'
        ];

        $generatePlaceholder = function (array $attributes) {
            $columnPlaceholder = '';
            foreach ($attributes as $index => $column) {
                if ($index === 0) {
                    $columnPlaceholder = 'SET ' . $column . ' = :' . $column;
                    continue;
                }
                $columnPlaceholder .= ', ' . $column . ' = :' . $column;
            }
            return $columnPlaceholder;
        };

        $columnPlaceholder = $generatePlaceholder($columnExample);
        $querySQL          = 'UPDATE ' . $tableExample . ' ' . $columnPlaceholder . ' WHERE id = :id';

        $expected = 'UPDATE users SET email = :email, password = :password, first_name = :first_name, last_name = :last_name, age = :age, about = :about, created_at = :created_at, updated_at = :updated_at WHERE id = :id';

        // print_r($querySQL);
        self::assertEquals($expected, $querySQL);
    }
}
