@if(count($programs) >0)
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th></th>
            <th scope="col"> Name</th>
            <th scope="col"> Duration</th>
            <th scope="col"> Type</th>
        </tr>
        </thead>
        <tbody id="program-info">

        @foreach($programs as $program)
            <tr id="{{$program->id}}">
                <td></td>
                <td scope="row">{{$program->en_name}}</td>
                <td>{{$program->duration}} years</td>
                <td>{{$program->type}}</td>
                <td>
                    <a href="{{rtrim(\URL::current(), 'programs')}}program/{{$program->id}}"
                       class="btn btn-info">View</a>
                    <a href="#" class="btn btn-danger" id="del" data-toggle="modal" data-target="#del_diag" data-id="{{$program->id}}">x</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-danger text-center">
        <h3>This Department has not any programs yet
        </h3>
    </div>
@endif