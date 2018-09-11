@foreach($departments as $department)
    <div class="col-sm-6" id="{{$department->id}}">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title bg-white">{{$department->en_name}}</h3>
                <a href="{{url("/admin/faculty/$faculty->id/department/$department->id")}}"
                   class="btn btn-primary">View</a>
                <a href="#" class="btn btn-danger" id="del" data-id="{{$department->id}}">x</a>
            </div>
        </div>
    </div>
@endforeach