<?php
include "koneksi_db/koneksi.php";
include("proses/cek_login.php");
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
            <li><a href="net_monitoring.php?page=1">Monitoring Jaringan</a></li>
            <li><a href="daftar_kantor.php">Daftar Area</a></li>
            <?php if($_SESSION['role'] == 'super_admin'){ ?>
            <li class="active">User Admin</li>
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

                        <i class="fa fa-edit"></i> Tambah User Admin / <a href="user.php"><small class="text-muted"> Back </a></small>
                        <div class="card-actions">
                        </div>
                    </div>
                    <div class="card-block">
                        <form class="form_inline" method="post" action="proses/proses_tambah_user.php" style="text-align:left;">
                            <div class="form-group">
                                <label>Fullname</label><br>
                                <input class="form-control" type="text" name="fullname" required="required">
                                <br>
                                <label>Username</label><br>
                                <input class="form-control" type="text" name="username" required="required">
                                <br>
                                <label>Email</label><br>
                                <input class="form-control" type="text" name="email" required="required">
                                <br>
                                <label>Role</label><br>
                                <select class="form-control flat" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                </select><br>
                                <label>Phone Number</label><br>
                                <input class="form-control" type="text" name="no_hp" required="required">
                                <br>
                                <label>Password</label><br>
                                <input class="form-control" type="password" name="password" required="required"><br>
                                <label>Confirm Password</label><br>
                                <input class="form-control" type="password" name="confirm_password" required="required">
                                <br>
                                <button class="btn btn-info" type="submit" name="simpan" class="button" onclick="return konfirmasi_kirim();"> Simpan </button>
                                <button type="reset" class="btn btn-danger" onclick="return konfirmasi_reset();">Reset</button>

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