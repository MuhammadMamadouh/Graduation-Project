 @foreach($jobs as $job)
<tr id="{{$job->id}}">
                <td>{{$job->en_title}}</td>
                <td>
                    <button type="button" id="edit" data-id="{{$job->id}}" class="btn btn-info" data-toggle="modal" data-target="#edit_job">
                        Edit
                    </button>
                    <a href="#" class="btn btn-danger" id="del" data-id="{{$job->id}}">x</a>
                </td>

            </tr>
            @endforeach