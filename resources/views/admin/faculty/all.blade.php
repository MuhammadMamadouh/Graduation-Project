@if(count($faculties)< 1)
    <div class="alert alert-danger col-md-11">There are not any faculties have been added yet</div>
@else
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Fax</th>
            <th scope="col">Telephone</th>
        </tr>
        </thead>
        @foreach($faculties as $faculty)

            <tbody id="faculty-info">

            <tr id="{{$faculty->id}}">

                <th scope="row">{{$faculty->en_name}}</th>
                <td>{{$faculty->fax}}</td>
                <td>{{$faculty->telephone}}</td>
                <td>
                    <a href="{{url("/admin/faculty/$faculty->id")}}" class="btn btn-success">View</a>
                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#faculty-update"
                       id="edit" data-id="{{$faculty->id}}">Edit</a>
                    <a href="#" class="btn btn-danger" id="del"  data-toggle="modal" data-target="#del_diag" data-id="{{$faculty->id}}">x</a>

                </td>
            </tr>
            </tbody>
        @endforeach
    </table>
    {{ $faculties->links() }}
@endif
