<?php
include "koneksi_db/koneksi.php";
include("proses/cek_login.php");
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> Dashboard Monitoring</title>
	<!-- Main styles for this application -->
	<link href="assets/css/style.css" rel="stylesheet">
	<script type="text/javascript" src="assets/js/libs/jquery.min.js"></script>
	<script src="assets/js/libs/tether.min.js"></script>
	<script src="assets/js/libs/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/pertamina.js"></script>
	<script src="assets/js/ajax.js"></script>
	<script>
		$(document).ready(function(){
        // var page = <?php echo $_GET['page']; ?>

        $("#detail").click(function(){
        	setInterval(function(){
        		$("#konten").load("tampil_net.php");
        	},120000);
        	$("#konten").slideDown("slow", function() {
    				// Animation complete.
    				
    			});
        	$("#konten").load("tampil_net.php");


        });
         //      setInterval(function(){
        	// 	$("#konten-pie").load("pie_chart.php");
        	// },60000);

		$("#konten-pie").load("pie_chart.php");
			// var updateChart = function() {

			// 	$.getJSON("pie_chart.php", function (result) {

			// 		pieChart.option.data[0].value = result;
			// 		console.log(result);
			// 		pieChart.render(); 

			// 	});   
			// }            
			// setInterval(function(){updateChart()},4000);
			$("#load_ping").load("ping_ajax.php");

		});
	</script>
</head>
<body class="navbar-fixed sidebar-nav fixed-nav">
	<?php include "header.php"; ?>
	<?php include "sidebar.php"; ?>
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
			<?php if($_SESSION['role'] == 'super_admin'){ ?>
			<li> <a href="user.php">User Admin</a></li>
			<?php } ?>
			<!-- Breadcrumb Menu-->
			<li class="breadcrumb-menu">
				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<span class="btn btn-secondary"><i class="icon-graph"></i> &nbsp;Dashboard</span>
					<div class="btn-group" role="group">
						<div class="dropdown-menu dropdown-menu-right">
							<div class="dropdown-header text-xs-center">
							</div>
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

						<div id="konten-pie">
							<?php //include "pie_chart.php"; ?>
						</div>
						<br>
						<div class="card-block" style="text-align:center;"><button type="button" class="btn btn-success-outline" id="detail"><i class="fa fa-magic"></i>Detail</button></div>
						<div class="card-block" id="konten">
						</div>
					</div>
					<div id="load_ping"></div>
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
</main>
<?php include('footer.php'); ?>
</body>
</html>