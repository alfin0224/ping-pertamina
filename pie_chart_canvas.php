<?php
include("proses/cek_login.php");
include "koneksi_db/koneksi.php";
$sqltotal = mysqli_query($conn, "SELECT COUNT(ip_address) FROM client");
$sqlreply = mysqli_query($conn, "SELECT COUNT(S.nama_status) FROM client C INNER JOIN status S ON (C.id_status = S.id_status) where C.id_status=1");
$sqlrto = mysqli_query($conn, "SELECT COUNT(S.nama_status) FROM client C INNER JOIN status S ON (C.id_status = S.id_status) where C.id_status=2");
$sqldu = mysqli_query($conn, "SELECT COUNT(S.nama_status) FROM client C INNER JOIN status S ON (C.id_status = S.id_status) where C.id_status=3");

$totalrow = mysqli_fetch_row($sqltotal);

$total1 = mysqli_fetch_row($sqlreply);
// $persen1 = $total1[0] / $totalrow[0] * 100;

$total2 = mysqli_fetch_row($sqlrto);
// $persen2 = $total2[0] / $totalrow[0] * 100;

$total3 = mysqli_fetch_row($sqldu);
// $persen3 = $total3[0] / $totalrow[0] * 100;
$dataPoints = array(
    array("label"=> "Destination Unreachable", "y"=> $total3[0], "legendText" => "Destination Unreachable", "satuan" => " IP Address", "color" => "#f37e19"),
    array("label"=> "Request Time Out", "y"=> $total2[0], "legendText" => "Request Time Out", "satuan" => " IP Address", "color" => "#e83333"),
    array("label"=> "Reply", "y"=> $total1[0], "legendText" => "Reply", "satuan" => " IP Address", "color" => "#2bca20")
    );

    ?>

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
                    indexLabelFontFamily: "Arial",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} {y}{satuan}",
                    startAngle: -10,
                    showInLegend: true,
                    toolTipContent: "{legendText} {y}",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            // chart.render();

             //For wait 5 seconds
            //  setTimeout(function() 
            //  {
            //     location.reload();  //Refresh page
            // }, 60000);
         }

     </script>
     <script src="assets/js/canvasjs.min.js"></script> 
     <div id="chartContainer" style="height: 370px; width: 100%;"></div>