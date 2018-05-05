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
        // $this->call(UsersTableSeeder::class);
        //cuando ejecutemos el seed queremos que se borre todo y empieze de nuevo
        Storage::deleteDirectory('courses');
        Storage::deleteDirectory('users');

        Storage::makeDirectory('courses');
        Storage::makeDirectory('users');
        //el parametro 1 significa que solamente creamos uno de cada uno
        factory(\App\Role::class,1)->create(['name'=>'admin']);
        factory(\App\Role::class,1)->create(['name'=>'teacher']);
        factory(\App\Role::class,1)->create(['name'=>'student']);

        factory(\App\User::class,1)->create([
                'name'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('secret'),
                 'id_role'=>\App\Role::ADMIN,

        ])->each(function(\App\User $u){
                factory(\App\Student::class,1)->create([
                    'user_id'=>$u->id
                ]);
        });
        //por cada usuario que cree relacionale un studiante
        factory(\App\User::class,50)->create()
            ->each(function (\App\User $u){
                factory(\App\Student::class,1)->create([
                    'user_id'=>$u->id
                ]);
            });

        //creamos 10 usuarios nuevos para cada uno de ellos,cremoa una relacion con un estudiant y un profe
        factory(\App\User::class,10)->create()
            ->each(function (\App\User $u){
                factory(\App\Teacher::class,1)->create(['user_id'=>$u->id]);
                factory(\App\Student::class,1)->create(['user_Id'=>$u->id]);
            });
        factory(\App\Level::class,1)->create(['name'=>'Begginer']);
        factory(\App\Level::class,1)->create(['name'=>'Intermediate']);
        factory(\App\Level::class,1)->create(['name'=>'Advanced']);
        //creamos 5 categorias aleatoreas
        factory(\App\Category::class,5)->create();

        //cada vez que cree un curso, va a crear dos metas en la tabla goals
        factory(\App\Course::class,50)->create()->each(function(\App\Course $c){
            $c->goals()->saveMany(factory(\App\Goal::class,2)->create());
            $c->requeriments()->saveMany(factory(\App\Requeriment::class,4)->create());
        });


    }
}
