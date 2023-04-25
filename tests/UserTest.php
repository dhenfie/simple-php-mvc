<?php

namespace Tests;

use App\Support\Models\User;

class UserTest extends TestCase
{
    public function testUserCreate()
    {
        self::markTestSkipped();

        $user = User::create([
            'email'      => 'john.doe@example.com',
            'password'   => password_hash('password', PASSWORD_DEFAULT),
            'first_name' => 'john',
            'last_name'  => 'doe',
            'age'        => 23,
            'about'      => 'web developer..',
            'created_at' => time(),
            'updated_at' => 0
        ]);

        print_r($user);
    }

    public function testUserDelete()
    {
        self::markTestSkipped();

        $user = User::delete(29);

        print_r($user);
    }

    public function testUpdate()
    {
        self::markTestSkipped();

        $user = User::update(30, ['email' => 'elon.musk@example.com', 'first_name' => 'elon', 'last_name' => 'musk']);

        print_r($user);
    }

    public function testFindById()
    {
        self::markTestSkipped();

        $user = User::findById(30);

        print_r($user);
    }

    public function testFindByAll()
    {
        self::markTestSkipped();

        $user = User::findAll();
        print_r($user);
    }
}
