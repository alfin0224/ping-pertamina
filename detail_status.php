<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "monitoring_pertamina";

    // membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

    // melakukan pengecekan koneksi
if ($koneksi->connect_error) {
	die("Connection failed: " . $koneksi->connect_error);
}

if($_POST['rowid']) {
	$id = $_POST['rowid'];
        // mengambil data berdasarkan id
	$sql = "SELECT lost, received FROM client WHERE id_client = $id";
	$result = $koneksi->query($sql);
	foreach ($result as $baris) { ?>
	<table class="table">
		<tr>
			<td>Received</td>
			<td>:</td>
			<td><?php echo $baris['received']; ?> &nbsp ms</td>
		</tr>
		<tr>
			<td>Lost</td>
			<td>:</td>
			<td><?php echo $baris['lost']; ?> &nbsp ms</td>
		</tr>
	</table>
	<?php 

}
}
?>