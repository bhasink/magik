@extends('backend/layouts.master')

@section('content')
    <link href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>

    @include('backend/layouts.action')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gift State Listing</h1>
            <p style="float:right">
                @if (Sentinel::getUser()->hasAccess(['Gpin.AddGpin']))
                    <a href="{{ env('APP_URL') }}/admin/gstate/add/new"><button class="btn btn-success" title="Add Gift Assignment"> <i class="ace-icon fa fa-plus icon-only bigger-100"></i></button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['Gpin.Activate']))
                    <a href="javascript:act_rec('{{ env('APP_URL') }}/admin/gstate');"><button class="btn btn-info" title="Publish"><i class="ace-icon fa fa-eye icon-only bigger-100"></i> </button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['Gpin.Deactivate']))
                    <a href="javascript:inact_rec('{{ env('APP_URL') }}/admin/gstate');"><button class="btn btn-warning" title="Unpublish"><i class="ace-icon fa 	fa-eye-slash  icon-only bigger-100"></i></button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['Gpin.Destroy']))
                    <a href="javascript:del_rec('{{ env('APP_URL') }}/admin/gstate');"><button class="btn btn-danger" title="Delete"><i class="ace-icon fa fa-trash-o  icon-only bigger-100"></i></button></a>
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
                    Gift State Listing
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

                        <table width="100%" class="table table-striped table-bordered table-hover" id="example">
                            <thead>
                            <tr>
                                <th>Gift Name</th>
                                <th>Campaignid</th>
                                <th>Campaign name</th>
                                <th>State</th>
                                <th>Quantity by state</th>
                                <th>Total Qty</th>
                                <th><input	name="allchk" value="yes" type="checkbox" onClick="Check(document.form.chkid)"  />   All</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($gpins as $gpin)
                                <tr class="odd gradeX">
                                    <td>{{$gpin->gift_name }}</td>
                                    <td>{{$gpin->campaign_id}}</td>
									<td>{{$gpin->campaign_name}}</td>
                                    <td>{{$gpin->state_name}}</td>
                                    <td>{{$gpin->quantity}}</td>
									<td>{{$gpin->totgiftqty}}</td>
                                    <td class="center">


                                        <input name="chkid[{{$gpin->id }}]" id="chkid" type="checkbox" value="{{$gpin->id }}" class="checkbtn"  />

                                        @if($gpin->status == 1)
                                            @if (Sentinel::getUser()->hasAccess(['Gpin.Activate']))
                                                <a id="{{ $gpin->id }} active" class="pub_unpub" href="{{ env('APP_URL') }}/admin/gstate/{{$gpin->id}}/deactivate" onclick="return confirm('Are you sure you want to Inactivate record!');" ><img src="{{asset('backend/assets/images/tick-circle.gif')}}" width="16" height="16" border="0" title="Make Active"/></a>
                                            @endif
                                        @else
                                            @if (Sentinel::getUser()->hasAccess(['Gpin.Deactivate']))
                                                <a id="{{ $gpin->id }} inactive" class="pub_unpub" href="{{ env('APP_URL') }}/admin/gstate/{{$gpin->id}}/activate" onclick="return confirm('Are you sure you want to Activate record!');"><img src="{{asset('backend/assets/images/unpublish.gif')}}" width="16" height="16" border="0" title="Make Inactive"/></a>
                                            @endif
                                        @endif

                                        @if (Sentinel::getUser()->hasAccess(['Gpin.EditGpin']))
                                            <a href="{{ env('APP_URL') }}/admin/gstate/edit/{{$gpin->id }}"><img src="{{asset('backend/assets/images/pencil.gif')}}" width="16" height="16" border="0" /></a>
                                        @endif

                                        @if (Sentinel::getUser()->hasAccess(['Gpin.Destroy']))
                                            <a href="{{ env('APP_URL') }}/admin/gstate/{{$gpin->id }}/destroy" onClick="return confirm('Are you sure you want to delete record!');"><i class="fa fa-trash-o fa-fw"></i></a>
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ]
            } );
        } );
    </script>


@endsection
