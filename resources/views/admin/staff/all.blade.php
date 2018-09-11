@if(count($all_staffs) > 0)

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Academic degree</th>
            <th scope="col">Job</th>
            <th scope="col">Start Date</th>
        </tr>
        </thead>
        @foreach($all_staffs as $staff)
            <tbody id="staff">
            <tr>
                <td>{{$staff->en_name}}</td>
                <td>{{$staff->degree}}</td>
                <td>{{$staff->job}}</td>
                <td>{{$staff->start_date}}</td>
                <td><a href="{{url("/admin/staff/view/$staff->id")}}" class="btn btn-primary">view</a>
                    <a href="#" class="btn btn-danger" id="del" data-id="{{$staff->id}}">x</a>
            </tr>
            </tbody>
        @endforeach
    </table>
    {{ $all_staffs->links() }}

@else
    <br><br>
    <div class="alert alert-danger col-md-9">
        <p>This Department doesn't have any staff</p>
    </div>
@endif
