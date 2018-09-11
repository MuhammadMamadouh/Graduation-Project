@foreach($years as $year)
    <li class="treeview" id="year">

        <a href="#">
            <i class="fa fa-fw fa-circle-o "></i>
            <span> year: {{$year->name}}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
        </a>
        <ul class="treeview-menu">
            <li class="">
                <a href="{{rtrim(\URL::current(), 'years')}}year/{{$year->id}}">
                    <i class="fa fa-fw fa-circle-o "></i>
                    <span>view</span>
                </a>
            </li>
            <li class="">
                <a href="#" data-toggle="modal" id="del" data-id="{{$year->id}}" data-target="#del_diag">
                    <i class="fa fa-fw fa-circle-o "></i>
                    <span>Delete</span>
                </a>
            </li>

        </ul>
@endforeach