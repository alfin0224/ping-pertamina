<?php
include "koneksi_db/koneksi.php";
$sqltotal = mysqli_query($conn, "SELECT COUNT(*) FROM client");
 $sqlreply = mysqli_query($conn, "SELECT COUNT(S.nama_status) FROM client C INNER JOIN status S ON (C.id_status = S.id_status) where C.id_status=1");
 $sqlrto = mysqli_query($conn, "SELECT COUNT(S.nama_status) FROM client C INNER JOIN status S ON (C.id_status = S.id_status) where C.id_status=2");
 $sqldu = mysqli_query($conn, "SELECT COUNT(S.nama_status) FROM client C INNER JOIN status S ON (C.id_status = S.id_status) where C.id_status=3");

 $totalrow = mysqli_fetch_row($sqltotal);
$total1 = mysqli_fetch_row($sqlreply);
$persen1 = $total1[0] / $totalrow[0] * 100;

$total2 = mysqli_fetch_row($sqlrto);
$persen2 = $total2[0] / $totalrow[0] * 100;

$total3 = mysqli_fetch_row($sqldu);
$persen3 = $total3[0] / $totalrow[0] * 100;

echo "nilai = ". $totalrow[0];
echo "<br>nilai1 = ". $total1[0];
echo "<br>nilai2 = ". $total2[0];
echo "<br>nilai3 = ". $total3[0];
$dataPoints = array(
    array("label"=> "Destination Unreachable", "y"=> $persen3),
    array("label"=> "Request Time Out", "y"=> $persen2),
    array("label"=> "Reply", "y"=> $persen1)
);
    
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    title:{
        text: "Status Koneksi Jaringan Pertamina"
    },
    subtitles: [{
        text: "Monitoring Realtime Jaringan Pertamina RU-4 Cilacap"
    }],
    data: [{
        type: "pie",
        showInLegend: "true",
        legendText: "{label}",
        indexLabelFontSize: 16,
        indexLabel: "{label} - #percent%",
        yValueFormatString: "฿#,##0",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="assets/js/canvasjs.min.js"></script>
</body>
</html>   