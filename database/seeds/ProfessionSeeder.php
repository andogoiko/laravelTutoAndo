<?php

use App\Models\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /** el VALUES (?) significa que es un valor dinámico, y laravel nos protege de ataques de inyección */

        //DB::insert('INSERT INTO professions (title) VALUES (?)', ['Desarrollador Back-end']);

        /** esta otra manera también nos protege y es más descriptiva */

        //DB::insert('INSERT INTO professions (title) VALUES (:title)', ['title' => 'Desarrollador Back-end']);

        /*  DB::table('professions')->insert([
            'title' => 'Desarrollador Back-end',
            ]); 
        
            DB::table('professions')->insert([
                'title' => 'Desarrollador Front-end',
            ]);

            DB::table('professions')->insert([
                'title' => 'Diseñador web',
            ]); 
        */

        /* mediante ORM (modelos de laravel) tenemos arriba el use*/

        Profession::create([
            'title' => 'Desarrollador Back-end',
        ]);

        Profession::create([
            'title' => 'Desarrollador Front-end',
        ]);

        Profession::create([
            'title' => 'Diseñador web',
        ]);

        factory(Profession::class)->times(17)->create();

        
    }

    
}
