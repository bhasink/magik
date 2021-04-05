@extends('backend/layouts.master')

@section('content')

    @include('backend/layouts.action')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">QrCode</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    QrCode Listing
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">

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

                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                            <th>Campaign Name</th>
                                <th>Campaign Id</th>
                                <th>Quantity</th>
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($qrcodes as $qrcode)
                                <tr class="odd gradeX">
                                <td>{{  $qrcode->campaign_name }}</td>
                                    <td>{{  $qrcode->campaign_id }}</td>
                                    <td>{{  $qrcode->quantity }}</td>
                                    <td class="center">{{  $qrcode->created_at }}</td>
                                    <td class="center">
                                     <a href="{{ env('APP_URL') }}/admin/generate-pdf/{{  $qrcode->campaign_id }}">Print QR Code</a>
                                    
                                                                          
                                                                                                               
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


@endsection