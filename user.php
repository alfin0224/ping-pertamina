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
            <li><a href="net_monitoring.php">Monitoring Jaringan</a></li>
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
                        <i class="fa fa-edit"></i><a href="form_tambah_user.php"></i> Tambah User</a>
                        <div class="card-actions">
                    </div>
                </div>
                <div class="card-block">
                    <table class="table table-striped table-bordered datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Password (Enkripsi)</th>
                                <?php if($_SESSION['role'] == 'super_admin'){ ?>
                                <th>Aksi</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <?php
                        $i=1;
                        $sql_client = mysqli_query($conn, "SELECT * FROM user");
                        while($data = mysqli_fetch_array($sql_client)){
                            $idUser = $data['id_user'];
                            echo'
                            <tbody>
                                <tr>
                                    <td>'.$i.'</td>
                                    <td>'.$data['username'].'</td>
                                    <td>'.$data['email'].'</td>
                                    <td>'.$data['role'].'</td>
                                    <td>'.$data['password'].'</td>';
                                    if($_SESSION['role'] == 'super_admin'){
                                        echo'
                                        <td style="text-align:center">
                                            <a alt="reset_password" class="btn btn-success" href="proses/proses_reset_password.php?id_user='.$data['id_user'].'" onClick="return konfirmasi_reset_password();">
                                                <i class="glyphicon glyphicon-envelope">Reset Password</i>
                                            </a>
                                            <a class="btn btn-danger" href="proses/proses_hapus_user.php?id_user='.$data['id_user'].'" onClick="return konfirmasi_hapus();">
                                                <i class="fa fa-trash-o "></i>
                                            </a> </td>';
                                        }
                                        $i++;
                                    }
                                    echo'
                                </tr>
                            </tbody>'; 

                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.conainer-fluid -->
    </main>
    <?php include('footer.php'); ?> 
</body>
</html>