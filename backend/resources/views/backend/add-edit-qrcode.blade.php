@extends('backend/layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">QrCode</h1>
            <p style="float:right">
                <a href="{{ env('APP_URL') }}/admin/qrcode" class="btn btn-info" role="button">Back</a>
            </p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add /	Edit QrCode
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">


                            @empty($qrcodes)
                                <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/qrcode/add/new" enctype="multipart/form-data">
                                    @endempty

                                    @isset($qrcodes)
                                        <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/qrcode/edit/{{$qrcodes->id}}" enctype="multipart/form-data">
                                            @endisset


                                            {{ csrf_field() }}


                                            @empty($qrcodes)

                                            <div class="form-group {{ $errors->has('campaign_name') ? ' has-error' : '' }}">
                                                    <label>Campaign Name</label>

                                                    <input id="campaign_name" type="text" class="form-control" name="campaign_name" value="" required autofocus>

                                                    @if ($errors->has('campaign_name'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('campaign_name') }}</strong>
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

                                                


                                    <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                                <label>Campaign Type</label>
                                                <select name="type" id="type" class="form-control" required autofocus>
                                                    <option value="">Select</option>
                                                    <option value="1" @isset($qrcodes->type)  @if($qrcodes->type==1){{ 'selected' }} @endif @endisset>Defualt</option>
                                                    <option value="2" @isset($qrcodes->type)  @if($qrcodes->type==2){{ 'selected' }} @endif @endisset>Fixed Rotation</option>
                                                </select>
                                                @if ($errors->has('type'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                 <div class="form-group {{ $errors->has('batch_size') ? ' has-error' : '' }}" id="batchdiv" style="display:none;">
                                                    <label>Batch Size</label>

                                                    <input id="batch_size" type="text" class="form-control" name="batch_size" value="" required autofocus>

                                                    @if ($errors->has('batch_size'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('batch_size') }}</strong>
                                    </span>
                                                    @endif
                                </div>

                                                

                                            @endempty



                                            @isset($qrcodes)
                                            <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                                <label>QrCode</label>

                                                <input id="code" type="text" class="form-control" name="code" value="{{ isset($qrcodes->code) ? $qrcodes->code : old('code') }}" required autofocus>

                                                @if ($errors->has('code'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                                @endif
                                            </div>



                                                <div class="form-group {{ $errors->has('scan') ? ' has-error' : '' }}">
                                                    <label>Scan</label>

                                                    <input id="scan" type="text" class="form-control" name="scan" value="{{ isset($qrcodes->scan) ? $qrcodes->scan : old('scan') }}" required autofocus>

                                                    @if ($errors->has('scan'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('scan') }}</strong>
                                    </span>
                                                    @endif
                                                </div>


                                            @endisset





                                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control" required autofocus>
                                                    <option value="">Select</option>
                                                    <option value="1" @isset($qrcodes->status)  @if($qrcodes->status==1){{ 'selected' }} @endif @endisset>Active</option>
                                                    <option value="0" @isset($qrcodes->status)  @if($qrcodes->status==0){{ 'selected' }} @endif @endisset>Inactive</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                            @empty($qrcodes)
                                                <button type="submit" class="btn btn-default">Add QrCode</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            @endempty

                                            @isset($qrcodes)
                                                <button type="submit" class="btn btn-default">Update QrCode</button>
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
    
     <script type="text/javascript">
        $("select[name='type']").change(function(){
            var type = $(this).val();
            var token = $("input[name='_token']").val();
           
           if(type==2){
               $("#batchdiv").show();
                $("#batch_size").attr('required','false');
               
           }
           else{
                $("#batchdiv").hide();
                $("#batch_size").removeAttr('required','true');
               
           }
        });
    </script>
    <!-- /.row -->
@endsection