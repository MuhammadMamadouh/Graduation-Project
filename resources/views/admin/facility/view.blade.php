@extends('adminlte::page')
@section('title', 'view facility')
@section('content')
    @include('admin.facility.add')
    @include('admin.facility.update')
    <div class="container">

        <h2 class="text-center text-dark">Facility Information</h2>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_facility">
                Add facility
            </button>
        </div>
        <br>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">facility</th>
            </tr>
            </thead>
            @foreach($facilities as $facility)
                <tbody id="facilities">
                <tr id="{{$facility->id}}">
                    <td>{{$facility->en_title}}</td>
                    <td>
                        <button type="button" id="edit" data-id="{{$facility->id}}" class="btn btn-info"
                                data-toggle="modal" data-target="#edit_facility">
                            Edit
                        </button>
                        <a href="#" class="btn btn-danger" id="del" data-id="{{$facility->id}}">x</a>
                    </td>
                </tr>
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
        $('#ins_facility').on('submit', function (e) {
            e.preventDefault();
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
                    // window.location.reload();
                    var tr = $('<tr/>', {
                        id: data.id
                    });
                    tr.append($('<td/>', {
                        text: data.en_title
                    })).append($('<td/>', {
                        html:
                        '<a href="#" class="btn btn-info" id="edit" data-id="' + data.id + ' "> Edit</a>' + ' ' +
                        '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + ' "> x</a>'
                    }));
                    $('#facilities').append(tr);
                },
                error: function (data) {
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#add-error').text(val)

                    })
                }
            })
        })

        // --------------- Delete facility ---------------------
        $('body').delegate('#facilities #del', 'click', function (e) {
            var id = $(this).data('id');
            $.ajax({
                type: 'post',
                url: '{{url("/")}}/admin/facility/delete',
                data: {id: id, "_token": "{{ csrf_token() }}"},

                success: function (data) {
                    console.log('success');
                    // $('#facilities tr#' + data.id).remove()
                    window.location.reload();

                },
                error: function (data) {
                    console.log('fail');

                }
            })
        });

        // --------------------- edit facility-----------------------------
        $('body').delegate('#facilities #edit', 'click', function (e) {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                type: 'get',
                url: '{{url("/")}}/admin/facility/edit',
                data: {id: id},

                success: function (data) {
                    console.log(data);
                    $('#update_facility').find('#id').val(data.id)
                    $('#update_facility').find('#title').val(data.en_title)
                    $('#edit_facility').modal('show');
                },
                error: function (data) {
                    console.log('fail');
                }
            })
        });
        // --------------------- update facility-----------------------------
        $('#update_facility').on('submit', function (e) {
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
                        $('#update-error').text(val)
                    })
                })
        })
    </script>
@endsection