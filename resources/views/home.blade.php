@extends('layouts.app')
@section('jumbotron')
    @include('partials.jumbotron',['title'=>__("Accede a este Curso"),
                                   "icon"=>"th"])
@endsection

@section('content')
<div class="pl-5 pr-5">
    <div class="row justify-content-center">

        @forelse( $courses as $course)
         {{-- Si existen cursos ejecutaremos esto--}}

            <div class="col-md-3">
               @include('partials.courses.card_course')
            </div>



        @empty
         {{-- si esta vacio ejecutaremos esto --}}
            <div class="alert alert-dark">
                {{__("no hay ningun curso disponible")}}

            </div>

        @endforelse
    </div>
        <div class="row justify-content-center">
            {{$courses->links()}}

        </div>

</div>
@endsection
