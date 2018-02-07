<?php
include '../koneksi_db/koneksi.php';

if (isset($_GET['id'])) {

	$stmt = mysqli_prepare($conn, "select * from client where id_area = ? ");
	mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
	$result = mysqli_stmt_execute($stmt);
	if ($result) {
		$show = $stmt->get_result();
		$json = array();
		while ($data = $show->fetch_assoc()) {
			//$json[] = $data;
			$idClient = $data['id_client'];
			$ip_client = $data['ip_address'];
			$id_status = $data['id_status'];

			$cmd = shell_exec("ping -n 1 $ip_client");
        	//nilai received
			$received_mentah = explode(",",$cmd);
			$received_mentah = ($received_mentah[1]);
			$received_matang = substr($received_mentah,12,1);

        	//nilai lost
			$lost_mentah = explode(",",$cmd);
			$lost_mentah = ($lost_mentah[2]);
			$lost_matang = substr($lost_mentah, 8, 1);

			$sql_lost_received = mysqli_query($conn, "UPDATE client SET lost=$lost_matang, received=$received_matang where id_client = ".$idClient."");


        //nilai minimal
			$min = explode(",",$cmd);
			$min = ($min[3]);
			$min_fix = substr($min,62,3);

        //nilai maksimal
			$max = explode(",",$cmd);
			$max = ($max[4]);
			$max_fix = substr($max,11,3);

        //nilai average
			$avg = explode(",",$cmd);
			$avg = ($avg[5]);
			$avg_fix = substr($avg,11,3);

			if (filter_var($avg_fix, FILTER_VALIDATE_INT)){

				$sql_kecepatan = mysqli_query($conn, "UPDATE client SET minimum=$min_fix, maksimum=$max_fix, average=$avg_fix where id_client = ".$idClient."");
			}else if(!filter_var($avg_fix, FILTER_VALIDATE_INT)){
				if (empty($avg_fix)) {
					$sql_kecepatan = mysqli_query($conn, "UPDATE client SET minimum=0, maksimum=0, average=0 where id_client = ".$idClient."");
					$min_fix = '-';
					$max_fix = '-';
					$avg_fix = '-';
				}
			} else {
				$min_fix = substr($min_fix,0,1);
				$max_fix = substr($max_fix,0,1);
				$avg_fix = substr($avg_fix,0,1);
				$sql_kecepatan = mysqli_query($conn, "UPDATE client SET minimum=$min_fix, maksimum=$max_fix, average=$avg_fix where id_client = ".$idClient."");

			}
			$json[] = array(
				'ip_client'=>$ip_client,
				'received_matang'=>$received_matang.' ms',
				'lost_matang'=>$lost_matang.' ms',
				'min_fix'=>$min_fix,
				'max_fix'=>$max_fix,
				'avg_fix'=>$avg_fix,
			);
		}
		echo json_encode($json);
	}
}