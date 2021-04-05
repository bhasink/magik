@extends('backend/layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Role</h1>
            <p style="float:right">
                <a href="{{ env('APP_URL') }}/admin/role" class="btn btn-info" role="button">Back</a>
            </p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add /	Edit Role
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">


                            @empty($roles)
                                <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/role/add/new">
                                    @endempty

                                    @isset($roles)
                                        <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/role/edit/{{$roles->id}}">
                                            @endisset





                                            {{ csrf_field() }}


                                           <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                                                <label>Slug Name</label>
                                                <input id="slug" type="text" class="form-control" name="slug" value="{{ isset($roles->slug) ? $roles->slug : old('slug') }}" required autofocus>
                                                @if ($errors->has('slug'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                                @endif
                                            </div>


                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>Role Name</label>

                                                <input id="name" type="text" class="form-control" name="name" value="{{ isset($roles->name) ? $roles->name : old('name') }}" required autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                @endif
                                            </div>



                                            @empty($roles)
                                                @if (Sentinel::getUser()->hasAccess(['Role.AddRole']))
                                                <button type="submit" class="btn btn-default">Add Role</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                                @endif
                                            @endempty

                                            @isset($roles)
                                                @if (Sentinel::getUser()->hasAccess(['Role.EditRole']))
                                                <button type="submit" class="btn btn-default">Update Role</button>
                                                @endif
                                            @endisset


                                        </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->

                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection