<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <title>Dashboard</title>

    <link rel="stylesheet" type="text/css" href="assets/plugins/morris/morris.css" />
    <link rel="stylesheet" type="text/css" href="assets/plugins/switchery/switchery.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>

    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
    <!-- Modernizr js -->
    <script src="assets/js/modernizr.min.js"></script>

</head>


<body>

<!-- Navigation Bar-->
<header id="topnav">
    <div class="topbar-main">
        <div class="container">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.html" class="logo">
                    <span>Logo</span>
                </a>
            </div>
            <!-- End Logo container-->


            <div class="menu-extras navbar-topbar">

                <ul class="list-inline float-right mb-0">

                    <li class="list-inline-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                    <li class="list-inline-item dropdown notification-list">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <img src="assets/images/users/avatar.jpg" alt="user" class="rounded-circle"> <h5 class="text-overflow"><small>IFA Staff</small> </h5>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="zmdi zmdi-power"></i> <span>Logout</span>
                            </a>

                        </div>
                    </li>

                </ul>

            </div> <!-- end menu-extras -->
            <div class="clearfix"></div>

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->


    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li class="active">
                        <a href="ifa-staff/index.html" title="Dashboard"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                    </li>
                </ul>
                <!-- End navigation menu  -->
            </div>
        </div>
    </div>
</header>
<!-- End Navigation Bar-->



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-box table-responsive">
                    <div class="header">
                        <h3>Policies</h3>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Policy</th>
                            <th>Plan Reference</th>
                            <th>Member Name</th>
                            <th>Investment House</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>12345678</td>
                            <td>The Calpe RBS No. 247</td>
                            <td>Withrod, Martin Terence</td>
                            <td>Old Mutual International</td>
                        </tr>
                        <tr>
                            <td>12345678</td>
                            <td>The Calpe RBS No. 247</td>
                            <td>Withrod, Martin Terence</td>
                            <td>Old Mutual International</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div> <!-- container -->


    <!-- Footer -->
    <footer class="footer">
        &copy; 2017. All Righs Reserved.
    </footer>
    <!-- End Footer -->


</div> <!-- End wrapper -->




<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script><!-- Tether for Bootstrap -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>

<!--Morris Chart-->
<script src="assets/plugins/morris/morris.min.js"></script>
<script src="assets/plugins/raphael/raphael-min.js"></script>

<!-- Counter Up  -->
<script src="assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>

<!-- Page specific js -->
<script src="assets/pages/jquery.dashboard.js"></script>
</body>
</html>
