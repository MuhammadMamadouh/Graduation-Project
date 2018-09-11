@extends('adminlte::page')
@section('title', 'view Degree')
@section('content')
    @include('admin.degree.add')
    @include('admin.degree.update')
    <div class="container">

        <h2 class="text-center text-dark">Degree Information</h2>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_degree">
                Add degree
            </button>
        </div>
        <p id="msg" style="display: none" class="alert alert-success col-sm-5"></p>
        <div id="degree"></div>
        <br>
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
    $(document).ready(function () {


        var auto_refresh = setInterval(
            function () {
                $('#degree').load('<?php echo url('admin/degree/allDegrees')?>').fadeIn('slow');
            }, 500);

        $('#ins_degree').on('submit', function (e) {
            e.preventDefault();
            $('#add-error').text('')
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            //

            $.ajax({
                type: post,
                url: url,
                data: data,
                dataType: 'json',
            })
                .done(function (data) {
                    $('#add_degree').modal('hide');
                    $('#msg').show();
                    $('#msg').html('Degree has been added successfully');
                    $('#msg').fadeOut(2000);
                })
                .fail(function (data) {
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#add-error').text(val)
                    })
                })
        })

        // --------------- Delete Degree ---------------------
        $('body').delegate('#degrees #del', 'click', function (e) {
            var id = $(this).data('id');
            $('#confirm').on('click', function (e) {

                $.ajax({
                    type: 'post',
                    url: '{{url("/")}}/admin/degree/delete',
                    data: {id: id, "_token": "{{ csrf_token() }}"},

                    success: function (data) {
                        $('#del_diag').modal('hide');
                        console.log('success');
                        $('#msg').show();
                        $('#msg').html('Degree has been deleted successfully');
                        $('tr#' + id).remove();
                        $('#msg').fadeOut(2000);
                    },
                    error: function (data) {
                        console.log('fail');

                    }
                })
            })
        });

        // --------------------- edit Degree-----------------------------
        $('body').delegate('#degrees #edit', 'click', function (e) {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                type: 'get',
                url: '{{url("/")}}/admin/degree/edit',
                data: {id: id},

                success: function (data) {
                    console.log(data);
                    $('#update_degree').find('#id').val(data.id)
                    $('#update_degree').find('#en_degree').val(data.en_degree)
                    $('#edit_degree').modal('show');
                },
                error: function (data) {
                    console.log('fail');
                }
            })
        });
        // --------------------- update degree-----------------------------
        $('#update_degree').on('submit', function (e) {
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
                    $('#edit_degree').modal('hide');
                    $('#msg').show();
                    $('#msg').html('Degree has been updated successfully');
                    $('#msg').fadeOut(2000);
                })
                .fail(function (data) {
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#help-block').text(val)
                    })
                })
        });
    });
</script>
    @endsection
