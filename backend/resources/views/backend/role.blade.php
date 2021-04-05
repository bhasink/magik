@extends('backend/layouts.master')

@section('content')

    @include('backend/layouts.action')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Role</h1>
            <p style="float:right">

                @if (Sentinel::getUser()->hasAccess(['Role.AddRole']))
                <a href="{{ env('APP_URL') }}/admin/role/add/new"><button class="btn btn-success" title="Add User"> <i class="ace-icon fa fa-plus icon-only bigger-100"></i></button></a>
                @endif

            </p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Role Listing
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">

                    <form action="" method="post" enctype="multipart/form-data" name="form">

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

                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($roles as $user)
                                <tr class="odd gradeX">
                                    <td>{{  $user->name }}</td>
                                    <td class="center">{{  $user->created_at }}</td>
                                    <td class="center">


                                        @if (Sentinel::getUser()->hasAccess(['Role.EditRole']))
                                        <a href="{{ env('APP_URL') }}/admin/role/edit/{{ $user->id }}"><img src="{{asset('backend/assets/images/pencil.gif')}}" width="16" height="16" border="0" /></a>
                                        @endif

                                            @if (Sentinel::getUser()->hasAccess(['Role.Permission']))
                                            <a href="{{ env('APP_URL') }}/admin/role/{{ $user->id }}/rolepermission"><i class="fa fa-lock fa-fw"></i>Permissions</a>
                                            @endif
                                    </td>
                                </tr>
                            @endforeach




                            </tbody>
                        </table>
                    </form>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>


@endsection