@extends('backend/layouts.master')

@section('content')

    @include('backend/layouts.action')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">QrCode</h1>
            <p style="float:right">

                @if (Sentinel::getUser()->hasAccess(['QrCode.AddQrCode']))
                    <a href="{{ env('APP_URL') }}/admin/qrcode/add/new"><button class="btn btn-success" title="Add QrCode"> <i class="ace-icon fa fa-plus icon-only bigger-100"></i></button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['QrCode.Activate']))
                    <a href="javascript:act_rec('{{ env('APP_URL') }}/admin/qrcode');"><button class="btn btn-info" title="Publish"><i class="ace-icon fa fa-eye icon-only bigger-100"></i> </button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['QrCode.Deactivate']))
                    <a href="javascript:inact_rec('{{ env('APP_URL') }}/admin/qrcode');"><button class="btn btn-warning" title="Unpublish"><i class="ace-icon fa 	fa-eye-slash  icon-only bigger-100"></i></button></a>
                @endif
<!--
                @if (Sentinel::getUser()->hasAccess(['QrCode.Destroy']))
                    <a href="javascript:del_rec('{{ env('APP_URL') }}/admin/qrcode');"><button class="btn btn-danger" title="Delete"><i class="ace-icon fa fa-trash-o  icon-only bigger-100"></i></button></a>
                @endif
--->

            </p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    QrCode Listing
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
                                <th>QrCode</th>
                               
                               
                                <th>Campaign Id</th>
                                 <th>Campaign Name</th>
                                <th>QR Id</th>
                                <th>Scan</th>
                                <th>Create Date</th>
                                <th><input	name="allchk" value="yes" type="checkbox" onClick="Check(document.form.chkid)"  />   All</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($qrcodes as $qrcode)
                                <tr class="odd gradeX">
                                    <td>{{  $qrcode->code }}</td>
                                     <td>{{  $qrcode->campaign_id }}</td>
                                    <td>{{  $qrcode->campaign_name }}</td>
                                   
                                    <td>{{  $qrcode->qr_id }}</td>
                                    <td>{{  $qrcode->scan }}</td>
                                    <td class="center">{{  $qrcode->created_at }}</td>
                                    <td class="center">


                                        <input name="chkid[{{  $qrcode->id }}]" id="chkid" type="checkbox" value="{{  $qrcode->id }}" class="checkbtn"  />

                                        @if($qrcode->status == 1)
                                            @if (Sentinel::getUser()->hasAccess(['QrCode.Activate']))
                                                <a id="{{  $qrcode->id }} active" class="pub_unpub" href="{{ env('APP_URL') }}/admin/qrcode/{{$qrcode->id}}/deactivate" onclick="return confirm('Are you sure you want to Inactivate record!');" ><img src="{{asset('backend/assets/images/tick-circle.gif')}}" width="16" height="16" border="0" title="Make Active"/></a>
                                            @endif
                                        @else
                                            @if (Sentinel::getUser()->hasAccess(['QrCode.Deactivate']))
                                                <a id="{{  $qrcode->id }} inactive" class="pub_unpub" href="{{ env('APP_URL') }}/admin/qrcode/{{$qrcode->id}}/activate" onclick="return confirm('Are you sure you want to Activate record!');"><img src="{{asset('backend/assets/images/unpublish.gif')}}" width="16" height="16" border="0" title="Make Inactive"/></a>
                                            @endif
                                        @endif

                                        @if (Sentinel::getUser()->hasAccess(['QrCode.EditQrCode']))
                                            <a href="{{ env('APP_URL') }}/admin/qrcode/edit/{{ $qrcode->id }}"><img src="{{asset('backend/assets/images/pencil.gif')}}" width="16" height="16" border="0" /></a>
                                        @endif

                                      <!--  @if (Sentinel::getUser()->hasAccess(['QrCode.Destroy']))
                                            <a href="{{ env('APP_URL') }}/admin/qrcode/{{ $qrcode->id }}/destroy" onClick="return confirm('Are you sure you want to delete record!');"><i class="fa fa-trash-o fa-fw"></i></a>
                                        @endif
--->
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