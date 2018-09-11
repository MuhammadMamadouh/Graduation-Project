@extends('adminlte::user')
@section('sidebar')
    <li class="list-group-item active">
        <a href="#overview" type="button" class="" data-toggle="tab">
            <i class="fa fa-fw fa-plus"></i>
            <span>overview</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="list-group-item">
        <a href="#content" type="button" class="" data-toggle="tab">
            <i class="fa fa-fw fa-plus"></i>
            <span>Topics</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="list-group-item">
        <a href="#teching_method" type="button" class="" data-toggle="tab">
            <i class="fa fa-fw fa-"></i>
            <span>Teaching Methods</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="list-group-item">
        <a href="#list_of_reference" type="button" class="" data-toggle="tab">
            <i class="fa fa-fw fa-book"></i>
            <span>References</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="list-group-item">
        <a href="#facilites" type="button" class="" data-toggle="tab">
            <i class="fa fa-fw fa-plus"></i>
            <span>Facilites</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="list-group-item">
        <a href="#evaluation_method" type="button" class="" data-toggle="tab">
            <i class="fa fa-fw"></i>
            <span>Evaluation Method</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="list-group-item">
        <a href="#grades" type="button" class="" data-toggle="tab">
            <i class="fa fa-fw"></i>
            <span>Grades</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="list-group-item">
        <a href="{{URL::current()}}/aims" type="button" class="">
            <i class="fa fa-fw fa-link"></i>
            <span>Aims</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="list-group-item">
        <a href="{{URL::current()}}/ilos" class="">
            <i class="fa fa-fw fa-link"></i>
            <span>ILOs</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="list-group-item">
        <a href="#" onclick="print_report()" type="button" class="" data-toggle="tab">
            <i class="fa fa-fw fa-link"></i>
            <span>Report</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>

@endsection
@section('content')
@section('title', 'course')
@include('user.addFacilities')
@include('user.editFacilities')
@include('user.topic.addTopic')
@include('user.topic.editTopic')
@include('user.addMethod')
@include('user.addEvaluationMethod')
@include('user.reference.addReferences')
@include('user.reference.editReferences')
@include('user.editGrades')

<!--start content-->

