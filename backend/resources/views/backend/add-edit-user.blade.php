@extends('backend/layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Administartor</h1>
        <p style="float:right">
            <a href="{{ env('APP_URL') }}/admin/user" class="btn btn-info" role="button">Back</a>
        </p>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add /	Edit User
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">


                        @empty($users)
                            <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/user/add/new">
                        @endempty

                        @isset($users)
                                    <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/user/edit/{{$users->id}}">
                        @endisset





                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label>First Name</label>

                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ isset($users->first_name) ? $users->first_name : old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label>Last Name</label>
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ isset($users->last_name) ? $users->last_name : old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ isset($users->email) ? $users->email : old('email') }}" required>


                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>



                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control" name="password" value="" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group {{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                                <label>Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="" required>
                                @if ($errors->has('password-confirm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password-confirm') }}</strong>
                                    </span>
                                @endif
                            </div>



                            <div class="form-group {{ $errors->has('location') ? ' has-error' : '' }}">
                                <label>Location</label>
                                <input id="location" type="text" class="form-control" name="location" value="{{ isset($users->location) ? $users->location : old('location') }}" required autofocus>

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>




                            <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                <label>Roles</label>




                                <select name="role" id="role" class="form-control" required autofocus>
                                    <option value="">Select</option>


                                        <option value="root" @isset($roles->slug) @if($roles->slug=='root'){{ 'selected' }} @endif @endisset>Root Base</option>
                                        <option value="sadmin" @isset($roles->slug) @if($roles->slug=='sadmin'){{ 'selected' }} @endif @endisset>Super Admin</option>
                                        <option value="admin" @isset($roles->slug) @if($roles->slug=='admin'){{ 'selected' }} @endif @endisset>Administrator</option>
                                        <option value="manager" @isset($roles->slug) @if($roles->slug=='manager'){{ 'selected' }} @endif @endisset>Manager</option>
                                        <option value="steam"@isset($roles->slug)  @if($roles->slug=='steam'){{ 'selected' }} @endif @endisset>Sales Team</option>
                                        <option value="registered" @isset($roles->slug) @if($roles->slug=='registered'){{ 'selected' }} @endif @endisset>Registered</option>
                                        <option value="employee" @isset($roles->slug) @if($roles->slug=='employee'){{ 'selected' }} @endif @endisset>Employee</option>
                                        <option value="operater" @isset($roles->slug) @if($roles->slug=='operater'){{ 'selected' }} @endif @endisset>Operater</option>


                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control" required autofocus>
                                    <option value="">Select</option>
                                    <option value="1" @isset($users->status)  @if($users->status==1){{ 'selected' }} @endif @endisset>Active</option>
                                    <option value="0" @isset($users->status)  @if($users->status==0){{ 'selected' }} @endif @endisset>Inactive</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>

                            @empty($users)
                                            @if (Sentinel::getUser()->hasAccess(['User.AddUser']))
                            <button type="submit" class="btn btn-default">Register</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                                            @endif
                            @endempty

                            @isset($users)
                                            @if (Sentinel::getUser()->hasAccess(['User.EditUser']))
                                <button type="submit" class="btn btn-default">Update</button>
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