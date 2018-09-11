<div class="container">


    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th>English name</th>
            <th>Duration</th>
            <th>Type</th>


        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">{{$program->id}}</th>
            <td>{{$program->en_name}}</td>
            <td>{{$program->duration}}</td>
            <td>{{$program->type}}</td>

        </tr>
        </tbody>
    </table>

    <div class="container">
        <h2>Program Vision</h2>
        <p class="col-6">{{$program->vision}}</p>
    </div>

    <div class="container">
        <h2>Program Mission</h2>
        <p class="col-6">{{$program->mession}}</p>
    </div>

    <h3 class="text-center text-dark pull-left">Faculty Aims</h3>
    <table class="table table-striped table-hover">
        <thead>
        <tr>

            <th scope="col">ID</th>
            <th scope="col">Faculty Aim</th>


        <tbody id="contents">
        <td></td>
        <td>Upon successful completion of program, the graduate should be able to:</td>
        @foreach($program_aims as $content)
            <tr id="{{$content->id}}">
                <td scope="row">{{$content->id}}</td>
                <td>{{$content->en_content}}</td>
            </tr>
        </tbody>
        @endforeach
        </tr>
        </thead>

    </table>
    <br>

    <h3 class="text-center text-dark pull-left">Program Aims</h3>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">English content</th>
            <th scope="col">English content</th>

        </tr>
        </thead>
        <tbody id="contents">
        @foreach($program_aims as $content)

            <tr id="{{$content->id}}">
                <th scope="row">{{$content->id}}</th>
                <td>{{$content->en_content}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
    <br>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Genre</th>
            <th scope="col">ID</th>
            <th>National Academic References Standards (NARS)</th>
            <th>Program Intended Learning Outcomes (ILOs)</th>
        </tr>
        </thead>
        @foreach($program_ilos as $content)
            <tbody id="contents">
            <tr id="{{$content->id}}">
                <td>{{$content->genre}}</td>
                <th scope="row">{{$content->id}}</th>
                <td>{{$content->en_content}}</td>
                <td>{{$content->update}}</td>
            </tr>
            </tbody>
        @endforeach
    </table>
    <br>
    <h1>Department Staff Members</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">English Name</th>
            <th scope="col">Arabic Name</th>
            <th scope="col">Mobile</th>
            <th scope="col">email</th>
            <th scope="col">Academic degree</th>
        </tr>
        </thead>
        @foreach($all_staff as $staff)
            <tbody>
            <tr>
                <th scope="row">{{$staff->id}}</th>
                <td>{{$staff->en_name}}</td>
                <td>{{$staff->ar_name}}</td>
                <td>{{$staff->mobile}}</td>
                <td>{{$staff->email}}</td>
                <td>{{$staff->academic_degree}}</td>
                <td>{{$staff->staff_id}}</td>
            </tr>
            </tbody>
        @endforeach
    </table>
</div>
