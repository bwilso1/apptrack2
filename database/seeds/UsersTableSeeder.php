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
        DB::table('users')->insert([
            'name' => 'Arvin Siva',
            'email' => 'sivaar1@umbc.edu',
            'password' => bcrypt('cmsc447'),
            'role' => 'admin',
        ]);
    }
}
