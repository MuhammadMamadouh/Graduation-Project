@if(count($staffs)==0)
    <div class="alert alert-danger">No departments yet</div>
@endif
<option id="" value="">Choose Teacher</option>
@foreach($staffs as $staff)

    <option id="{{$staff->id}}" value="{{$staff->id}}">
        {{$staff->en_name}}</option>
@endforeach
