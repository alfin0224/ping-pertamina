<?php
include "koneksi_db/koneksi.php";
include("proses/cek_login.php");
$session_aktif = $_SESSION['admin'];
$sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$session_aktif'");
$user = mysqli_fetch_array($sql);
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
            <li><a href="user.php">Monitoring Jaringan</a></li>
            <li><a href="daftar_kantor.php">Daftar Area</a></li>
            <?php if($_SESSION['role'] == 'super_admin'){ ?>
            <li><a href="user.php">User Admin</a></li>
            <?php } ?>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <span class="btn btn-secondary"><i class="icon-graph"></i> &nbsp;Dashboard</span>
                </div>
            </li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-edit"></i> Edit Profile / <a href="profile.php"><small class="text-muted"> Back </a></small>
                        <div class="card-actions">
                        </div>
                    </div>
                    <div class="card-block">
                        <form class="form_inline" method="post" action="proses/proses_edit_profile.php" enctype="multipart/form-data" style="text-align:left;">
                            <div class="form-group">                                
                                <input type="hidden" value="<?php echo $session_aktif ?>" name="session_aktif"></input>
                                <label>Full Name</label><br>
                                <input class="form-control" type="text" name="nama_lengkap" value="<?php echo $user['nama_lengkap']; ?>"><br>
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" value="<?php echo $user['email']; ?>"><br>
                                <label>Phone Number</label>
                                <input class="form-control" type="text" name="no_hp" value="<?php echo $user['no_hp']; ?>"><br>
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" value="<?php echo $user['no_hp']; ?>"><br>
                                <label style="padding-right:52px">Profile Image</label><br>
                                <input type="file" name="profile_image" size="80" required /><br><br>
                                <input type="hidden" name="MAX_FILE_SIZE" value="8000000" /> <!-- dalam byte {8000000b = 8Mb} -->
                                <br>
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