<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->truncateTables([
            'users',
            'professions'
        ]);

        /* llamamos a las semillas que hemos creado */
        $this->call(ProfessionSeeder::class);
        $this->call(UserSeeder::class);
    }

    /** método para eliminar los datos de las databases que mandemos */

    protected function truncateTables(array $tables)
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }



        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
