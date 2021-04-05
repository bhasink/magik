<!doctype html>
<html lang="en">
<head>
    <title>Welcome Ibees Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('backend/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{asset('backend/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('backend/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('backend/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('backend/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- jQuery -->
    <script src="{{asset('backend/jquery/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('backend/metisMenu/metisMenu.min.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{asset('backend/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/datatables-responsive/dataTables.responsive.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('backend/js/sb-admin-2.js')}}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

</head>

<body>

<div id="wrapper">

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
 @include('backend/layouts.top-menu')
 @include('backend/layouts.side-menu')
</nav>

    <div id="page-wrapper">
       @yield('content')
    </div>


    <div class="clear"></div>
    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                <div class="footer-ad-left">© Copyright 2017 Interactive Bees </div>
                <div class="footer-ad-right">Web Design & Development : <a href="https://www.interactivebees.com/" target="_blank">Interactive Bees</a></div>

            </div>
        </div>
    </div>

</div>





</body>
</html>
