<?php
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
    // The `$arrData` array holds the chart attributes and data

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/


?>
<!DOCTYPE html>
<html>
<head>
  <title>pie</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script type="text/javascript" src="assets/js/bundle.min.js"></script>
  <script type="text/javascript" src="assets/js/hulk-light.js"></script>
  <script type="text/javascript">
    FusionCharts.ready(function() {
      var pieChart = new FusionCharts({
        type: 'pie3d',
        renderAt: 'chart-container1',
        fontSize:'18',
        width: '100%',
        height: '400',
        dataFormat: 'json',
        dataSource:{
          "chart": {
            "caption": "Status Koneksi Jaringan Pertamina",
            "subCaption": "Monitoring Realtime Jaringan Pertamina RU-4 Cilacap",
            "showValues":"1",
            "numberSuffix": " IP Address",
            "formatnumber": "0",
            "formatnumberscale": "0",
            "theme": "hulk-light",
            "decimals": "1",
            "enableSmartLabels": "1",
            "enableMultiSlicing":"1",
            "startingAngle": "20",
            "useDataPlotColorForLabels": "1",
            "smartLineColor": "#d11b2d",
            "smartLineThickness": "2",
            "smartLineAlpha": "75",
            "isSmartLineSlanted": "0",
            "pieRadius": "200",
            "slicingDistance ": "50",
            "baseFont": "Verdana",
            "baseFontSize": "15",
            "baseFontColor": "#0068fc",
            "showLegend": "1",
            "animation":"0"

          },
          "data": [{
            "color": "#f72222",
            "label": "Request Time Out",
            "value": <?php echo json_encode($total2[0]); ?>
          }, {
            "color": "#eff2f",
            "label": "Reply",
            "value": <?php echo json_encode($total1[0]); ?>
          }, {
            "color": "#e29d1f",
            "label": "Destination Unreachable",
            "value": <?php echo json_encode($total3[0]); ?>
          }]
        }
      })
      pieChart.render();

    });
</script>
</head>
<body>

  <div id="chart-container1"></div>
</body>
</html>