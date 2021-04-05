@extends('backend/layouts.master')

@section('content')
<link href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
 <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @include('backend/layouts.action')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gift Sequences</h1>
            <p style="float:right">

                @if (Sentinel::getUser()->hasAccess(['Gift.AddGift']))
                    <a href="{{ env('APP_URL') }}/admin/giftsequence/add/new"><button class="btn btn-success" title="Add Gift"> <i class="ace-icon fa fa-plus icon-only bigger-100"></i></button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['Gift.Activate']))
                    <a href="javascript:act_rec('{{ env('APP_URL') }}/admin/gift');"><button class="btn btn-info" title="Publish"><i class="ace-icon fa fa-eye icon-only bigger-100"></i> </button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['Gift.Deactivate']))
                    <a href="javascript:inact_rec('{{ env('APP_URL') }}/admin/gift');"><button class="btn btn-warning" title="Unpublish"><i class="ace-icon fa 	fa-eye-slash  icon-only bigger-100"></i></button></a>
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
                    Gift Listing
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

                        <table width="100%" class="table table-striped table-bordered table-hover"  id="example">
                            <thead>
                            <tr>
                              
								<th>Campaign Id</th>
							    <th>Campaign Name</th>
								  <th>Gift Name</th>
                              
								<th>Sequence</th>
                                <th>Craeted Date</th>
                                <th><input	name="allchk" value="yes" type="checkbox" onClick="Check(document.form.chkid)"  />   All</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($gifts as $gift)
                                <tr class="odd gradeX">
                                    <td>{{  $gift->campaign_id }}</td>
                                     <td>{{  $gift->campaign_name }}</td>
                                      <td>{{  $gift->gift_name }}</td>
                                  
								
									<td> @if($gift->serialno==0)
									        Special Case
								    @else {{$gift->serialno}} @endif</td>
                                    <td class="center">{{  date('d/m/Y',strtotime($gift->created_at)) }}</td>
                                    <td class="center">

                                        <a href="{{ env('APP_URL') }}/admin/giftsequence/edit/{{ $gift->assseqid }}"><img src="{{asset('backend/assets/images/pencil.gif')}}" width="16" height="16" border="0" /></a>
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
        "bDestroy": true,
        
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel'
        ]
    } );
} );
</script>

@endsection