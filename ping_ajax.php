<?php
	include 'koneksi_db/koneksi.php';
	$sql = mysqli_query($conn,'select * from area');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sample ajax</title>
	<link href="assets/css/style.css" rel="stylesheet">
	<script type="text/javascript" src="assets/js/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="assets/js/pertamina.js"></script>
	<script src="assets/js/ajax.js"></script>
</head>
<body>
	<?php
		if (isset($sql)) {
			
			while ($data = mysqli_fetch_array($sql)) {
				echo '<span class="id_area hidden-xs-up">'.$data['id_area'].'</span>';
			}
			
		}
	?>
	<div class="output">
		
	</div>
	<script type="text/javascript">
	$(document).ready(function () {
		$('.id_area').each(function(i, obj) {
    		var id_area = $(obj).text();
    		ping_via_ajax(id_area);	
		});
		setInterval(function(){	
			
			$('.id_area').each(function(i, obj) {
    			var id_area = $(obj).text();
    			ping_via_ajax(id_area);	
			});

		},900000); //15 Menit atau 900 detik
	});
	function ping_via_ajax(id){
		$.ajax({
            url: 'http://localhost/ping-pertamina/proses/json.php?id='+id,
            type:"POST",
            dataType:"json",
            success: function(data){
            	console.log(data);
            }
        });
	}
	</script>
</body>
</html>