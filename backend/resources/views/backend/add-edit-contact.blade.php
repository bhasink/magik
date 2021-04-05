@extends('backend/layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Contact</h1>
            <p style="float:right">
                <a href="{{ env('APP_URL') }}/admin/contact" class="btn btn-info" role="button">Back</a>
            </p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add/Edit Contact
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">


                            @empty($contacts)
                                <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/contact/add/new" enctype="multipart/form-data">
                                    @endempty

                                    @isset($contacts)
                                        <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/contact/edit/{{$contacts->id}}" enctype="multipart/form-data">
                                            @endisset


                                            {{ csrf_field() }}


                                            <div class="form-group {{ $errors->has('gift_id') ? ' has-error' : '' }}">
                                                <label>Gift Name</label>

                                                <input id="gift_name" type="text" class="form-control" value=" {{$contacts->giftname($contacts['gift_id'])}}" required autofocus>

                                                @if ($errors->has('gift_id'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('gift_id') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                                <label>Gift Code</label>

                                                <input id="gift_name" type="text" class="form-control" value="{{ isset($contacts->code) ? $contacts->code : old('code') }}" required autofocus>

                                                @if ($errors->has('code'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('outlet_name') ? ' has-error' : '' }}">
                                                <label>Gift Code</label>

                                                <input id="outlet_name" type="text" class="form-control" value="{{ isset($contacts->outlet_name) ? $contacts->outlet_name : old('outlet_name') }}" required autofocus>

                                                @if ($errors->has('outlet_name'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('outlet_name') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>Gift Code</label>

                                                <input id="name" type="text" class="form-control" value="{{ isset($contacts->name) ? $contacts->name : old('name') }}" required autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                                <label>Gift Code</label>

                                                <input id="name" type="text" class="form-control" value="{{ isset($contacts->mobile) ? $contacts->mobile : old('mobile') }}" required autofocus>

                                                @if ($errors->has('mobile'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label>Email</label>
                                                <input id="name" type="text" class="form-control" value="{{ isset($contacts->email) ? $contacts->email : old('mobile') }}" required autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('distributor_name') ? ' has-error' : '' }}">
                                                <label>Distributor Name</label>
                                                <input id="name" type="text" class="form-control" value="{{ isset($contacts->distributor_name) ? $contacts->distributor_name : old('distributor_name') }}" required autofocus>
                                                @if ($errors->has('distributor_name'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('distributor_name') }}</strong>
                                               </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                                <label>City</label>
                                                <input id="name" type="text" class="form-control" value="{{ isset($contacts->city) ? $contacts->city : old('city') }}" required autofocus>
                                                @if ($errors->has('city'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                             </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('delivery') ? ' has-error' : '' }}">
                                                <label>Delivery Status</label>
                                                <select name="delivery" id="status" class="form-control" required autofocus>
                                                    <option value="">Select</option>
                                                    <option value="1" @isset($contacts->delivery)  @if($contacts->delivery==1){{ 'selected' }} @endif @endisset>Delivered</option>
                                                    <option value="0" @isset($contacts->delivery)  @if($contacts->delivery==0){{ 'selected' }} @endif @endisset>Not Delivered</option>
                                                </select>
                                                @if ($errors->has('deliver'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('deliver') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control" required autofocus>
                                                    <option value="">Select</option>
                                                    <option value="1" @isset($contacts->status)  @if($contacts->status==1){{ 'selected' }} @endif @endisset>Active</option>
                                                    <option value="0" @isset($contacts->status)  @if($contacts->status==0){{ 'selected' }} @endif @endisset>Inactive</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                            @empty($contacts)
                                                <button type="submit" class="btn btn-default">Add Contact</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            @endempty

                                            @isset($contacts)
                                                <button type="submit" class="btn btn-default">Update Contact</button>
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
