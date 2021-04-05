<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li><a href="{{ env('APP_URL') }}/admin/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>



            @if (Sentinel::getUser()->hasAccess(['User.ListView']) || Sentinel::getUser()->hasAccess(['Role.ListView']))
            <li><a href="#"><i class="fa fa-users fa-fw"></i> Administartor<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">

                    @if (Sentinel::getUser()->hasAccess(['User.ListView']))
                    <li><a href="{{ env('APP_URL') }}/admin/user"><i class="fa fa-list fa-fw"></i> User Listing</a></li>
                    @endif

                    @if (Sentinel::getUser()->hasAccess(['Role.ListView']))
                    <li><a href="{{ env('APP_URL') }}/admin/role"><i class="fa fa-list fa-fw"></i> Role Listing</a></li>
                    @endif

                </ul>
            </li>
            @endif



            @if (Sentinel::getUser()->hasAccess(['Gift.ListView']))
                <li>
                    <a href="#"><i class="fa fa-gift fa-fw"></i> <span>Gift Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ env('APP_URL') }}/admin/gift"><i class="fa fa-list fa-fw"></i> Gift Listing</a></li>
                       
                        <li><a href="{{ env('APP_URL') }}/admin/gstate"><i class="fa fa-list fa-fw"></i> Gift By State </a></li>
                        <li><a href="{{ env('APP_URL') }}/admin/giftsequence"><i class="fa fa-list fa-fw"></i> Gift Sequence </a>
						</li>
                    </ul>
                </li>
            @endif


            @if (Sentinel::getUser()->hasAccess(['QrCode.ListView']))
                <li>
                    <a href="#"><i class="fa fa-briefcase fa-fw"></i> <span>QR Code Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ env('APP_URL') }}/admin/qrcode"><i class="fa fa-list fa-fw"></i> QR Code Listing</a></li>
                        <li><a href="{{ env('APP_URL') }}/admin/qrcode-print"><i class="fa fa-list fa-fw"></i> QR Code Print</a></li>
                    </ul>
                </li>
            @endif


            @if (Sentinel::getUser()->hasAccess(['Contact.ListView']))
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i> <span>Contact Management</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ env('APP_URL') }}/admin/contact"><i class="fa fa-list fa-fw"></i> Contact Listing</a></li>
                    </ul>
                </li>
            @endif

        </ul>
    </div>

</div>