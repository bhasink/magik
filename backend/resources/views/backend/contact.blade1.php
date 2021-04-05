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
            <div class="filters-groups">
                <h4>Filter By Date</h4>
                <p>Min Date : <input class="date-picker-min" id="min" type="text"></p>
                <p>Max Date : <input class="date-picker-max" id="max" type="text"></p></div>
            <h1 class="page-header">Contact Listing</h1>
            <p style="float:right">

                @if (Sentinel::getUser()->hasAccess(['Contact.Activate']))
                    <a href="javascript:act_rec('{{ env('APP_URL') }}/admin/contact');"><button class="btn btn-info" title="Publish"><i class="ace-icon fa fa-eye icon-only bigger-100"></i> </button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['Contact.Deactivate']))
                    <a href="javascript:inact_rec('{{ env('APP_URL') }}/admin/contact');"><button class="btn btn-warning" title="Unpublish"><i class="ace-icon fa 	fa-eye-slash  icon-only bigger-100"></i></button></a>
                @endif

                @if (Sentinel::getUser()->hasAccess(['Contact.Destroy']))
                    <a href="javascript:del_rec('{{ env('APP_URL') }}/admin/contact');"><button class="btn btn-danger" title="Delete"><i class="ace-icon fa fa-trash-o  icon-only bigger-100"></i></button></a>
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
                    Contact Listing
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body" style="overflow-x: scroll;
						  overflow-y: hidden;
						  white-space: nowrap;">

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
							 <th>Campign Id</th>
                               <th>QR Code</th>
                                <th>Outlet Name</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Distributor Name</th>
                                <th>City</th>
                               
                                <th>Gift Name</th>
                                <th>Date</th>
                                <th><input	name="allchk" value="yes" type="checkbox" onClick="Check(document.form.chkid)"  />   All</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($contacts as $contact)
                                <tr class="odd gradeX">
									<td>{{$contact->campaign_id }}</td>
                                    <td>{{$contact->code }}</td>
									<td>{{$contact->outlet_name }}</td>
                                    <td>{{$contact->name }}</td>
                                    <td>{{$contact->mobile }}</td>
                                    <td>{{$contact->email }}</td>
                                    <td>{{$contact->distributor_name }}</td>
                                    <td>{{$contact->city }}</td>
                                    
                                    <td>{{$contact->gift_name}}</td>
                                    <td>{{$contact->created_at }}</td>
                                    <td class="center">


                                        <input name="chkid[{{$contact->id }}]" id="chkid" type="checkbox" value="{{$contact->id }}" class="checkbtn"  />

                                        @if($contact->status == 1)
                                            @if (Sentinel::getUser()->hasAccess(['Contact.Activate']))
                                                <a id="{{ $contact->id }} active" class="pub_unpub" href="{{ env('APP_URL') }}/admin/contact/{{$contact->id}}/deactivate" onclick="return confirm('Are you sure you want to Inactivate record!');" ><img src="{{asset('backend/assets/images/tick-circle.gif')}}" width="16" height="16" border="0" title="Make Active"/></a>
                                            @endif
                                        @else
                                            @if (Sentinel::getUser()->hasAccess(['Contact.Deactivate']))
                                                <a id="{{ $contact->id }} inactive" class="pub_unpub" href="{{ env('APP_URL') }}/admin/contact/{{$contact->id}}/activate" onclick="return confirm('Are you sure you want to Activate record!');"><img src="{{asset('backend/assets/images/unpublish.gif')}}" width="16" height="16" border="0" title="Make Inactive"/></a>
                                            @endif
                                        @endif
                                    <!--
                                        @if (Sentinel::getUser()->hasAccess(['Contact.EditContact']))
                                            <a href="{{ env('APP_URL') }}/admin/contact/edit/{{$contact->id }}"><img src="{{asset('backend/assets/images/pencil.gif')}}" width="16" height="16" border="0" /></a>
                                        @endif
                                        -->

                                        @if (Sentinel::getUser()->hasAccess(['Contact.Destroy']))
                                            <a href="{{ env('APP_URL') }}/admin/contact/{{$contact->id }}/destroy" onClick="return confirm('Are you sure you want to delete record!');"><i class="fa fa-trash-o fa-fw"></i></a>
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
        "bDestroy": true,
        "columnDefs": [
			{ "orderable": false, "targets": 0 }
		  ],
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel'
        ]
    } );
} );
    // No conflict for WordPress
   // var $j = jQuery.noConflict();

    // No conflict for WordPress
    //var $j = jQuery.noConflict();



    $(document).ready(function(){
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = $('.date-picker-min').datepicker("getDate");
                var max = $('.date-picker-max').datepicker("getDate");
                //console.log(min);
                 //console.log(max);
                var startDate = new Date(data[8]);
                if (min == null && max == null) { return true; }
                if (min == null && startDate <= max) { return true;}
                if(max == null && startDate >= min) {return true;}
                if (startDate <= max && startDate >= min) { return true; }
                return false;
            }
        );


        $(".date-picker-min").datepicker({ onSelect: function () { table.draw();}, changeMonth: true, changeYear: true });
        $(".date-picker-max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
        
        var table = $('#example').DataTable();

    // Add event listeners to the two range filtering inputs
      //$('#min').keyup( function() { table.draw(); } );
      //$('#max').keyup( function() { table.draw(); } );
        // Event listener to the two range filtering inputs to redraw on input
        $('.date-picker-min, .date-picker-max').change(function () {
            table.draw();
        });
    });




    </script>


@endsection
