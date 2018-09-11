<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">Degree</th>
    </tr>
    </thead>
    @foreach($degrees as $degree)
        <tbody id="degrees">
        <tr id="{{$degree->id}}">
            <td>{{$degree->en_degree}}</td>
            <td>

                <button type="button" id="edit" data-id="{{$degree->id}}" class="btn btn-info"
                        data-toggle="modal" data-target="#edit_degree">
                    Edit
                </button>
                <a href="#" class="btn btn-danger" id="del" data-toggle="modal" data-target="#del_diag"
                   data-id="{{$degree->id}}">x</a>
            </td>
        </tr>
        </tbody>
    @endforeach
</table>
