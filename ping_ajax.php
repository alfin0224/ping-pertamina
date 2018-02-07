<?php
	include 'koneksi_db/koneksi.php';
	$sql = mysqli_query($conn,'select * from area');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sample ajax</title>
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="assets/js/jquery-1.12.4.js"></script>
</head>
<body>
	<?php
		if (isset($sql)) {
			
			while ($data = mysqli_fetch_array($sql)) {
				echo '<span class="id_area">'.$data['id_area'].'</span>';
			}
			
		}
	?>
	<div class="output">
		
	</div>
	<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
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

		},10000); //10 detik
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