@extends('adminlte::page')
@section('title', "$faculty->en_name")
@section('sidebar')
    <li class="treeview" id="aim">

        <a href="#">
            <i class="fa fa-fw fa-circle-o "></i>
            <span> Grades Percentage</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
        </a>
        <ul class="treeview-menu">
            <li class="">
                <a href="{{route('viewFacultyGrades', ['id' => $faculty->id])}}">
                    <i class="fa fa-fw fa-circle-o "></i>
                    <span>view</span>
                </a>
            </li>
        </ul>
    </li>
@endsection
@section('content')
    @include('admin.department.add')
    <div class="container">
        <p id="msg" style="display: none" class="alert alert-success col-sm-4 pull-right"></p>
        <h2 class="text-center text-info pull-left">
            Faculty of <b>{{$faculty->en_name}}</b> Information</h2>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Fax</th>
                <th scope="col">Telephone</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$faculty->en_name}}</td>
                <td>{{$faculty->fax}}</td>
                <td>{{$faculty->telephone}}</td>
            </tr>
            </tbody>
        </table>

        <h2 class="text-center text-info">Departments</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_depart">
            Add Department
        </button>

        <a class="btn btn-primary" href="{{url("admin/faculty/$faculty->id/aims")}}">View aims</a>
        <div id="departs" class="faculty-departs">

        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                                    $('#departs').load('<?php echo url("/admin/faculty/$faculty->id/departments")?>');

        $(document).ready(function () {

            $('#ins_depart').on('submit', function (e) {
                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                //

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json'
                })
                    .done(function (data) {
                        $('#add_depart').modal('hide');
                        $('#msg').show();
                        $('#msg').html('Department has been added successfully');
                            $('#departs').load('<?php echo url("/admin/faculty/$faculty->id/departments")?>');

                        $('#msg').fadeOut(2000);

                    })
                    .fail(function (data) {
                        $.each(data.responseJSON, function (index, val) {
                            console.log(val)
                            $('#add-error').text(val)
                        })
                    })
            });


            // --------------------- Delete department-----------------------------
            $('body').delegate('#departs #del', 'click', function (e) {
                var id = $(this).data('id');
                $.ajax({
                    type: 'post',
                    url: '{{url("/")}}/admin/department/delete',
                    data: {id: id, "_token": "{{ csrf_token() }}"},

                    success: function (data) {
                        $('#msg').show();
                        $('#msg').html('Department has been deleted successfully');
                        $('#msg').fadeOut(2000);
                            $('#departs').load('<?php echo url("/admin/faculty/$faculty->id/departments")?>');

                        console.log('success');
                        $('div#' + id).remove();

                    },
                    error: function (data) {
                        console.log('fail');

                    }
                })
            });
/*            var auto_refresh = setInterval(
                function () {
                    $('#departs').load('<?php echo url("/admin/faculty/$faculty->id/departments")?>').fadeIn('slow');
                }, 100);

       */ })
       
    </script>
@endsection