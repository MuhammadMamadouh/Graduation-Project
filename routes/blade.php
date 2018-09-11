<?php
\Blade::if('welcome', function ($message, $faculty = null, $department = null, $name = null) {
    if ($message == 'admin') {
        return
            '<div class=”panel-body”>
                <a href=\'admin/dashboard\'>Go To Admin Panel ?</a>
            </div>';
    } elseif ($message == 'departAdmin') {
        return
            '<div class=”panel-body” >
                    Hey You Are
                <a href = "admin/faculty/' . $faculty . '/department/' . $department . '" >' . $name . '
                </a >Department Admin
            </div >';
    } else {
        return 'Welcome User';
    }
});
Blade::directive('alert_delete', function () {
    return '<div class="modal fade" id="del_diag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You Sure You want to delete This?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="confirm">Yes, I\'m Sure</button>
                </div>
            </div>
        </div>
    </div>';
});
