	<div class="sidebar">
		<div class="sidebar-header">
			<?php
			$sesion_aktif= $_SESSION['admin'];
			$sql_client = mysqli_query($conn, "SELECT * FROM user WHERE username='$sesion_aktif'");
			while($data = mysqli_fetch_array($sql_client)){
				?>
				<img src="<?php echo $url_image.$data['foto'];?>" class="img-avatar" alt="Avatar">
				<div>
					<?php } ?>
					<strong><?php echo $_SESSION['admin']; ?></strong>
				</div>
				<div class="text-muted">
					<small><?php if($_SESSION['role'] == 'super_admin'){
                                echo "Super Admin";
                                }else{
                                    echo "Admin";
                                    }  ?></small>
				</div>
			</div>
			<nav class="sidebar-nav">
				<ul class="nav">
					<li class="nav-title">
						Dashboard
					</li>
					<li class="nav-item">
						<a class="nav-link" href="net_monitoring.php"><i class="icon-speedometer"></i> Net Monitoring </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="daftar_kantor.php"><i class="icon-speedometer"></i> Daftar Area </a>
					</li>
					<?php if($_SESSION['role'] == 'super_admin'){ ?>
					<li class="nav-item">
						<a class="nav-link" href="user.php"><i class="icon-speedometer"></i> User Admin </a>
					</li>
					<?php } ?>
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