<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="span12"> Course Information</h1>

            <!-- =========================Start Col right section ============================= -->

            <div class="tab-content col-sm-10">

                <!--===================== OVERVIEW =============================-->
                <div class="tab-pane active" id="overview" style="">
                    <li class='list-group-item'><i class='fa fa-circle-o fa-lg'></i>
                        <span>code :</span>{{$course->code}}
                    </li>
                    <li class='list-group-item'><i class='fa  fa-lg fa-black-tie fa-lg'></i>
                        <span>title:</span>{{$course->en_title}}
                    </li>
                    <li class='list-group-item'><i class='fa fa-calendar-times-o'></i>
                        <span>weakly hour:</span>{{$course->weakly_hour}}
                    </li>
                    <li class='list-group-item'><i
                                class='fa fa-globe fa-lg'></i><span>year:</span> {{$course->year_name}}
                    </li>
                    <li class='list-group-item'><i
                                class='fa fa-globe fa-lg'></i><span>Students:</span> {{$course->students}}
                    </li>

                    <li class='list-group-item'><i class='fa fa-black-tie fa-lg'></i>
                        <span> semester:</span>{{$course->sem_name}}
                    </li>
                    <li class='list-group-item'><i class='fa fa-graduation-cap fa-lg'></i>

                        <p><span>Teachers:</span>
                            @foreach($staff as $doc)
                                {{ '  ' . $doc->en_name . ', '}}
                            @endforeach.</p>
                        <div class="pull-left d-block " style="overflow: hidden"></div>
                </div>
                <!--===================== TOPICS =============================-->
                <div class="tab-pane" id="content">
                    <h2>Topics</h2>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Topic</th>
                            <th scope="col">Actually Taught </th>
                            <th scope="col">Reasons for not teaching topic</th>
                            <th></th>
                        </tr>
                        </thead>
                        @foreach($topics as $topic)

                            <tbody id="topic-info">
                            <tr id="{{$topic->id}}">
                                <td scope="row"></td>
                                <td>{{$topic->en_topic}}</td>
                                <td>
                                    @if($topic->actually_taught ==1) yes @else no @endif
                                </td>
                                <td>
                                    <a href="#" class="pull-right btn btn-success" id="edit"
                                       data-id="{{$topic->id}}" data-toggle="modal"
                                       data-target="#edit_topic">Edit</a>
                                    <a href="#" class="pull-right btn btn-danger" id="del"
                                       data-id="{{$topic->id}}">x</a>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <button type="button" class="btn btn-info pull-right" data-toggle="modal"
                            data-target="#addContent">
                        ADD
                    </button>
                </div>
                <!--===================== TEACHING METHODS =============================-->
                <div class="tab-pane" id="teching_method">
                    <h2>Teaching Methods</h2>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Method</th>
                        </tr>
                        </thead>
                        @foreach($methods as $method)
                            <tbody id="method-info">
                            <tr id="{{$method->id}}">
                                <td scope="row"></td>
                                <td>{{$method->en_title}}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target="#addMethod">
                        ADD
                    </button>
                </div>
                <!--===================== REFERENCES =============================-->
                <div class="tab-pane" id="list_of_reference">
                    <h2> References</h2>

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Reference</th>
                            <th scope="col">Description</th>
                        </tr>
                        </thead>
                        @foreach($references as $reference)
                            <tbody id="reference-info">
                            <tr id="{{$reference->id}}">
                                <td scope="row"></td>
                                <td>{{$reference->en_name}}</td>
                                <td>{{$reference->desc}}</td>
                                <td>
                                    <a href="#" class="pull-right btn btn-danger" id="del"
                                       data-id="{{$reference->id}}">x</a>
                                    <a href="#" class="pull-right btn btn-success" id="edit"
                                       data-id="{{$reference->id}}" data-toggle="modal"
                                       data-target="#editReference">Edit</a>
                                </td>
                            </tr>
                            </tbody>

                        @endforeach
                    </table>

                    <button type="button" class="btn btn-info pull-right" data-toggle="modal"
                            data-target="#addReference">
                        ADD
                    </button>
                </div>

                <!--===================== FACILITIES =============================-->
                <div class="tab-pane" id="facilites">
                    <h2> Facilities</h2>

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Facility</th>
                        </tr>
                        </thead>
                        @foreach($facilities as $facility)
                            <tbody id="facility-info">
                            <tr id="{{$facility->id}}">
                                <td scope="row"></td>
                                <td>{{$facility->en_title}}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>

                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target="#addFacility">
                        ADD
                    </button>
                </div>
                <!--===================== Evaluation Methods =============================-->
                <div class="tab-pane" id="evaluation_method">
                    <h2> Evaluation Methods</h2>

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Evaluation Method</th>
                        </tr>
                        </thead>
                        @foreach($evaluation_methods as $method)
                            <tbody id="facility-info">
                            <tr id="{{$method->id}}">
                                <td scope="row"></td>
                                <td>{{$method->en_method}}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>

                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target="#addEvaluationMethod">
                        <i class="fa fa-plus"></i> ADD
                    </button>
                </div>
                <!--===================== Grades Methods =============================-->
                <div class="tab-pane" id="grades">
                    <h2>Grades</h2>

                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target="#editGrades">
                        <i class="fa fa-plus"></i> Edit
                    </button>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Grade</th>
                            <th scope="col">No. Of Students</th>
                        </tr>
                        </thead>
                        @foreach($course_grades as $grade)
                            <tbody id="grades-info">
                            <tr id="{{$grade->id}}">
                                <td scope="row"></td>
                                <td>{{$grade->en_name}}</td>
                                <td>{{$grade->students}}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>


                    <div id="perf_div"></div>
                    <?= Lava::render('ColumnChart', 'gradesChart', 'perf_div') ?>
                    @columnchart('gradesChart', 'perf_div')
                </div>
                <!--===================== ILOs =============================-->
                <div class="tab-pane" id="ilos">
                    <div id="comments">
                        <div>
                            <h2>Ilos</h2>
                            <a href='{{url("/mycourse/$course->code/ilos")}}' class="btn btn-primary">Go To ILOs</a>
                        </div>
                    </div>
                </div>
                <!--===================== AIMS =============================-->
                <div class="tab-pane" id="aims">
                    <h2>aims</h2>
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                            data-target="#add_course_aims"> ADD
                    </button>
                    <ul id="aims">
                        <a href='{{url("/mycourse/$course->code/aims")}}' class="btn btn-primary">Go to Aims</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<hr/>
