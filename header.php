        <header class="navbar">
            <div class="container-fluid">
                <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
                <a class="navbar-brand" href="#"></a>
                <ul class="nav navbar-nav pull-right hidden-md-down">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php
                               $sesion_aktif= $_SESSION['admin'];
                               $sql_client = mysqli_query($conn, "SELECT * FROM user WHERE username='$sesion_aktif'");
                               while($data = mysqli_fetch_array($sql_client)){
                                ?>
                            <img src="<?php echo $url_image.$data['foto'];?>" class="img-avatar">
                            <?php } ?>
                            <span class="hidden-md-down"><?php echo $_SESSION['admin']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-header text-xs-center">
                                <strong>Settings</strong>
                            </div>
                            <a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i> Profile</a>
                            <div class="divider"></div>
                            <a class="dropdown-item" href="proses/proses_logout.php"><i class="fa fa-lock"></i> Logout</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link navbar-toggler aside-toggle">&#9776;</span>
                    </li>
                </ul>
            </div>
        </header>