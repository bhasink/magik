@extends('backend/layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Asm/Bsm</h1>
            <p style="float:right">
                <a href="{{ env('APP_URL') }}/admin/bsm" class="btn btn-info" role="button">Back</a>
            </p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add /Edit Asm/Bsm
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">


                            @empty($bsms)
                                <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/bsm/add/new" enctype="multipart/form-data">
                                    @endempty

                                    @isset($bsms)
                                        <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/bsm/edit/{{$bsms->id}}" enctype="multipart/form-data">
                                            @endisset


                                            {{ csrf_field() }}


                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label>Bsm Email Id</label>

                                                <input id="email" type="email" class="form-control" name="email" value="{{ isset($bsms->email) ? $bsms->email : old('email') }}" required autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif
                                            </div>


                                            <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                                                <label>State</label>
                                                <select name="state" id="state" class="form-control" required autofocus>
                                                    <option value="">Select</option>
                                                    <option value="2">Delhi</option>
                                                </select>
                                                @if ($errors->has('state'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                                <label>Type</label>
                                                <select name="state" id="state" class="form-control" required autofocus>
                                                    <option value="">Type</option>
                                                    <option value="1" @isset($bsms->type)  @if($bsms->type==1){{ 'selected' }} @endif @endisset>Asm</option>
                                                    <option value="2" @isset($bsms->type)  @if($bsms->type==2){{ 'selected' }} @endif @endisset>Bsm</option>
                                                </select>
                                                @if ($errors->has('type'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                                @endif
                                            </div>


                                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control" required autofocus>
                                                    <option value="">Select</option>
                                                    <option value="1" @isset($bsms->status)  @if($bsms->status==1){{ 'selected' }} @endif @endisset>Active</option>
                                                    <option value="0" @isset($bsms->status)  @if($bsms->status==0){{ 'selected' }} @endif @endisset>Inactive</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                            @empty($bsms)
                                                <button type="submit" class="btn btn-default">Add Bsm</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            @endempty

                                            @isset($bsms)
                                                <button type="submit" class="btn btn-default">Update Bsm</button>
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
