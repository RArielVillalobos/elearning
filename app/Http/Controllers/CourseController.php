<?php

namespace App\Http\Controllers;

use App\Course;

use Illuminate\Http\Request;


class CourseController extends Controller
{
    //
    public function show(Course $course){
        //dd($courses->name_curso);
        //para cargar las relaciones usamos load y no with
        $course->load([
            'category'=>function($q){
               $q->select('id','name');
            },
            'goals'=>function($q){
               $q->select('id','course_id','goal');
            },
            'level'=>function($q){
                $q->select('id','name');
            },
            'requirements'=>function($q){
                $q->select('id','course_id','requeriment');
            },
            //si no queremos usar select podemos usar, accedemos a todas las review del curso y al usuario al q pertenece
            'reviews.user',
            'teacher'
        ])->withCount(['students','reviews'])->get();
        $related=$course->relatedCourse();
         return view('courses.detail',compact('course','related'));




    }

}
