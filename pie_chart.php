<!DOCTYPE html>
<html>
<head>
  <title>pie</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script type="text/javascript" src="assets/js/bundle.min.js"></script>
  <script type="text/javascript" src="assets/js/hulk-light.js"></script>
  <script type="text/javascript" src="assets/js/jquery-1.12.4.min.js"></script>
</head>
<body>

  <div id="chart-container1"></div>
  <script type="text/javascript">
    function setPieChart() {
        // your code

        $.ajax({
            url: 'http://localhost/ping-pertamina/proses/json_pie.php'
            ,type:"POST"
            ,dataType:"json"
            ,success: function(data){
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
          "data": data
        }
      })
      pieChart.render();
    });
            }
        });
        
        

        //pieChart.setJSONData(pieData);
        
        return setPieChart;
    }
    $(document).ready(function () {
          //setJSONData 
          console.log(setInterval(setPieChart(), 10000));
          //console.log(data);
/*
        setInterval(function(){ 
          $.ajax({
            url: 'http://localhost/ping-pertamina/proses/json_pie.php',
              type:"POST",
              dataType:"json",
              success: function(data){

              }
            });
        },10000);*/
        //

    });
  </script>
</body>
</html>