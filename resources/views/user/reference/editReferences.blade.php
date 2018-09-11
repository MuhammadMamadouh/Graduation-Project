<div class="modal fade" id="editReference" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Add Reference</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-style-5">

                    <form id="update_reference" class="form-horizontal" method="POST" action="{{route('updRef')}}">
                        {{ csrf_field() }}
                        <input id="id" type="hidden" class="form-control" name="id">
                        <fieldset>
                            <legend><span class="number"></span> list of reference :</legend>
                            <input type="text" id="en_name" name="en_name" placeholder="Name">
                            <input type="text" id="desc" name="desc" placeholder="Description">
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>