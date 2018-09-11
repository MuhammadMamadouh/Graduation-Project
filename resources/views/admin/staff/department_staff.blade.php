@extends('adminlte::page')
@section('title', 'all Staff')
@section('content')
    @include('admin.staff.add')
    @include('admin.department.admin.add')

    <h2 class="text-center text-dark">Staff of <b> {{$department->en_name }}</b> Department</h2>
    <div class="">
        <h3>Admin</h3>
    </div>

    @if($admin == null)
        <div class="">
            <p>This department has not admin yet. You can Add Admin here</p>
            <button class="btn btn-danger" id="changeAdmin" data-toggle="modal" data-target="#add_admin">
                Add Admin
            </button>
        </div>
    @else
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Mobile</th>
                <th scope="col">Email</th>
            </tr>
            </thead>

            <tbody id="admins">

            <tr id="{{$admin->id}}">

                <th scope="row">{{$admin->en_name}}</th>
                <td>{{$admin->mobile}}</td>
                <td>{{$admin->email}}</td>
                <td>
                    <a href="{{url("/admin/staff/view/$admin->id")}}" class="btn btn-info">View</a>
                    <button class="btn btn-danger" id="changeAdmin" data-toggle="modal" data-target="#add_admin">
                        change
                    </button>

                </td>
            </tr>
            </tbody>
        </table>
    @endif
    <br>
    <div class="" style="overflow: hidden">
        <h2 class="pull-left">Staff</h2><br>
    </div>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_staff">
            Add Staff
        </button>
    </div>
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

@endsection
@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#ins_staff').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json'
            })
                .done(function (data) {
                    console.log(data);
                    window.location.href = '{{url("/")}}/admin/staff/view/' + data.id;
                })
                .fail(function (data) {
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#add-error').text(val)
                    })
                })
        });
        // --------------------- delete Staff-----------------------------
        $('body').delegate('#staff #del', 'click', function (e) {
            var id = $(this).data('id');
            $.ajax({
                type: 'post',
                url: '{{url("/")}}/admin/staff/delete',
                data: {id: id, "_token": "{{ csrf_token() }}"},

                success: function (data) {
                    console.log('success');
                    $('#staff tr#' + id).remove();
                },
                error: function (data) {
                    console.log('fail');
                }
            })
        });

    </script>
@endsection