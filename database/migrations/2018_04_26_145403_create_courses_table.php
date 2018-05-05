<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('level_id')->unsigned();
            $table->foreign('level_id')->references('id')->on('levels');
            $table->string('name_curso');
            $table->text('description');
            $table->string('slug');
            $table->string('picture')->nullable();
            $table->enum('status',[\App\Course::PUBLISHED,\App\Course::PENDING,\App\Course::REJECTED])
                ->default(App\Course::PENDING);
            $table->boolean('previus_approved')->default(false);
            $table->boolean('previus_rejected')->default(false);
            $table->timestamps();
            //crea una columna(deleted_at) , a traves de un trait(softDelete) de laravel va a saber si el curso esta eliminado o no
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
