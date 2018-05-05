<div class="card card-01">
    <img class="card-img-top"
         src="{{$course->patchAttachament()}}"
         alt="{{$course->name_curso}}"
    >
    <div class="card-body">
        <span class="badge-box">
            <i class="fa fa-check"></i>
        </span>
        <h4 class="card-title">{{$course->name_curso}}</h4>
        <hr />
        <div class="row justify-content-center">
            {{-- AÑADIR PARCIAL PARA MOSTRAR EL RATING--}}

            @include('partials.courses.raint')

        </div>
        <hr />
        <span class="badge badge-danger badge-cat">{{$course->category->name}}</span>
        <p class="card-text">
            {{str_limit($course->description,100)}}

        </p>
        <a href="#" class="btn btn-course btn-block">{{__("Mas infomacion")}}</a>
    </div>

</div>