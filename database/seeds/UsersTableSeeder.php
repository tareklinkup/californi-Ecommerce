<?php

use App\User;
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
        User::create([
            'name' => 'Abu Hasan Shadhin',
            'email' => 'shadhin@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
