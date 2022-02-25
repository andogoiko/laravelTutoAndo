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

        //$profesiones = DB::select('SELECT id FROM professions WHERE title =  ?', ['Desarrollador Back-end']);

        //$profesion = DB::table('professions')->select('id')->where('title', '=', 'Desarrollador Back-end')->first();

        //$profesion = DB::table('professions')->select('id')->where(['title' => 'Desarrollador Back-end'])->first();

        //$profesionId = DB::table('professions')->where('title', 'Desarrollador Back-end')->value('id');

        //$profesionId = DB::table('professions')->whereTitle('Desarrollador Back-end')->value('id'); //whereX es un método mágico, que interpreta el X como el campo en el que buscar la condición


        /* DB::table('users')->insert([
            'name' => 'Paco',
            'email' => 'Paquisimo@gmail.com',
            'password' => 'Paco',
            //'profession_id' => $profesion->id,
            'profession_id' => $profesionId,
        ]); */

        /* con el ORM modelo elocuente de laravel */

        $profesionId = Profession::where('title', 'Desarrollador Back-end')->value('id');

        /* User::create([
            'name' => 'Paco',
            'email' => 'Paquisimo@gmail.com',
            'password' => 'Paco',
            //'profession_id' => $profesion->id,
            'profession_id' => $profesionId,
        ]); */

        /** a la hora de crear mediante factory introduce también el profession_id */


        factory(User::class)->create([
            'name' => 'Paco',
            'email' => 'Paquisimo@gmail.com',
            'password' => 'Paco',
            'profession_id' => $profesionId,
            'is_admin' => true,
        ]);

        factory(User::class)->create([
            'profession_id' => $profesionId
        ]);

        factory(User::class, 48)->create();

        
    }
}
