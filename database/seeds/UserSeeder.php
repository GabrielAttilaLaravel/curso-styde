<?php

use App\Models\Profession;
use App\User;
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
        //$professions = DB::select('SELECT id FROM professions WHERE title = ?', ['Desarrollador back-end']);

        $professionId = Profession::whereTitle('Desarrollador back-end')->value('id');

        User::create([
            'name' => 'GabrielAttila',
            'email' => 'gabrieljmorenot@gmail.com',
            'password' => bcrypt('123'),
            'profession_id' => $professionId,
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Milagros Silva',
            'email' => 'silvasuarez.silva@gmail.com',
            'password' => bcrypt('123'),
            'profession_id' => $professionId,
        ]);

        User::create([
            'name' => 'Gabriel Alexander',
            'email' => 'gabrielamorenos@gmail.com',
            'password' => bcrypt('123'),
        ]);
    }
}
