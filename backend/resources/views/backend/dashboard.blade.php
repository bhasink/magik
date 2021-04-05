@extends('backend/layouts.master')

@section('content')
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
	
	 <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$todaycount}}</div>
                            <div>Today's Scanned</div>
                        </div>
                    </div>
                </div>
                <a href="{{ env('APP_URL') }}/admin/dashboard/todaysscanned">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
       
       <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$campcount}}</div>
                            <div>Active Campaigns</div>
                        </div>
                    </div>
                </div>
                <a href="{{ env('APP_URL') }}/admin/qrcode-print">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        
    </div>
	<h3>Running Campaigns</h3>
    <div class="row">
	@php
	$colour=['primary','yellow','red','warning','green','primary','yellow','red','warning','green','primary','yellow','red','warning','green','primary','yellow','red','warning','green','red'];
	@endphp
	@foreach($camplist as $key=>$list)
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-{{$colour[$key]}}">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
							<div>{{$list->campaign_id}}</div>
                            <div >Total QR's - {{$list->quantity}}</div>
                            
                            <div>Total Scanned - {{$list->getCampaign($list->campaign_id)}}</div>
                        </div>
                    </div>
                </div>
                <a href="{{ env('APP_URL') }}/admin/dashboard/campaign/{{$list->campaign_id}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		@endforeach
        
       
    </div>
    <!-- /.row -->
   <!--<div class="row">

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Notifications Panel
                </div>
            
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i> New Comment
                            <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                            <span class="pull-right text-muted small"><em>11:13 AM</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-warning fa-fw"></i> Server Not Responding
                            <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                            <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-money fa-fw"></i> Payment Received
                            <span class="pull-right text-muted small"><em>Yesterday</em>
                                    </span>
                        </a>
                    </div>
                  

                </div>
               
            </div>
           

        </div>
        
    </div>-->
   

@endsection