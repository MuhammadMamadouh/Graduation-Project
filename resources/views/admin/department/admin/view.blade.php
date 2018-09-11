@extends('adminlte::page')
@section('title', 'Admins')
@include('admin.department.admin.add')
@section('content')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_admin">
        Add New Admin
    </button>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Mobile</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        @foreach($admins as $admin)

            <tbody id="admins">

            <tr id="{{$admin->id}}">

                <th scope="row">{{$admin->en_name}}</th>
                <td>{{$admin->mobile}}</td>
                <td>{{$admin->email}}</td>
                <td>
                    <a href="{{url("/admin/staff/$admin->id")}}" class="btn btn-info">View</a>
                    <button class="btn btn-danger" id="del" data-id="{{$admin->id}}">x</button>

                </td>
            </tr>
            </tbody>
        @endforeach
    </table>
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        $('#faculties').change(function () {
            $('#departs').empty();
            $('#staff').empty();

            var selected = $(this).find('option:selected').attr('value');
            var url = '{{url("/")}}/admin/department/view-all/f=' + selected;
            $.get(url, function (data) {
                $('#departs').empty().append(data)
            });
            $('#departs').change(function () {
                var selected = $(this).find('option:selected').attr('value');
                var url = '/admin/staff/view-all/d=' + selected;
                $.get(url, function (data) {
                    $('#staff').empty().append(data)

                })
            });
            $('#staff').change(function () {
                var selected = $(this).find('option:selected').attr('value');
                console.log(selected)

            });
        })

        // --------------------- delete faculty-----------------------------
        // $('body').delegate('#admins #del', 'click', function (e) {
        //     var id = $(this).data('id');
        //     console.log(id)
        //     $.post('/admin/remove', {id:id},  function (data) {
        //
        //     })
        // });

        // --------------------- delete faculty-----------------------------
        $('body').delegate('#admins #del', 'click', function (e) {
            var id = $(this).data('id');

            $.ajax({
                type: 'post',
                url: '/admin/remove',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {id: id, "_token": "{{ csrf_token() }}"},

                success: function (data) {
                    console.log('success');
                    window.reload
                },
                error: function (data) {
                    console.log('fail');
                    window.location.reload()
                }
            })
        });
    </script>
@endsection