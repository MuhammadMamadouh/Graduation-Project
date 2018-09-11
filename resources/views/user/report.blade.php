@extends('adminlte::user')
@section('css')
    <style>
        .skin-blue .main-header .navbar {
            background-color: #000000;
        }

        .skin-blue .main-header .logo {
            background-color: #333333;
            color: #fff;
            border-bottom: 0 solid transparent;
        }

        .content-wrapper {
            background-color: #ffffff;
        }

        .container {
            font-size: 18px;
        }
    </style>
@endsection

@section('content')
@section('title',  $course->en_title  .' course report')

<!--start content-->
<!--===================== OVERVIEW =============================-->

<h2 class=" text-dark">Course Report</h2>
<table class="table table-striped table-hover" s>
    <thead>
    <tr>
        <th>code</th>
        <th>Tilte</th>
        <th>Weakly hours</th>
        <th>Year</th>
        <th>semester</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$course->code}}</td>
        <td>{{$course->en_title}}</td>
        <td>{{$course->weakly_hour}}</td>
        <td>{{$course->year_name}}</td>
        <td>{{$course->sem_name}}</td>
    </tr>
    </tbody>
</table>

<br>
<h2 class="">Teachers</h2>
<br>
@if(count($staff) > 0)

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">NO.</th>
            <th scope="col">Name</th>
            <th scope="col">Academic degree</th>
            <th scope="col">Job</th>
        </tr>
        </thead>
        @foreach($staff as $doc)
            <tbody id="staff">
            <tr>
                <td></td>
                <td>{{$doc->en_name}}</td>
                <td>{{$doc->degree}}</td>
                <td>{{$doc->job}}</td>
            </tr>
            </tbody>
        @endforeach
    </table>
@else
    <br><br>
    <div class="alert alert-danger col-md-9">
        <p>This Course Doesn't Have Any Staff</p>
    </div>
@endif

<br>
<!--===================== TOPICS =============================-->
<div class="tab-pane" id="list_of_reference">
    <h2 class="">Topics</h2>
    <br>
    @if(count($topics) > 0)

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>No.</th>
                <th scope="col">Name</th>
            </tr>
            </thead>
            @foreach($topics as $topic)
                <tbody id="topics">
                <tr>
                    <td></td>
                    <td>{{$topic->en_topic}}</td>
                </tr>
                </tbody>
            @endforeach
        </table>
    @else
        <br><br>
        <div class="alert alert-danger col-md-9">
            <p>This Course Doesn't Have Any Topic</p>
        </div>
    @endif
</div>

<!--===================== Grades Methods =============================-->
<div class="tab-pane" id="grades">
    <h2>Grades</h2>
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
<!--===================== TEACHING METHODS =============================-->
<div class="tab-pane" id="teaching-method">
    <h2>Teaching Methods</h2>
    @if(count($methods) > 0)

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>NO.</th>
                <th scope="col">Name</th>
            </tr>
            </thead>
            @foreach($methods as $method)
                <tbody id="methods">
                <tr id="{{$method->id}}">
                    <td></td>
                    <td>{{$method->en_title}}</td>
                </tr>
                </tbody>
            @endforeach
        </table>
    @else
        <br><br>
        <div class="alert alert-danger col-md-9">
            <p>This Course Doesn't Have Any Topic</p>
        </div>
    @endif
</div>
<!--===================== REFERENCES =============================-->
<div class="tab-pane" id="list_of_reference">
    <h2> References</h2>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>NO.</th>
            <th>reference</th>
        </tr>
        </thead>
        @foreach($references as $reference)
            <tbody id="reference-info">
            <tr id="{{$reference->id}}">
                {{--<th scope="row"></th>--}}
                <td></td>
                <td>{{$reference->en_name}}</td>
            </tr>
            </tbody>

        @endforeach
    </table>

</div>

<!--===================== FACILITIES =============================-->
<div class="tab-pane " id="facilites" style="overflow:hidden;">
    <h2> Facilities</h2>

    <table class="table table-striped table-hover col-md-7">
        <thead>
        <tr>
            <th>NO.</th>
            <th>Facilty</th>
        </tr>
        </thead>
        @foreach($facilities as $facility)
            <tbody id="facility-info">
            <tr id="{{$facility->id}}">
                <td></td>
                <td>{{$facility->en_title}}</td>
            </tr>
            </tbody>
        @endforeach
    </table>

</div>
<!--===================== Evaluation Methods =============================-->
<div class="tab-pane" id="evaluation_method">
    <h2> Evaluation Methods</h2>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>NO.</th>
            <th>Evaluation Method</th>
        </tr>
        </thead>
        @foreach($evaluation_methods as $method)
            <tbody id="evaluation-info">
            <tr id="{{$method->id}}">
                <td></td>
                <td>{{$method->en_method}}</td>
            </tr>
            </tbody>
        @endforeach
    </table>
</div>
<!--===================== Aims =============================-->
<div class="tab-pane" id="aims">
    <div>
        <h2>Aims</h2>
    </div>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Content</th>
            {{--<th scope="col">Update</th>--}}
        </tr>
        </thead>
        @foreach($course_aims as $content)
            <tbody id="contents">
            <tr id="{{$content->program_aims_nars_aim_id}}">
                <th scope="row">{{$content->program_aims_nars_aim_id}}</th>
                <td>{{$content->update}}</td>
            </tr>
            </tbody>
        @endforeach
    </table>
</div>
<!--===================== ILOs =============================-->
<div class="tab-pane" id="ilos">
    <h2>ILOs</h2>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Content</th>
            <th scope="col">Type</th>
        </tr>
        </thead>
        @foreach($course_ilos as $content)
            <tbody id="contents">
            <tr id="{{$content->program_ILOs_NARS_ILOs_id}}">
                <th scope="row">{{$content->program_ILOs_NARS_ILOs_id}}</th>
                <td>{{$content->update}}</td>
                @foreach($genres as $genre)
                    @if($genre->id == $content->program_ILOs_NARS_ILOs_genre_id )
                        <td>{{$genre->en_title}}</td>
                    @endif
                @endforeach

            </tr>
            </tbody>
        @endforeach

        {{--{{dd($course_ilos)}}--}}
    </table>
</div>
</div>
</div><!--  End span7 -->
</div> <!--end row-->

@endsection
@section('js')
    <script type="text/javascript">
        // var tables = document.getElementsByTagName('table');
        // var table = tables[tables.length - 1];
        // var rows = table.rows;
        // for(var i = 0, td; i < rows.length; i++){
        //     td = document.createElement('td');
        //     td.appendChild(document.createTextNode(i + 1));
        //     rows[i].insertBefore(td, rows[i].firstChild);
        // }
    </script>
@endsection
