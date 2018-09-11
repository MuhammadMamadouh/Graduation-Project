<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">Teaching Method</th>
    </tr>
    </thead>
    @foreach($methods as $method)
        <tbody id="teaching_methods">
        <tr id="{{$method->id}}">
            <td>{{$method->en_title}}</td>
            <td>

                <button type="button" id="edit" data-id="{{$method->id}}" class="btn btn-info"
                        data-toggle="modal" data-target="#edit_teaching_method">
                    Edit
                </button>
                <a href="#" class="btn btn-danger" id="del" data-toggle="modal" data-target="#del_diag"
                   data-id="{{$method->id}}">x</a>
            </td>
        </tr>
        </tbody>
    @endforeach
</table>