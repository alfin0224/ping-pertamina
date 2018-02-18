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
                            <h6>Profile</h6>
                            <div class="card-actions">

                            </div>
                        </div>
                        <div class="card-block">
                            <div class="container">
                              <div class="row">
                                <div class="col-xs-7 col-sm-7 col-md-3 col-lg-12 col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 toppad" >
                                 <?php
                                 $sesion_aktif= $_SESSION['admin'];
                                 $sql_client = mysqli_query($conn, "SELECT * FROM user WHERE username='$sesion_aktif'");
                                 while($data = mysqli_fetch_array($sql_client)){
                                    ?>

                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                          <h4 class="panel-title"></h4>
                                      </div>
                                      <div class="panel-body">
                                          <div class="row">
                                            <div class="col-md-3 col-lg-3 " align="center"> <br><img alt="User Pic" src="<?php echo $url_image.$data['foto'];?>" width="200px" class="img-circle img-responsive" > </div>
                                            <?php } ?>
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
              </div>-->
              <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                      <?php
                      $sesion_aktif= $_SESSION['admin'];
                      $sql_client = mysqli_query($conn, "SELECT * FROM user WHERE username='$sesion_aktif'");
                      while($data = mysqli_fetch_array($sql_client)){
                        ?>
                        <tbody>
                          <tr>
                              <td>Full Name:</td>
                              <td><h5><?php echo $data['nama_lengkap']; ?></h5></td>
                          </tr>

                          <tr>
                            <td>Username:</td>
                            <td><?php echo $data['username']; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $data['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Role:</td>
                            <td><?php echo $data['role']; ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number:</td>
                            <td><?php echo $data['no_hp']; ?></td>
                        </tr><br>
                        <tr>
                            <td></td><td></td></tr>

                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <a href="form_edit_profile.php" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- /.conainer-fluid -->
</main>
<?php include('footer.php'); ?> 
</body>
</html>