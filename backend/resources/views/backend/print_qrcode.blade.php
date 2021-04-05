@extends('backend/layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Print QR-Code</h1>
            <p style="float:right">
                <a href="{{ env('APP_URL') }}/admin/gift" class="btn btn-info" role="button">Back</a>
            </p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Print QR-Code
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
						 <form action="{{ env('APP_URL') }}/admin/generatepdf/printpdf/{{$campaign->campaign_id}}" method="get">
						<div class="form-group">
                               <label>Select QR-Code Limit</label>
							   <?php 
									// if($campaign->quantity >100){
									// $quantity=$campaign->quantity/50;
									// $start_limit=1;
									// $end_limit=
									
									// }
									?>
							 <select name="q_code" class="form-control" required>
								<option value="1-25">1 to 25</option>
								<option value="26-50">26 to 50</option>
								<option value="51-100">51 to 100</option>
								<option value="101-150">101 to 150</option>
								<option value="151-200">151 to 200</option>
								<option value="201-250">201 to 250</option>
								<option value="251-300">251 to 300</option>
								<option value="301-350">301 to 350</option>
								<option value="351-400">251 to 400</option>
								
							 </select>
							 

                        </div>
						<div class="form-group">
							 
							 <button type="submit" class="btn btn-default">Print-QR-Code</button>
						</div>
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
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script type="text/javascript">
        var domains = "{{url('/laravel-filemanager/')}}";
        $('#lfm').filemanager('image', {prefix: domains});
        $('#lfm1').filemanager('image', {prefix: domains});
    </script>
    <!-- /.row -->
@endsection