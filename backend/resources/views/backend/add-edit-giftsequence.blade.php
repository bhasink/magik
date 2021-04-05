@extends('backend/layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Set Gift Sequence</h1>
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
                    Add /	Edit Gift
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">


                            @empty($gifts)
                                <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/giftsequence/add/new" enctype="multipart/form-data">
                                    @endempty

                                    @isset($gifts)
                                        <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/giftsequence/edit/{{$gifts->id}}" enctype="multipart/form-data">
                                            @endisset


                                            {{ csrf_field() }}

											<div class="form-group {{ $errors->has('giftid') ? ' has-error' : '' }}">
                                                    <label>Campaign</label>
                                                    <select name="campaign_id" id="campaign_id" class="form-control" required autofocus>
                                                        <option value="0">Select</option>
														@foreach($Campaign as $campaign)
														  <option value="{{$campaign['campaign_id']}}"  @isset($gifts->campaign_id)  @if($gifts->campaign_id==$campaign['campaign_id']){{ 'selected' }} @endif @endisset> <b>{{$campaign['campaign_id'].'-'.$campaign['campaign_name']}}</option>
														@endforeach
                                                    </select>
                                                    @if ($errors->has('gift_id'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('giftid') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                            <div class="form-group {{ $errors->has('gift_name') ? ' has-error' : '' }}">
                                                <label>Gift Name</label>
												  <select name="gift_id" id="gift_id" class="form-control" required autofocus>
                                                        <option value="0">Select</option>
														@foreach($Giftlist as $Giftlist)
									<option value="{{$Giftlist->id}}"  @isset($gifts->giftid)  @if($Giftlist->id==$gifts->giftid){{ 'selected' }} @endif @endisset> <b>{{$Giftlist['gift_name'].'-'.$Giftlist->gift_id}}</option>
														@endforeach
                                                    </select>
                                              

                                                @if ($errors->has('gift_id'))
                                                    <span class="help-block">
														<strong>{{ $errors->first('gift_id') }}</strong>
													</span>
                                                @endif
                                            </div>


                                            <div class="form-group {{ $errors->has('sequence') ? ' has-error' : '' }}">
                                                <label>Sequence</label>
	            <select name="sequence_no[]" id="sequence" multiple required autofocus  class="form-control"  @isset($gifts) disabled  @endisset>
                            @for($i=1;$i<=150;$i++)
					<option value="{{$i}}"  @isset($gifts->serialno)  @if($i==$gifts->serialno){{ 'selected' }} @endif  @endisset> 
									        <b>{{$i}}</b>
						</option>
														 
							@endfor         
										</select>
                        @isset($gifts)
                        <input type="hidden" name="sequence" @isset($gifts) value="{{$gifts->serialno}}"   @endisset>
                        @endisset
                                                @if ($errors->has('sequence'))
                                                    <span class="help-block">
												<strong>{{ $errors->first('sequence') }}</strong>
												</span>
                                                @endif
                                            </div>


                                            
                                            @empty($gifts)
                                                <button type="submit" class="btn btn-default">Add Gift Sequence</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            @endempty

                                            @isset($gifts)
                                                <button type="submit" class="btn btn-default">Update Gift</button>
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
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
 
 <script type="text/javascript">
 $('#sequence').multiselect({
  nonSelectedText: 'Select Sequence',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'100%'
 });
  </script>
    <script type="text/javascript">
        var domains = "{{url('/laravel-filemanager/')}}";
        $('#lfm').filemanager('image', {prefix: domains});
        $('#lfm1').filemanager('image', {prefix: domains});
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