@extends('adminlte::page')
@section('title', 'view year')
@section('content')
    @include('admin.semester.add')
    @include('admin.year.update')

    <div class="container">
        <p id="msg" style="display: none" class="alert alert-success col-sm-4 pull-right"></p>
        <h2 class="text-center text-dark">Year Information</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">start date</th>
                <th scope="col">end date</th>
                <th scope="col">status</th>
                <th scope="col">Desc.</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{$year->id}}</th>
                <td>{{$year->name}}</td>
                <td>{{$year->start_date}}</td>
                <td>{{$year->end_date}}</td>
                <td>{{$year->status}}</td>
                <td>{{$year->en_desc}}</td>
                <td>
                    <button data-toggle="modal" data-target="#edit_year" class="btn btn-info">Edit</button>
                </td>
            </tr>

            </tbody>
        </table>
        <div>
            <button data-toggle="modal" data-target="#add_sem" class="btn btn-primary">Add Semester</button>
        </div>

        <div class="row" id="semesters"></div>
    </div>
    @alert_delete()
@endsection
@section('js')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#semesters').load('{{url(\URL::current())}}/semesters');

        $('#frm-insert').on('submit', function (e) {

            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            $.ajax({
                type: post,
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    var card = '<div class="col-sm-6">\n' +
                        '                    <div class="card">\n' +
                        '                        <div class="card-body">\n' +
                        '                            <h3 class="card-title bg-white">' +
                        data.name + '</h3>\n' +
                        '\n' +
                        '<a href="{{URL::current()}}' + '/semester/' + data.id + '" class="btn btn-primary">view</a>' +
                        '<a href="#" class="btn btn-success" id="edit" data-id="' + data.id + '">edit</a>' + ' ' +
                        '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + '">delete</a>' + '                        </div>\n' +
                        '                    </div>\n' +
                        '                </div>';
                    $('#semesters').append(card);
                }
            })
        });

        // // --------------------- Update Year-----------------------------

        $('#update-year').on('submit', function (e) {
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
                    console.log(data)
                    window.location.reload();
                })
                .fail(function (data) {
                    e.preventDefault();
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#update-error').text(val)
                    })
                })
        });

        // --------------- Delete Semester ---------------------
        $('body').delegate('#semesters #del', 'click', function (e) {
            var id = $(this).data('id');
            $('#confirm').on('click', function (e) {
                $.ajax({
                    type: 'post',
                    url: '{{url("/")}}/admin/semester/delete',
                    data: {id: id, "_token": "{{ csrf_token() }}"},

                    success: function (data) {
                        $('#semesters').load('{{url(\URL::current())}}/semesters');
                        $('#del_diag').modal('hide');
                        $('#msg').show();
                        $('#msg').html('Semester has been deleted successfully');
                        $('#msg').fadeOut(2500);
                    },
                    error: function (data) {
                        console.log('fail');
                    }
                })
            })
        });

        // add semester
        $('#ins_sem').on('submit', function (e) {
            e.preventDefault();
            $('#add-error').text('');
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
                    $('#semesters').load('{{url(\URL::current())}}/semesters');
                    $('#add_sem').modal('hide');
                    $('#msg').show();
                    $('#msg').html('Semester has been inserted successfully');
                    $('#msg').fadeOut(2500);
                })
                .fail(function (data) {
                    console.log(data)
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#add-error').text(val)
                    })
                })
        });

    </script>
@endsection