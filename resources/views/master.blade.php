<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="<?= URL::to('/'); ?>/layout/assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Tahfidz Monitor</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Jquery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js" defer></script>

    @stack('scripts')

    <!-- Bootstrap core CSS     -->
    <link href="<?= URL::to('/'); ?>/layout/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?= URL::to('/'); ?>/layout/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?= URL::to('/'); ?>/layout/assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?= URL::to('/'); ?>/layout/assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?= URL::to('/'); ?>/layout/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    
    
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="azure" data-image="<?= URL::to('/'); ?>/layout/assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <!-- Sidebar Navbar Navigation  -->
    	
        @include('include.navbar')

    <!-- End Navbar Navigation -->

    </div>

    <div class="main-panel">
        
        @include('include.head')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">   
                                @yield('title')
                            </div>
                            <div class="content">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            
            @include('include.footer')

        </footer>

    </div>
</div>

@yield('modal')

</body>
    
    <!--   Core JS Files   -->
    <script src="<?= URL::to('/'); ?>/layout/assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="<?= URL::to('/'); ?>/layout/assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="<?= URL::to('/'); ?>/layout/assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?= URL::to('/'); ?>/layout/assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="<?= URL::to('/'); ?>/layout/assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="<?= URL::to('/'); ?>/layout/assets/js/demo.js"></script>

	<script type="text/javascript">
    	var base_url = {!! json_encode(url('/')) !!}
	</script>

</html>
