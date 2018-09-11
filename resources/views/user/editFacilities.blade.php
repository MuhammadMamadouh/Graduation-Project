<div class="modal fade" id="editFacility" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        {{--@foreach($facilty as $item)--}}
                            {{--<input name="course_code" type="hidden" value="{{$item->code}}">--}}
                        {{--@endforeach--}}

                        <fieldset>
                            <legend><span class="number"></span> Course Facilities :</legend>
                            {{--@foreach($allFacilities as $facility)--}}
                                {{--<label class="container">{{$facility->en_title}}--}}
                                    {{--<input name="facility_id[]" value="{{$facility->id}}" type="checkbox">--}}
                                    {{--<span class="checkmark"></span>--}}
                                {{--</label>--}}
                            {{--@endforeach--}}
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
