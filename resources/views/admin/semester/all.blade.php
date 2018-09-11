@if(count($semesters) != 0)
    @foreach($semesters as $semester)
        <div class="col-sm-6">
            <div class="card" id="{{$semester->id}}">
                <div class="card-body">
                    <h4 class="card-title">semester: {{$semester->name}}</h4>
                    <p class="card-text">start date: {{$semester->start_date}}</p>
                    <a href="{{rtrim(\URL::current(), 'semesters')}}semester/{{$semester->id}}" class="btn btn-primary">More
                        details</a>
                    {{--<a href="#" class="btn btn-danger" id="del" data-id="{{$semester->id}}">x</a>--}}
                    <a href="#" id="del"  class="btn btn-danger" data-toggle="modal" data-id="{{$semester->id}}" data-target="#del_diag">
                        <i class="fa fa-fw fa-trash-o "></i>
                        {{--<span>x</span>--}}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-lg">
        <div class="alert alert-danger text-center">No Semesters yet</div>
    </div>
@endif