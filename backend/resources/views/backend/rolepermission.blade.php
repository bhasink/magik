@extends('backend/layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">{{$role->is_group ?"Group ":"Role "}}{{$role->name}}</div>

        <div class="panel-body">


            <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/role/{{$role->id}}/save">


                @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif


                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif



                {{ csrf_field() }}
                <ul>
                    <div class="row">
                        @foreach($actions as $action)
                            <div class="col-md-4">
                                <?php $first= array_values($action)[0];
                                $firstname =explode(".", $first)[0];
                                ?>

                                {{Form::label($firstname, $firstname, ['class' => 'form col-md-2 capital_letter'])}}
                                <select name="permissions[]" class="select" multiple="multiple">
                                    @foreach($action as $act)
                                        @if(explode(".", $act)[0]=="api")
                                            <option value="{{$act}}"  {{array_key_exists($act, $role->permissions)?"selected":""}}>
                                                {{isset(explode(".", $act)[2])?explode(".", $act)[1].".".explode(".", $act)[2]:explode(".", $act)[1]}}</option>
                                        @else
                                            <option value="{{$act}}" {{array_key_exists($act, $role->permissions)?"selected":""}}>

                                                {{explode(".", $act)[1]}}

                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                          &nbsp;
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            {!! Form::submit('Submit', ['class' => 'btn btn-success form-control']) !!}
                        </div>

                    </div>
                </ul>
            </form>
        </div>
    </div>

    <script src="{{ URL::asset('backend/sumoselect/jquery.sumoselect.js') }}"></script>
    <link href="{{ URL::asset('backend/sumoselect/sumoselect.css') }}" rel="stylesheet" />

    <script type="text/javascript">
        $('.select').SumoSelect({ selectAll: true, placeholder: 'Nothing selected' });
    </script>

@endsection