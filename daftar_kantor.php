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
            <li class="active">Daftar Area</li>
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
                        <i class="fa fa-edit"></i><a href="form_tambah_kantor.php"></i> Tambah Area</a>
                        <div class="card-actions">
                        </div>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Area</th>
                                    <th>Telp Area</th>
                                    <th>Alamat</th>
                                    <?php if($_SESSION['role'] == 'super_admin'){ ?>
                                    <th>Aksi</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <?php
                            $i=1;
                            $sql_client = mysqli_query($conn, "SELECT * FROM area");
                            while($data = mysqli_fetch_array($sql_client)){
                                $idClient = $data['id_area'];
                                echo'
                                <tbody>
                                    <tr>
                                        <td>'.$i.'</td>
                                        <td>'.$data['nama_area'].'</td>
                                        <td>'.$data['telp_area'].'</td>
                                        <td>'.$data['alamat'].'</td>';
                                        if($_SESSION['role'] == 'super_admin'){
                                            echo'
                                            <td style="text-align:center">
                                                <a alt="edit" class="btn btn-info" href="form_edit_kantor.php?id_area='.$data['id_area'].'">
                                                    <i class="fa fa-edit "></i>
                                                </a>
                                                <a class="btn btn-danger" href="proses/proses_hapus_kantor.php?id_area='.$data['id_area'].'" onClick="return konfirmasi_hapus();">
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