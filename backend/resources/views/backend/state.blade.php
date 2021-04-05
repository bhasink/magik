@extends('backend/layouts.master')

@section('content')

    @include('backend/layouts.action')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">States</h1>
            <p style="float:right">

                @if (Sentinel::getUser()->hasAccess(['State.AddState']))
                    <a href="{{ env('APP_URL') }}/admin/state/add/new"><button class="btn btn-success" title="Add Gift"> <i class="ace-icon fa fa-plus icon-only bigger-100"></i></button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['State.Activate']))
                    <a href="javascript:act_rec('{{ env('APP_URL') }}/admin/state');"><button class="btn btn-info" title="Publish"><i class="ace-icon fa fa-eye icon-only bigger-100"></i> </button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['State.Deactivate']))
                    <a href="javascript:inact_rec('{{ env('APP_URL') }}/admin/state');"><button class="btn btn-warning" title="Unpublish"><i class="ace-icon fa 	fa-eye-slash  icon-only bigger-100"></i></button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['State.Destroy']))
                    <a href="javascript:del_rec('{{ env('APP_URL') }}/admin/state');"><button class="btn btn-danger" title="Delete"><i class="ace-icon fa fa-trash-o  icon-only bigger-100"></i></button></a>
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
                    Asm/Bsm Listing
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
                                <th>State</th>
                                <th>Create Date</th>
                                <th><input	name="allchk" value="yes" type="checkbox" onClick="Check(document.form.chkid)"  />   All</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($states as $state)
                                <tr class="odd gradeX">
                                    <td>{{  $state->name }}</td>
                                    <td class="center">{{  $state->created_at }}</td>
                                    <td class="center">


                                        <input name="chkid[{{$state->id }}]" id="chkid" type="checkbox" value="{{$state->id }}" class="checkbtn"  />

                                        @if($state->status == 1)
                                            @if (Sentinel::getUser()->hasAccess(['State.Activate']))
                                                <a id="{{  $state->id }} active" class="pub_unpub" href="{{ env('APP_URL') }}/admin/state/{{$state->id}}/deactivate" onclick="return confirm('Are you sure you want to Inactivate record!');" ><img src="{{asset('backend/assets/images/tick-circle.gif')}}" width="16" height="16" border="0" title="Make Active"/></a>
                                            @endif
                                        @else
                                            @if (Sentinel::getUser()->hasAccess(['State.Deactivate']))
                                                <a id="{{  $state->id }} inactive" class="pub_unpub" href="{{ env('APP_URL') }}/admin/state/{{$state->id}}/activate" onclick="return confirm('Are you sure you want to Activate record!');"><img src="{{asset('backend/assets/images/unpublish.gif')}}" width="16" height="16" border="0" title="Make Inactive"/></a>
                                            @endif
                                        @endif

                                        @if (Sentinel::getUser()->hasAccess(['State.EditState']))
                                            <a href="{{ env('APP_URL') }}/admin/state/edit/{{$state->id }}"><img src="{{asset('backend/assets/images/pencil.gif')}}" width="16" height="16" border="0" /></a>
                                        @endif

                                        @if (Sentinel::getUser()->hasAccess(['State.Destroy']))
                                            <a href="{{ env('APP_URL') }}/admin/state/{{$state->id }}/destroy" onClick="return confirm('Are you sure you want to delete record!');"><i class="fa fa-trash-o fa-fw"></i></a>
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
