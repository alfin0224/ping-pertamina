<?php

include '../koneksi_db/koneksi.php';
$smt_total	 	="SELECT COUNT(ip_address) FROM client";
$smt_by_status  ="SELECT COUNT(S.nama_status) FROM client C INNER JOIN status S ON (C.id_status = S.id_status) where C.id_status=";
$sqltotal 	= mysqli_query($conn, $smt_total);
$sql_1 		= mysqli_query($conn, $smt_by_status.intval('1'));
$sql_2 		= mysqli_query($conn, $smt_by_status.intval('2'));
$sql_3 		= mysqli_query($conn, $smt_by_status.intval('3'));


$label = array(
			'Reply'=>'#eff2f',
			'Request Time Out'=>'#f72222',
			'Destination Unreachable'=>'#e29d1f'
		);
$json = array();
$x = 1;
foreach ($label as $key => $value) {
	$num_rows = mysqli_fetch_row(${'sql_'.$x});
	$json[] = array(
		'color'=>$value,
		'label'=>$key,
		'value' => $num_rows[0]
	);
	$x++;
}

echo json_encode($json);

