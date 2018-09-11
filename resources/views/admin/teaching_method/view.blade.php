@extends('adminlte::page')
@section('title', 'view Teaching Methods')
@section('content')
    @include('admin.teaching_method.add')
    @include('admin.teaching_method.update')
    <div class="container">

        <h2 class="text-center text-dark">Teaching Method Information</h2>
        <p id="msg" style="display: none" class="alert alert-success col-sm-5"></p>
<br>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTeachMethod">
                Add
            </button>
        </div>
        <br>
        <div id="teachMethods"></div>

        <br>
        @alert_delete()
    </div>
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
                    $('#teachMethods').load('<?php echo url('admin/teaching-method/allMethods')?>').fadeIn('slow');
                }, 500);

            $('#ins_teaching_method').on('submit', function (e) {
                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                //

                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        $('#addTeachMethod').modal('hide');
                        $('#msg').show();
                        $('#msg').html('Method has been added successfully');
                        $('#msg').fadeOut(2000);
                    },
                    error: function (data) {
                        $.each(data.responseJSON, function (index, val) {
                            console.log(val)
                            $('#add-error').text(val)
                        })
                    }
                })
            })

            // --------------- Delete teaching_method ---------------------
            $('body').delegate('#teaching_methods #del', 'click', function (e) {
                var id = $(this).data('id');
                $('#confirm').on('click', function (e) {

                    $.ajax({
                        type: 'post',
                        url: '{{url("/")}}/admin/teaching-method/delete',
                        data: {id: id, "_token": "{{ csrf_token() }}"},

                        success: function (data) {
                            $('#del_diag').modal('hide');
                            $('#msg').show();
                            $('#msg').html('A method has been deleted successfully');
                            $('tr#' + id).remove();
                            $('#msg').fadeOut(2000);

                            $('tr#' + id).remove();
                        },
                        error: function (data) {
                            console.log('fail');
                        }
                    })
                })
            });

            // --------------------- edit teaching_method-----------------------------
            $('body').delegate('#teaching_methods #edit', 'click', function (e) {
                var id = $(this).data('id');
                console.log(id)
                $.ajax({
                    type: 'get',
                    url: '{{url("/")}}/admin/teaching-method/edit',
                    data: {id: id},

                    success: function (data) {
                        console.log(data);
                        $('#update_teaching_method').find('#id').val(data.id)
                        $('#update_teaching_method').find('#title').val(data.en_title)
                        $('#edit_teaching_method').modal('show');
                    },
                    error: function (data) {
                        console.log('fail');
                    }
                })
            });
            // --------------------- update teaching_method-----------------------------
            $('#update_teaching_method').on('submit', function (e) {
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
                        $('#edit_teaching_method').modal('hide');
                        $('#msg').show();
                        $('#msg').html('Method has been updated successfully');
                        $('#msg').fadeOut(2000);
                    })
                    .fail(function (data) {
                        $.each(data.responseJSON, function (index, val) {
                            console.log(val)
                            $('#help-block').text(val)
                        })
                    })
            })
        })
    </script>
@endsection