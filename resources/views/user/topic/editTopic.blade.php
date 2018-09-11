
<div class="modal fade" id="edit_topic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Update Topic</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-style-5">
                    <form id="upd_topic" class="form-horizontal" method="POST" action="{{route('updTopic')}}">
                        {{ csrf_field() }}
                            <input name="id" type="hidden" id="id">
                        <fieldset>
                            {{--<legend><span class="number"></span> Topics </legend>--}}
                            <input type="text" name="en_topic" id="en_topic" placeholder="Topic">
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>