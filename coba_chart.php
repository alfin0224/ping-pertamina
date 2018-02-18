<!DOCTYPE html>
<html>
<head>
	<title>cobacoba</title>
	<script type="text/javascript" src="assets/js/jquery-1.12.4.js"></script>
	<script>
		$(document).ready(function(){
        setInterval(function(){
        	$("#konten-pie").load("pie_chart.php");
        },5000);

        $("#konten-pie").load("pie_chart.php");
			var updateChart = function() {

				$.getJSON("pie_chart.php", function (result) {

					chart.options.data[0].dataPoints = result;
					chart.render(); 

				});   
			}            
			setInterval(function(){updateChart()},4000);
		});
	</script>
</head>
<body>
	<div id="konten-pie">
		<?php //include "pie_chart.php"; ?>
	</div>
</body>
</html>