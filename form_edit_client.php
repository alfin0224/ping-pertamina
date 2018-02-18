<?php
include "koneksi_db/koneksi.php";
include("proses/cek_login.php");
$id = $_GET['id_client'];
$sql = mysqli_query($conn, "SELECT C.id_client, C.ip_address, C.id_area, C.subnet_mask, C.vlan, K.nama_area FROM client C INNER JOIN area K ON (C.id_area = K.id_area) WHERE id_client = $id LIMIT 1");
$client = mysqli_fetch_array($sql);
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
                        <i class="fa fa-edit"></i> Tambah Data Client / <a href="index.php"><small class="text-muted"> Back </a></small>
                        <div class="card-actions">
                        </div>
                    </div>
                    <div class="card-block">
                        <form class="form_inline" method="post" action="proses/proses_edit_client.php" style="text-align:left;">
                            <div class="form-group">                                
                                <input type="hidden" value="<?php echo $id ?>" name="id_client"></input>
                                <label>IP Address</label><br>
                                <input class="form-control" type="text" name="ip_address" value="<?php echo $client['ip_address'] ;?>">
                                <br>
                                <label>Nama Area</label><br>
                                <select class="form-control flat" name="id_area">
                                    <option value="<?php echo $client['id_area'];?>"><?php echo $client['nama_area'];?></option>
                                    <option>-------------------</option>
                                    <option value="1">HODN</option>
                                    <option value="2">HO Lama</option>
                                    <option value="3">Maintenance Office</option>
                                    <option value="4">Teljar</option>
                                    <option value="5">FOC 2</option>
                                </select><br>
                                <label>Subnet Mask</label>
                                <input class="form-control" type="text" name="subnet_mask" value="<?php echo $client['subnet_mask']; ?>"><br>
                                <label>Vlan</label>
                                <input class="form-control" type="text" name="vlan" value="<?php echo $client['vlan']; ?>"><br>
                                <button class="btn btn-info" type="submit" name="simpan" class="button" onclick="return konfirmasi_ubah();"> Simpan </button>              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.conainer-fluid -->
    </main>
    <?php include('footer.php'); ?>       
</body>
</html>