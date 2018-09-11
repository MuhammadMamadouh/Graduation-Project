@extends('adminlte::page')
@section('title', 'view jobs')
@section('content')
    @include('admin.job.add')
    @include('admin.job.update')
    <div class="container">

        <h2 class="text-center text-dark">Job Information</h2>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_job">
                Add Job
            </button>
        </div>
        <p id="msg" style="display: none" class="alert alert-success col-sm-4"></p>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Title</th>
            </tr>
            </thead>
            @foreach($jobs as $job)
            <tbody id="jobs">

            <!-- <tr id="{{$job->id}}">
                <td>{{$job->en_title}}</td>
                <td>
                    <button type="button" id="edit" data-id="{{$job->id}}" class="btn btn-info" data-toggle="modal" data-target="#edit_job">
                        Edit
                    </button>
                    <a href="#" class="btn btn-danger" id="del" data-id="{{$job->id}}">x</a>
                </td>

            </tr> -->
            </tbody>
            @endforeach
        </table>
        <br>



    </div>

@endsection
@section('js')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //--------------------------------------


            
        //--------------------------------------
        $(document).ready(function(){


        $('#ins_job').on('submit', function (e) {

            e.preventDefault();
            $('#msg').show();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            //

            $.ajax({
                type: post,
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    $('#add_job').modal('hide');
                    $('#msg').html('Job has added successfully');
                   $('#msg').fadeOut(2000);
                }
            })
        })
        var auto_refresh = setInterval(
                function(){
                    $('#jobs').load('<?php echo url('admin/jobs/all')?>').fadeIn('slow');
                },100);

            })
        $('body').delegate('#jobs #del', 'click', function (e) {
            var id = $(this).data('id');
            $.ajax({
                type: 'post',
                url: '{{url("/")}}/admin/job/delete',
                data: {id: id, "_token": "{{ csrf_token() }}"},

                success: function (data) {
                    console.log('success');
                    $('tr#'+id).remove();


                },
                error: function (data) {
                    console.log('fail');

                }
            })
        });

        // --------------------- edit job-----------------------------
        $('body').delegate('#jobs #edit', 'click', function (e) {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                type: 'get',
                url: '{{url("/")}}/admin/job/edit',
                data: {id: id},

                success: function (data) {
                    console.log(data);
                    $('#update_job').find('#id').val(data.id)
                    $('#update_job').find('#title').val(data.en_title)
                    $('#edit_job').modal('show');
                },
                error: function (data) {
                    console.log('fail');
                }
            })
        });
        // --------------------- update job-----------------------------
        $('#update_job').on('submit', function (e) {
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
                    console.log('done');
                    window.location.reload();
                })
                .fail(function (data) {
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#help-block').text(val)
                    })
                })
        })


    </script>
@endsection