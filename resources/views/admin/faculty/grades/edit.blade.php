<div class="modal fade" id="add_grade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_ins_grades" class="form-horizontal" method="POST" action="{{route('addFacultyGrade') }}">
                    {{csrf_field()}}
                    <input name="faculty_id" type="hidden" value="{{$faculty_id}}">
                    <fieldset>
                        @foreach($grades as $grade)
                            <input name="{{$grade->en_name}}_id" type="hidden" value="{{$grade->id}}">
                            <div class="form-group">
                                <label for="grade" class="col-md-4 control-label">{{$grade->en_name}}</label>

                                <div class="col-md-6">
                                    <input id="grade" type="text" class="form-control gradeClass" name="{{$grade->en_name}}"
                                           required>
                                </div>
                            </div>
                        @endforeach
                    </fieldset>

                    <div class="col-md-6">
                        <span class="help-block">Students:
                            <strong id="students" style="color: #F00"></strong>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <span class="help-block">Students:
                            <strong id="error" style="color: #F00"></strong>
                        </span>
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary">Add</button>

                </form>
            </div>
        </div>
    </div>
</div>