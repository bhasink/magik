@extends('backend/layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">State</h1>
            <p style="float:right">
                <a href="{{ env('APP_URL') }}/admin/state" class="btn btn-info" role="button">Back</a>
            </p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add /Edit State
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">


                            @empty($states)
                                <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/state/add/new" enctype="multipart/form-data">
                                    @endempty

                                    @isset($states)
                                        <form role="form" method="POST" action="{{ env('APP_URL') }}/admin/state/edit/{{$states->id}}" enctype="multipart/form-data">
                                            @endisset


                                            {{ csrf_field() }}


                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label>State Name</label>

                                                <input id="name" type="text" class="form-control" name="name" value="{{ isset($states->name) ? $states->name : old('name') }}" required autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control" required autofocus>
                                                    <option value="">Select</option>
                                                    <option value="1" @isset($states->status)  @if($states->status==1){{ 'selected' }} @endif @endisset>Active</option>
                                                    <option value="0" @isset($states->status)  @if($states->status==0){{ 'selected' }} @endif @endisset>Inactive</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                                @endif
                                            </div>

                                            @empty($states)
                                                <button type="submit" class="btn btn-default">Add State</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            @endempty

                                            @isset($states)
                                                <button type="submit" class="btn btn-default">Update State</button>
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
