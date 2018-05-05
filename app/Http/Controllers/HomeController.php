<?php

namespace App\Http\Controllers;

use App\Goal;
use Illuminate\Http\Request;
use App\Course;
use App\Student;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        //permite
    {
        //tendremos una variable student_count y vamos a entrar a las siguientes relaciones
        $courses=Course::withCount(['students'])->with('category','teacher','reviews')
        ->where('status',Course::PUBLISHED)->latest()->paginate(12);


      return view('home',compact('courses'));

      //$courses=Course::all()->last();
      //echo $courses->students->first()->title;

        /*$studiante=Student::all()->last();

        $cursos=$studiante->courses;
        foreach($cursos as $curso){
            echo $curso->name_curso;
        }*/



    }
}