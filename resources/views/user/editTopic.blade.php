<div class="modal fade" id="editTopic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <form id="update_topic" class="form-horizontal" method="POST" action="">
                        {{ csrf_field() }}
                        
                        <fieldset>
                            {{--<legend><span class="number"></span> Topics </legend>--}}
                            <input type="text" id="ar_topic" name="en_topic" placeholder="english name">
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>