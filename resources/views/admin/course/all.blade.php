@if(count($courses) != 0)
    @foreach($courses as $course)
        <div class="col-sm-4" id="{{$course->code}}">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{$course->en_title}}</h4>
                    {{--<p class="card-text">teacher: {{$course->staff_en_name}}</p>--}}
                    <a href="{{rtrim(\URL::current(), 'courses')}}course/{{$course->code}}" class="btn btn-primary">
                        more details</a>
                    <a href="#" class="btn btn-danger" data-id="{{$course->code}}" id="del"
                       data-toggle="modal" data-id="{{$course->code}}" data-target="#del_diag">
                        <i class="fa fa-trash-o"></i>
                    </a>

                </div>
            </div>
        </div>

    @endforeach
@else
    <div class="col-md-11">
        <div class="alert alert-danger text-center">No courses yet</div>
    </div>
@endif