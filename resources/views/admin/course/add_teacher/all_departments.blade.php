@if(count($departments)==0)
    <div class="alert alert-danger">No departments yet</div>
@endif
<option id="" value="">Choose Department</option>
@foreach($departments as $department)

    <option id="{{$department->id}}" value="{{$department->id}}">
        {{$department->en_name}}</option>
@endforeach