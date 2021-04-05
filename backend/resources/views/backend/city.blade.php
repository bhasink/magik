@extends('backend/layouts.master')

@section('content')

    @include('backend/layouts.action')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cities</h1>
            <p style="float:right">

                @if (Sentinel::getUser()->hasAccess(['City.AddCity']))
                    <a href="{{ env('APP_URL') }}/admin/city/add/new"><button class="btn btn-success" title="Add City"> <i class="ace-icon fa fa-plus icon-only bigger-100"></i></button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['City.Activate']))
                    <a href="javascript:act_rec('{{ env('APP_URL') }}/admin/city');"><button class="btn btn-info" title="Publish"><i class="ace-icon fa fa-eye icon-only bigger-100"></i> </button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['City.Deactivate']))
                    <a href="javascript:inact_rec('{{ env('APP_URL') }}/admin/city');"><button class="btn btn-warning" title="Unpublish"><i class="ace-icon fa 	fa-eye-slash  icon-only bigger-100"></i></button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['City.Destroy']))
                    <a href="javascript:del_rec('{{ env('APP_URL') }}/admin/city');"><button class="btn btn-danger" title="Delete"><i class="ace-icon fa fa-trash-o  icon-only bigger-100"></i></button></a>
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
                    City Listing
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
                                <th>City</th>
                                <th>State</th>
                                <th>Create Date</th>
                                <th><input	name="allchk" value="yes" type="checkbox" onClick="Check(document.form.chkid)"  />   All</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($cities as $city)
                                <tr class="odd gradeX">
                                    <td>{{ $city->name}}</td>
                                    <td>{{ $city->stateid}}</td>
                                    <td class="center">{{$city->created_at}}</td>
                                    <td class="center">


                                        <input name="chkid[{{$city->id }}]" id="chkid" type="checkbox" value="{{$city->id }}" class="checkbtn"  />

                                        @if($city->status == 1)
                                            @if (Sentinel::getUser()->hasAccess(['City.Activate']))
                                                <a id="{{  $city->id }} active" class="pub_unpub" href="{{ env('APP_URL') }}/admin/city/{{$city->id}}/deactivate" onclick="return confirm('Are you sure you want to Inactivate record!');" ><img src="{{asset('backend/assets/images/tick-circle.gif')}}" width="16" height="16" border="0" title="Make Active"/></a>
                                            @endif
                                        @else
                                            @if (Sentinel::getUser()->hasAccess(['City.Deactivate']))
                                                <a id="{{ $city->id }} inactive" class="pub_unpub" href="{{ env('APP_URL') }}/admin/city/{{$city->id}}/activate" onclick="return confirm('Are you sure you want to Activate record!');"><img src="{{asset('backend/assets/images/unpublish.gif')}}" width="16" height="16" border="0" title="Make Inactive"/></a>
                                            @endif
                                        @endif

                                        @if (Sentinel::getUser()->hasAccess(['City.EditCity']))
                                            <a href="{{ env('APP_URL') }}/admin/city/edit/{{$city->id }}"><img src="{{asset('backend/assets/images/pencil.gif')}}" width="16" height="16" border="0" /></a>
                                        @endif

                                        @if (Sentinel::getUser()->hasAccess(['City.Destroy']))
                                            <a href="{{ env('APP_URL') }}/admin/city/{{$city->id }}/destroy" onClick="return confirm('Are you sure you want to delete record!');"><i class="fa fa-trash-o fa-fw"></i></a>
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
