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
                    Add /	Edit Gift State
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">


                            @empty($gpins)
                                <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/gstate/add/new" enctype="multipart/form-data">
                                    @endempty

                                    @isset($gpins)
                                        <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/gstate/edit/{{$gpins->id}}" enctype="multipart/form-data">
                                            @endisset


                                            {{ csrf_field() }}


                                            <div class="form-group {{ $errors->has('gift_name') ? ' has-error' : '' }}">
											  <div class="form-group {{ $errors->has('giftid') ? ' has-error' : '' }}">
                                                    <label>Campaign</label>
                                                    <select name="campaign_id" id="status" class="form-control" required autofocus>
                                                        <option value="">Select</option>
														@foreach($campaign as $campaign)
														  <option value="{{$campaign['campaign_id']}}" @if($campaign['campaign_id']==$gpins['campaign_id']) selected @endif>{{$campaign['campaign_name']}}</option>
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
                                                    <select name="gift_id" id="status" class="form-control" required autofocus>
                                                        <option value="">Select</option>
														@foreach($gifts as $gift)
														  <option value="{{$gift['id']}}" @if($gift['id']==$gpins['gift_id']) selected @endif>{{$gift['gift_name']}}</option>
														@endforeach
                                                    </select>
                                                    @if ($errors->has('gift_id'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('giftid') }}</strong>
													</span>
                                                    @endif
                                                </div>
												  <div class="form-group {{ $errors->has('quantity') ? ' has-error' : '' }}">
                                                <label>Quantity</label>

                                                <input id="quantity" type="text" class="form-control" name="quantity" value="{{ isset($gpins->quantity) ? $gpins->quantity : old('quantity') }}" required autofocus>

                                                @if ($errors->has('quantity'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                                    <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                                                        <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                                                            <label>State</label>
                                                            <select name="state" id="status" class="form-control" required autofocus>
                                                                <option value="">Select State</option>
																@foreach($states as $state)
																  <option value="{{$state['id']}}" @if($state['id']==$gpins['state']) selected @endif>{{$state['name']}}</option>
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
                                                    <option value="1" @isset($gpins->status)  @if($gpins->status==1){{ 'selected' }} @endif @endisset>Active</option>
                                                    <option value="0" @isset($gpins->status)  @if($gpins->status==0){{ 'selected' }} @endif @endisset>Inactive</option>
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
