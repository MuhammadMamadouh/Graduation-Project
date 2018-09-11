<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">Evaluation Method</th>
    </tr>
    </thead>
    @foreach($evaluation_methods as $evaluation_method)
        <tbody id="evaluation_methods">
        <tr id="{{$evaluation_method->id}}">
            <td>{{$evaluation_method->en_method}}</td>
            <td>
                <button type="button" id="edit" data-id="{{$evaluation_method->id}}" class="btn btn-info"
                        data-toggle="modal" data-target="#edit_evaluation_method">
                    Edit
                </button>
                <a class="btn btn-danger" id="del" data-toggle="modal" data-target="#del_diag" data-id="{{$evaluation_method->id}}">x</a>
            </td>
        </tr>
        </tbody>
    @endforeach
</table>
