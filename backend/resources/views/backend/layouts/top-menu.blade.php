<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">IBees Admin</a>
</div>
<!-- /.navbar-header -->
<form action="{{ env('APP_URL') }}/admin/logout" method="post" id="logout-frm" name="logout-frm">
    {{ csrf_field() }}

</form>
<ul class="nav navbar-top-links navbar-right">

    <li>
        @if (Sentinel::check())

            Hello, {{Sentinel::getUser()->first_name}}  {{Sentinel::getUser()->last_name}}
        @else
            Hello, Guest

        @endif

    </li>

    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li class="divider"></li>
            <li><a href="#" onClick="document.getElementById('logout-frm').submit();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->