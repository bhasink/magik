@extends('backend/layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gift</h1>
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
                                <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/gift/add/new" enctype="multipart/form-data">
                                    @endempty

                                    @isset($gifts)
                                        <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/gift/edit/{{$gifts->id}}" enctype="multipart/form-data">
                                            @endisset


                                            {{ csrf_field() }}

											<div class="form-group {{ $errors->has('giftid') ? ' has-error' : '' }}">
                                                    <label>Campaign</label>
                                                    <select name="campaign_id" id="campaign_id" class="form-control" required autofocus>
                                                        <option value="0">Select</option>
														@foreach($Campaign as $campaign)
														  <option value="{{$campaign['campaign_id']}}"  @isset($gifts->campaign_id)  @if($gifts->campaign_id==$campaign['campaign_id']){{ 'selected' }} @endif @endisset>{{$campaign['campaign_name'].'-'. $campaign['campaign_id']}}</option>
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

                                                <input id="gift_name" type="text" class="form-control" name="gift_name" value="{{ isset($gifts->gift_name) ? $gifts->gift_name : old('gift_name') }}" required autofocus>

                                                @if ($errors->has('gift_name'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('gift_name') }}</strong>
                                    </span>
                                                @endif
                                            </div>


                                            <div class="form-group {{ $errors->has('quantity') ? ' has-error' : '' }}">
                                                <label>Quantity</label>

                                                <input id="quantity" type="text" class="form-control" name="quantity" value="{{ isset($gifts->quantity) ? $gifts->quantity : old('quantity') }}" required autofocus>

                                                @if ($errors->has('quantity'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                                @endif
                                            </div>


											<div class="form-group">
                                                <label>Image</label>
                                                <div class="input-group">
                                                    <span class="input-group-btn"><a  data-input="img1data" data-preview="holder1" class="btn btn-primary" id="lfm1"><i class="fa fa-picture-o"></i> Choose</a></span>
                                                    <input id="img1data"  value="{{(isset($gifts->gift_img))?$gifts->gift_img:''}}" class="form-control" type="text" name="gift_img">
                                                </div>
                                                <img id="holder1" style="margin-top:15px;max-height:100px;">
                                            </div>
                                         <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                                <label>Gift Type</label>
                                                <select name="type" id="type" class="form-control" required autofocus>
                                                    <option value="">Select</option>
                                                    <option value="0" @isset($gifts->type)  @if($gifts->type==0){{ 'selected' }} @endif @endisset>Normal</option>
                                                    <option value="1" @isset($gifts->type)  @if($gifts->type==1){{ 'selected' }} @endif @endisset>With State</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="help-block">
												<strong>{{ $errors->first('status') }}</strong>
											</span>
                                                @endif
                                            </div>

											
                                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control" required autofocus>
                                                    <option value="">Select</option>
                                                    <option value="1" @isset($gifts->status)  @if($gifts->status==1){{ 'selected' }} @endif @endisset>Active</option>
                                                    <option value="0" @isset($gifts->status)  @if($gifts->status==0){{ 'selected' }} @endif @endisset>Inactive</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="help-block">
												<strong>{{ $errors->first('status') }}</strong>
											</span>
                                                @endif
                                            </div>

                                            @empty($gifts)
                                                <button type="submit" class="btn btn-default">Add Gift</button>
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
    <script type="text/javascript">
        var domains = "{{url('/laravel-filemanager/')}}";
        $('#lfm').filemanager('image', {prefix: domains});
        $('#lfm1').filemanager('image', {prefix: domains});
    </script>
    <!-- /.row -->
@endsection