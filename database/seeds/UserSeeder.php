<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'GabrielAttila',
            'email' => 'gabrieljmorenot@gmail.com',
            'password' => bcrypt('123'),
            //'profession_id' =>
        ]);
    }
}
