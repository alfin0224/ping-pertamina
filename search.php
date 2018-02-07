<?php
	include("proses/cek_login.php");
$keyword = $_POST['keyword']; // Ambil data keyword yang dikirim dengan AJAX
// Load view.php
ob_start();
?>

    <script>
     $(document).ready(function(){
        var page = <?php echo $_GET['page']; ?>
        // $.get("tabel_index.php?page="+ page, function(data){
            $("#konten").load("tabel_index.php?page=" + page);
            setInterval(function(){
                $("#konten").load("tabel_index.php?page=" + page);
            },60000); 
        });
    // });


</script>
<?php
// include "tabel_index.php?page=$page1";
$html = ob_get_contents(); // Masukan isi dari view.php ke dalam variabel $html
ob_end_clean();
// Buat array dengan index hasil dan value nya $html
// Lalu konversi menjadi JSON
echo json_encode(array('hasil'=>$html));
?>