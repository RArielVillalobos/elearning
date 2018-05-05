<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCourseStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //creando tabla muchos a muchos
        //se crea con el nombre de las dos tablas relacionadas en miniscula
        //en orden alfabetico, con esto laravel sabe que tabla tiene que buscar
        Schema::create('course_student',function(Blueprint $table){
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('course_student');
    }
}