@endsection
@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // --------------------- delete reference-----------------------------
        $('body').delegate('#reference-info #del', 'click', function (e) {
            var id = $(this).data('id');
            $.post('{{URL::to("/mycourse/del-reference")}}', {id: id, "_token": "{{csrf_token()}}"}, function (data) {
                console.log(data);
                $('tr#' + id).remove();
            })
        });

        // ---------------------- edit reference --------------------------
        $('body').delegate('#reference-info #edit', 'click', function (e) {
            var id = $(this).data(id);
            console.log(id.id)
            $.get("{{URL::to('/edit-reference')}}", {id: id.id}, function (data) {
                console.log(data.desc);
                $('#update_reference').find('#id').val(data.id);
                $('#update_reference').find('#en_name').val(data.en_name);
                $('#update_reference').find('#ar_name').val(data.ar_name);
                $('#update_reference').find('#desc').val(data.desc);
                $('#editReference').modal('show');
            })

        });

        // --------------------- update reference-----------------------------
        $('#update_reference').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url, data, function (data) {
                    console.log(data);
                    var tr = $('<tr/>', {
                        id: data.id
                    });
                    tr.append($('<td/>', {
                        text: data.en_name
                    })).append($('<td/>', {
                        text: data.desc
                    })).append($('<td/>', {
                        html: '<a href="#" class="btn btn-success" id="edit" data-id="' + data.id + '">edit</a>' +
                        '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + '">delete</a>'
                    }));
                    $('#reference-info tr#' + data.id).replaceWith(tr);
                    $('#editReference').modal('hide');
                }
            )
        });
        // ---------------------- edit reference --------------------------
        $('body').delegate('#grades #edit', 'click', function (e) {
            var id = $(this).data(id);
            console.log(id.id)

            $('#edit_grade').modal('show');
        });

        // --------------------- update grades-----------------------------
        $('#update_grades').on('submit', function (e) {
            // e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var allStudents = Number($('#update_grades #students').text())
            console.log('students: ' + allStudents)
            var sum = 0;
            $('.gradeClass').each(function () {
                sum += Number($(this).val())
                console.log('sum: ' + sum)
            })
            console.log(sum);
            if (sum !== allStudents) {
                console.log('Number of students is not equla to students')
                $('#update_grades #error').text('Number of students is not equla to students')
            } else {
                $.post(url, data, function (data) {
                        console.log('data is ' + data);
                    }
                )
            }
        });


        // --------------------- delete facility-----------------------------
        $('body').delegate('#facility-info #del', 'click', function (e) {
            var id = $(this).data('id');
            $.post('{{URL::to("/mycourse/del-facility")}}', {id: id, "_token": "{{csrf_token()}}"}, function (data) {
                console.log(data);
                $('tr#' + id).remove();
                console.log('tr#' + id + 'removed');
            })
        });


        // --------------------- delete method-----------------------------
        $('body').delegate('#method-info #del', 'click', function (e) {
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                type: 'post',
                url: '{{url("/mycourse/del-method")}}',
                data: {id: id, "_token": "{{ csrf_token() }}"},

                success: function (data) {

                    console.log(data);
                    $('tr#' + id).remove();
                    console.log('tr#' + id + 'removed');
                },
                error: function (data) {
                    console.log('fail');

                }
            })
        })

        // --------------------- delete Topic-----------------------------
        $('body').delegate('#topic-info #del', 'click', function (e) {
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                type: 'post',
                url: '{{url("/mycourse/del-topic")}}',
                data: {id: id, "_token": "{{ csrf_token() }}"},

                success: function (data) {
                    console.log(data);
                    $('tr#' + id).remove();
                    console.log('tr#' + id + 'removed');
                },
                error: function (data) {
                    console.log('fail');

                }
            })
        });

        // ---------------------- edit topic --------------------------
        $('body').delegate('#topic-info #edit', 'click', function (e) {
            var id = $(this).data(id);
            console.log(id.id)
            $.get("{{URL::to('/edit-topic')}}", {id: id.id}, function (data) {
                console.log(data.en_topic);
                $('#upd_topic').find('#id').val(data.id);
                $('#upd_topic').find('#en_topic').val(data.en_topic);
                $('#upd_topic').find('#ar_topic').val(data.ar_topic);
                $('#updTopic').modal('show');
            });

        });

        // --------------------- update Reference-----------------------------
        $('#upd_topic').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url, data, function (data) {
                    window.location.reload();
                }
            )
        });


        $('#ins_course_aims').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');

            $.ajax({
                type: post,
                url: url,
                data: data,
                dataTy: 'json',
                success: function (data) {
                    var li = $('<li/>', {
                        text: data.en_content
                    });
                    $('#aims').append(li);
                    $('#add_course_aims').modal('hide');
                }
            });
        });


        function print_report() {

            var printWindow = window.open('{{URL::current()}}/report');
            printWindow.focus();
            printWindow.print();
        }
    </script>
@endsection