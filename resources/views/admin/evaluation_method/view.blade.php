@extends('adminlte::page')
@section('title', 'Evaluation Methods')
@section('content')
    @include('admin.evaluation_method.add')
    @include('admin.evaluation_method.update')


    <h2 class="text-center text-dark">Evaluation Methods Information</h2>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_evaluation_method">
            Add method
        </button>
    </div>
    <br>
    <p id="msg" style="display: none" class="alert alert-success col-sm-5"></p>

    <div id="evalMethods"></div>
    <br>
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
                    $('#evalMethods').load('<?php echo url('admin/evaluation-method/allMethods')?>').fadeIn('slow');
                }, 500);

            $('#ins_evaluation_method').on('submit', function (e) {
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

                        $('#add_evaluation_method').modal('hide');
                        $('#msg').show();
                        $('#msg').html('Method has been added successfully');
                        $('#msg').fadeOut(2000);
                    })
                    .fail(function (data) {
                        $.each(data.responseJSON, function (index, val) {
                            console.log(val)
                            $('#add-error').text(val)
                        })
                    })
            })

            // --------------- Delete evaluation_method ---------------------
            $('body').delegate('#evaluation_methods #del', 'click', function (e) {
                var id = $(this).data('id');
                $('#confirm').on('click', function (e) {

                    $.ajax({
                        type: 'post',
                        url: '{{url("/")}}/admin/evaluation-method/delete',
                        data: {id: id, "_token": "{{ csrf_token() }}"},

                        success: function (data) {
                            $('#del_diag').modal('hide');
                            $('#msg').show();
                            $('#msg').html('A method has been deleted successfully');
                            $('tr#' + id).remove();
                            $('#msg').fadeOut(2000);
                            $('#evaluation_methods tr#' + data.id).remove();

                        },
                        error: function (data) {
                            console.log('fail');

                        }
                    })
                });
            });

            // --------------------- edit evaluation_method-----------------------------
            $('body').delegate('#evaluation_methods #edit', 'click', function (e) {
                var id = $(this).data('id');
                console.log(id)
                $.ajax({
                    type: 'get',
                    url: '{{url("/")}}/admin/evaluation-method/edit',
                    data: {id: id},

                    success: function (data) {
                        console.log(data);
                        $('#update_evaluation_method').find('#id').val(data.id)
                        $('#update_evaluation_method').find('#en_evaluation_method').val(data.en_method)
                        $('#edit_evaluation_method').modal('show');
                    },
                    error: function (data) {
                        console.log('fail');
                    }
                })
            });
            // --------------------- update evaluation_method-----------------------------
            $('#update_evaluation_method').on('submit', function (e) {
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
                        $('#edit_evaluation_method').modal('hide');
                        $('#msg').show();
                        $('#msg').html('Method has been updated successfully');
                        $('#msg').fadeOut(2000);
                    })
                    .fail(function (data) {
                        $.each(data.responseJSON, function (index, val) {
                            console.log(val)
                            $('#update-error').text(val)
                        })
                    })
            });
        });
    </script>
@endsection