
<div class="modal fade" id="addContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Add Topic</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-style-5">
                    <form id="ins_reference" class="form-horizontal" method="POST" action="{{route('addTopic')}}">
                        {{ csrf_field() }}

                            <input name="course_code" type="hidden" value="{{$course->code}}">

                        <fieldset>
                            <input type="text" name="en_topic" placeholder="Name">
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>