<div class="modal fade" id="addFacility" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm-Facility" class="form-horizontal" method="POST" action="{{route('addFacility')}}">
                    {{ csrf_field() }}
                    <div class="form-style-5">

                            <input name="course_code" type="hidden" value="{{$course->code}}">


                        <fieldset>
                            <legend><span class="number"></span> Course Facilities :</legend>
                            @foreach($allFacilities as $allFacility)

                                <label class="container">{{$allFacility->en_title}}
                                    <input name="facility_id[]"
                                           @foreach($facilities as $facility)
                                        @if($allFacility->id === $facility->id) checked @endif
                                    @endforeach
                                    value="{{$allFacility->id}}" type="checkbox">
                                    {{--<input name="facility_id[]" value="{{$facility->id}}" type="checkbox">--}}
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
