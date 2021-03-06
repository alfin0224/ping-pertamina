<?php
include("proses/cek_login.php");
include "koneksi_db/koneksi.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
		<title> Dashboard Monitoring</title>

		<!-- Main styles for this application -->
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="assets/js/pertamina.js"></script>
		<script type="text/javascript" src="assets/js/libs/jquery.min.js"></script>
		<script src="assets/js/ajax.js"></script>
		<script>
			$(document).ready(function(){
        // var page = <?php echo $_GET['page']; ?>

        setInterval(function(){
        	$("#konten").load("tampil_net.php");
        },60000);
        $("#konten").load("tampil_net.php");
    });
		</script>
		<script>
			window.onload = function () {

				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					exportEnabled: true,
					title:{
						text: "Status Koneksi Jaringan Pertamina"
					},
					subtitles: [{
						text: "Monitoring Realtime Jaringan Pertamina RU-4 Cilacap"
					}],
					data: [{
						type: "pie",
						indexLabelFontFamily: "Arial",
						indexLabelFontSize: 18,
						indexLabel: "{label} {y}%",
						startAngle: 40,
						showInLegend: true,
						toolTipContent: "{legendText} {y}%",
						dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
					}]
				});
				chart.render();

			}
		</script>
	</head>
    <!-- BODY options, add following classes to body to change options
		1. 'compact-nav'     	  - Switch sidebar to minified version (width 50px)
		2. 'sidebar-nav'		  - Navigation on the left
			2.1. 'sidebar-off-canvas'	- Off-Canvas
				2.1.1 'sidebar-off-canvas-push'	- Off-Canvas which move content
				2.1.2 'sidebar-off-canvas-with-shadow'	- Add shadow to body elements
		3. 'fixed-nav'			  - Fixed navigation
		4. 'navbar-fixed'		  - Fixed navbar
	-->
	<body class="navbar-fixed sidebar-nav fixed-nav">
		<?php
		include "header.php";
		?>
		<div class="sidebar">
			<div class="sidebar-header">
				<img src="assets/img/avatars/profil-default.png" class="img-avatar" alt="Avatar">
				<div>
					<strong><?php echo $_SESSION['admin']; ?></strong>
				</div>
				<div class="text-muted">
					<small>Admin</small>
				</div>
			</div>
			<nav class="sidebar-nav">
				<ul class="nav">
					<li class="nav-title">
						Dashboard
					</li>
					<li class="nav-item">
						<a class="nav-link" href="net_monitoring.php"><i class="icon-speedometer"></i> Net Monitoring</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="icon-speedometer"></i> Finance </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="icon-speedometer"></i> App Service</a>
					</li>
					<li class="divider"></li>
				</ul>
			</nav>
			<div class="sidebar-footer">
				<ul class="terms" style="margin-top:25%;">
					<li><a href="#">Terms</a></li>
					<li><a href="#">Privacy</a></li>
					<li><a href="#">Help</a></li>
					<li><a href="#">About</a></li>
				</ul>
			</div>
		</div>
		<!-- Main content -->
		<main class="main">
			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col-md-7">
						<h1 class="h2 page-title">Monitoring Jaringan</h1>
						<div class="text-muted page-desc">Monitoring Seluruh Jaringan Kantor Pertamina</div>
					</div>
					<div class="col-md-3" style="margin-left:16%;">
						<img src="assets/img/logo_pertamina.png" style="height:50px; ">
					</div>
				</div>
			</div>
			<!-- Breadcrumb -->
			<ol class="breadcrumb">
				<li class="active">Monitoring Jaringan</li>
				<li><a href="daftar_kantor.php">Daftar Area</a></li>
				<!-- Breadcrumb Menu-->
				<li class="breadcrumb-menu">
					<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
						<a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
						<a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="icon-settings"></i> &nbsp;Settings
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="dropdown-header text-xs-center">
									<strong>Account</strong>
								</div>
								<a class="dropdown-item" href="#"><i class="fa fa-tasks"></i> Tasks<span class="label label-danger">13</span></a>
								<a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Comments<span class="label label-warning">234</span></a>
								<div class="dropdown-header text-xs-center">
									<strong>Settings</strong>
								</div>
								<a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
								<a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="label label-default">75</span></a>
								<a class="dropdown-item" href="#"><i class="fa fa-file"></i> Projects<span class="label label-primary">2</span></a>
							</div>
						</div>
					</div>
				</li>
			</ol>
			<div class="container-fluid">
				<div class="animated fadeIn">
					<div class="card">
						<div class="card-header">
							<i class="fa fa-edit"><a href="form_tambah_client.php"></i> Tambah Data Client</a>

						</div>

						<div class="card-actions">
							<br>
							<div id="chartContainer" style="height: 370px; width: 100%;"></div>
							<script src="assets/js/canvasjs.min.js"></script>
							<br>
							<div class="card-block" id="konten">
								
							</div>
						</div>

						<script type="text/javascript">
        //                 $(document).ready(function(){
        //                     $('#kecepatan').on('show.bs.modal', function (e) {
        //                         var rowid = $(e.relatedTarget).data('id');
        //     //menggunakan fungsi ajax untuk pengambilan data
        //     $.ajax({
        //         type : 'post',
        //         url : 'detail_kecepatan.php',
        //         data :  'rowid='+ rowid,
        //         success : function(data){
        //         $('.fetched-data').html(data);//menampilkan data ke dalam modal
        //     }
        // });
        // });
        //                 });
