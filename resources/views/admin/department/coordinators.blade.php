@extends('adminlte::page')
@section('title', 'Coordinators')
@section('content')

    <h3 class="text-center">Coordinators</h3>
    <br>
    @if(count($coordinators) > 0)

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Academic degree</th>
                <th scope="col">Job</th>
                <th scope="col">Start Date</th>
            </tr>
            </thead>
            @foreach($coordinators as $staff)
                <tbody id="staff">
                <tr>
                    <td>{{$staff->en_name}}</td>
                    <td>{{$staff->degree}}</td>
                    <td>{{$staff->job}}</td>
                    <td>{{$staff->start_date}}</td>
                    <td>
                        <a href="{{url("/admin/staff/view/$staff->id")}}" class="btn btn-primary">view</a>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
        {{ $coordinators->links() }}

    @else
        <br><br>
        <div class="alert alert-danger col-md-9">
            <p>This Department Doesn't Have Any Staff</p>
        </div>
    @endif


@endsection
@section('script')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection