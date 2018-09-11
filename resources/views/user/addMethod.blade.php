<div class="modal fade" id="addMethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Faculty</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-style-5">
                    <form id="ins_method" class="form-horizontal" method="POST" action="{{route('addMethod')}}">
                        {{ csrf_field() }}

                            <input name="course_code" type="hidden" value="{{$course->code}}">

                        <fieldset>
                            <legend><span class="number"></span> Course learning method :</legend>
                            {{--@foreach($allMethods as $method)--}}
                                {{--<label class="container">{{$method->en_title}}--}}
                                    {{--<input name="method_id[]" value="{{$method->id}}" type="checkbox">--}}
                                    {{--<span class="checkmark"></span>--}}
                                {{--</label>--}}
                            {{--@endforeach--}}
                            @foreach($allMethods as $allMethod)

                                    <label class="container">{{$allMethod->en_title}}
                                        <input name="method_id[]"
                                               @foreach($methods as $method)
                                               @if($allMethod->id === $method->id) checked @endif
                                               @endforeach
                                               value="{{$allMethod->id}}" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>

                            @endforeach
                            </fieldset>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>