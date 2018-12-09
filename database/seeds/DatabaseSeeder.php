<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'professions',
            'users'
        ]);

        // $this->call(UsersTableSeeder::class);
        $this->call(ProfessionSeeder::class);
        $this->call(UserSeeder::class);
    }

    public function truncateTables(array $tables)
    {
        // desactivamos proceso de revision de las claves foraneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // Vaciamos la tabla de profesiones
        foreach ($tables as $table){
            DB::table($table)->truncate();
        }
        // activamos proceso de revision de las claves foraneas
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
