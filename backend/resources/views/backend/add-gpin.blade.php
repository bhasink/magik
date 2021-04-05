@extends('backend/layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gift By State</h1>
            <p style="float:right">
                <a href="{{ env('APP_URL') }}/admin/gstate" class="btn btn-info" role="button">Back</a>
            </p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Gift by State
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">



                                <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/gstate/add/new" enctype="multipart/form-data">

                                            {{ csrf_field() }}


                                            <div class="form-group {{ $errors->has('gift_name') ? ' has-error' : '' }}">
											  <div class="form-group {{ $errors->has('giftid') ? ' has-error' : '' }}">
                                                    <label>Campaign</label>
                                                    <select name="campaign_id" id="status" class="form-control" required autofocus>
                                                        <option value="">Select</option>
														@foreach($campaign as $campaign)
														  <option value="{{$campaign['campaign_id']}}" >{{$campaign['campaign_name']}}</option>
														@endforeach
                                                    </select>
                                                    @if ($errors->has('gift_id'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('giftid') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('giftid') ? ' has-error' : '' }}">
                                                    <label>Gift</label>
                                                    <select name="gift_id" id="gift_id" class="form-control" required autofocus>
                                                        <option value="">Select</option>

                                                    </select>
                                                    @if ($errors->has('gift_id'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('giftid') }}</strong>
													</span>
                                                    @endif
                                                </div>
												  <div class="form-group {{ $errors->has('quantity') ? ' has-error' : '' }}">
                                                <label>Quantity</label>

                                                <input id="quantity" type="text" class="form-control" name="quantity" value="" required autofocus>

                                                @if ($errors->has('quantity'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                                    <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                                                        <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                                                            <label>State</label>
                                                            <select name="state" id="state" class="form-control" required autofocus>
                                                                <option value="">Select State</option>
																@foreach($states as $state)
																  <option value="{{$state['id']}}" >{{$state['name']}}</option>
																@endforeach
                                                            </select>
                                                            @if ($errors->has('state'))
                                                                <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>



                                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control" required autofocus>
                                                    <option value="">Select</option>
                                                    <option value="1"   >Active</option>
                                                    <option value="0"  >Inactive</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                                @endif
                                            </div>


                                                <button type="submit" class="btn btn-default">Add Gift</button>
                                                <button type="reset" class="btn btn-default">Reset</button>



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


		function getMessage() {
            $.ajax({
               type:'POST',
               url:'{{env('APP_URL')}}/admin/getmsg',
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data) {
                  $("#msg").html(data.msg);
               }
            });
         }
    </script>


    <script type="text/javascript">
        $("select[name='campaign_id']").change(function(){
            var campaign_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: '{{env('APP_URL')}}/admin/getgift',
                method: 'GET',
                data: {campaign_id:campaign_id, _token:token},
                success: function(data) {
                $('#gift_id').html(data);
                }
            });
        });
    </script>
    <!-- /.row -->
@endsection
