<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = \App\UserType::create([
            'name'=> 'admin'
        ]);

        $user = \App\UserType::create([
            'name'=> 'user'
        ]);


        \App\User::create([
            'name' => 'Juan Pérez',
            'email' => 'jperez@example.com',
            'password' => bcrypt('password'),
            'user_types_id' => $admin->id
        ]);

        \App\User::create([
            'name' => 'Ricardo Gómez',
            'email' => 'rgomez@example.com',
            'password' => bcrypt('password'),
            'user_types_id' => $user->id
        ]);
        \App\User::create([
            'name' => 'Carlos Ramirez',
            'email' => 'cramirez@example.com',
            'password' => bcrypt('password'),
            'user_types_id' => $user->id
        ]);
        \App\User::create([
            'name' => 'Miguel Meza',
            'email' => 'mmeza@example.com',
            'password' => bcrypt('password'),
            'user_types_id' => $user->id
        ]);
    }
}