</script>

<!-- /.container-fluid -->
</main>
<aside class="aside-menu">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab"><i class="icon-list"></i></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="icon-speech"></i></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#settings" role="tab"><i class="icon-settings"></i></a>
		</li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="timeline" role="tabpanel">
			<div class="callout m-a-0 p-y-h text-muted text-xs-center bg-faded text-uppercase">
				<small><b>Today</b></small>
			</div>
			<hr class="transparent m-x-1 m-y-0">
			<div class="callout callout-warning m-a-0 p-y-1">
				<div class="avatar pull-xs-right">
					<img src="assets/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
				</div>
				<div>Meeting with
					<strong>Lucas</strong>
				</div>
				<small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
				<small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA </small>
			</div>
			<hr class="m-x-1 m-y-0">
			<div class="callout callout-info m-a-0 p-y-1">
				<div class="avatar pull-xs-right">
					<img src="assets/img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
				</div>
				<div>Skype with
					<strong>Megan</strong>
				</div>
				<small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 4 - 5pm</small>
				<small class="text-muted"><i class="icon-social-skype"></i>&nbsp; On-line </small>
			</div>
			<hr class="transparent m-x-1 m-y-0">
			<div class="callout m-a-0 p-y-h text-muted text-xs-center bg-faded text-uppercase">
				<small><b>Tomorrow</b></small>
			</div>
			<hr class="transparent m-x-1 m-y-0">
			<div class="callout callout-danger m-a-0 p-y-1">
				<div>New UI Project -
					<strong>deadline</strong>
				</div>
				<small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 10 - 11pm</small>
				<small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ </small>
				<div class="avatars-stack m-t-h">
					<div class="avatar avatar-xs">
						<img src="assets/img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
					</div>
					<div class="avatar avatar-xs">
						<img src="assets/img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
					</div>
					<div class="avatar avatar-xs">
						<img src="assets/img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
					</div>
					<div class="avatar avatar-xs">
						<img src="assets/img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
					</div>
					<div class="avatar avatar-xs">
						<img src="assets/img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
					</div>
				</div>
			</div>
			<hr class="m-x-1 m-y-0">
			<div class="callout callout-success m-a-0 p-y-1">
				<div>
					<strong>#10 Startups.Garden</strong> Meetup</div>
					<small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 1 - 3pm</small>
					<small class="text-muted"><i class="icon-location-pin"></i>&nbsp; Palo Alto, CA </small>
				</div>
				<hr class="m-x-1 m-y-0">
				<div class="callout callout-primary m-a-0 p-y-1">
					<div>
						<strong>Team meeting</strong>
					</div>
					<small class="text-muted m-r-1"><i class="icon-calendar"></i>&nbsp; 4 - 6pm</small>
					<small class="text-muted"><i class="icon-home"></i>&nbsp; creativeLabs HQ </small>
					<div class="avatars-stack m-t-h">
						<div class="avatar avatar-xs">
							<img src="assets/img/avatars/2.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
						</div>
						<div class="avatar avatar-xs">
							<img src="assets/img/avatars/3.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
						</div>
						<div class="avatar avatar-xs">
							<img src="assets/img/avatars/4.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
						</div>
						<div class="avatar avatar-xs">
							<img src="assets/img/avatars/5.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
						</div>
						<div class="avatar avatar-xs">
							<img src="assets/img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
						</div>
						<div class="avatar avatar-xs">
							<img src="assets/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
						</div>
						<div class="avatar avatar-xs">
							<img src="assets/img/avatars/8.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
						</div>
					</div>
				</div>
				<hr class="m-x-1 m-y-0">
			</div>
			<div class="tab-pane p-a-1" id="messages" role="tabpanel">
				<div class="message">
					<div class="p-y-1 p-b-3 m-r-1 pull-left">
						<div class="avatar">
							<img src="assets/img/avatars/7.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
							<span class="avatar-status label-success"></span>
						</div>
					</div>
					<div>
						<small class="text-muted">Lukasz Holeczek</small>
						<small class="text-muted pull-right m-t-q">1:52 PM</small>
					</div>
					<div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
					<small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
				</div>

			</div>
			<div class="aside-options">
				<div class="clearfix m-t-1">
					<small><b>Option 3</b></small>
					<label class="switch switch-text switch-pill switch-success switch-sm pull-right">
						<input type="checkbox" class="switch-input">
						<span class="switch-label" data-on="On" data-off="Off"></span>
						<span class="switch-handle"></span>
					</label>
				</div>
			</div>
			<div class="aside-options">
				<div class="clearfix m-t-1">
					<small><b>Option 4</b></small>
					<label class="switch switch-text switch-pill switch-success switch-sm pull-right">
						<input type="checkbox" class="switch-input" checked>
						<span class="switch-label" data-on="On" data-off="Off"></span>
						<span class="switch-handle"></span>
					</label>
				</div>
			</div>
			<hr>
			<h6>System Utilization</h6>
			<div class="text-uppercase m-b-q m-t-2">
				<small><b>CPU Usage</b></small>
			</div>
			<progress class="progress progress-xs progress-info m-a-0" value="25" max="100">25%</progress>
			<small class="text-muted">348 Processes. 1/4 Cores.</small>
			<div class="text-uppercase m-b-q m-t-h">
				<small><b>Memory Usage</b></small>
			</div>
			<progress class="progress progress-xs progress-warning m-a-0" value="70" max="100">70%</progress>
			<small class="text-muted">11444GB/16384MB</small>
			<div class="text-uppercase m-b-q m-t-h">
				<small><b>SSD 1 Usage</b></small>
			</div>
			<progress class="progress progress-xs progress-danger m-a-0" value="95" max="100">95%</progress>
			<small class="text-muted">243GB/256GB</small>
			<div class="text-uppercase m-b-q m-t-h">
				<small><b>SSD 2 Usage</b></small>
			</div>
			<progress class="progress progress-xs progress-success m-a-0" value="10" max="100">10%</progress>
			<small class="text-muted">25GB/256GB</small>
		</div>
	</div>
</aside>
<footer class="footer">
	<span class="text-left">
		<a href="http://instagram.com/alfin0224">Muhamad Alfienda Rachman</a> &copy; 2018 Pertamina.
	</span>
	<span class="pull-right">
		Powered by <a href="http://instagram.com/alfin0224">Teknik Informatika-UII</a>
	</span>
</footer>

<!-- Bootstrap and necessary plugins -->

<script src="assets/js/libs/tether.min.js"></script>
<script src="assets/js/libs/bootstrap.min.js"></script>
<script src="assets/js/libs/pace.min.js"></script>
<!-- Plugins and scripts required by all views -->
<script src="assets/js/libs/Chart.min.js"></script>
<script src="assets/js/views/shared.js"></script>
<!-- GenesisUI main scripts -->
<script src="assets/js/app.js"></script>
<!-- Plugins and scripts required by this views -->
<script src="assets/js/libs/jquery.dataTables.min.js"></script>
<script src="assets/js/libs/dataTables.bootstrap.min.js"></script>
<!-- Custom scripts required by this view -->
<script src="assets/js/views/tables.js"></script>


</body>
</html>