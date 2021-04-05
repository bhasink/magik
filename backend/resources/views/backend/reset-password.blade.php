<!doctype html>
<html lang="en">
<head>
    <title>Welcome Ibees Admin Panel</title>


    <!-- Bootstrap Core CSS -->
    <link href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('backend/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

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




</head>

<body>


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form  method="POST" action="" role="form">
                        @if(count($errors)>0)
                            <div class="alert  alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{ csrf_field() }}


                        <fieldset>


                            <div class="form-group">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>


                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                @if ($errors->has('password-confirm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password-confirm') }}</strong>
                                    </span>
                                @endif

                            </div>



                            <button type="submit" class="btn btn-lg btn-success btn-block">
                                Update Password
                            </button>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- jQuery -->
<script src="{{asset('backend/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('backend/metisMenu/metisMenu.min.js')}}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{asset('backend/js/sb-admin-2.js')}}"></script>


</body>
</html>
