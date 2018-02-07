<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// do{

//   $url=$_SERVER['proses_status.php'];
//   header("Refresh: 100; URL=$url");
// }while(isset($_SESSION['admin']));
?>
<table border="1">
  <thead>
    <tr>
      <th>No</th>
      <th>Ip Address</th>
      <th>Received</th>
      <th>Lost</th>
      <th>Min</th>
      <th>Max</th>
      <th>AVG</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "koneksi_db/koneksi.php";
    include("proses/cek_login.php");

    
    $no = 1;
      echo "<script> alert('Mulai memproses status ip address')' </script>";
      $query = mysqli_query($conn, "SELECT * FROM client where id_area=3");
      while($data = mysqli_fetch_assoc($query)){
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
        ?>

        <tr>
          <td><?php echo $no ?></td>
          <td><?php echo $ip_client; ?></td>
          <td><?php echo $received_matang.' ms'?></td>
          <td><?php echo $lost_matang.' ms'?></td>

          <?php
        if (filter_var($avg_fix, FILTER_VALIDATE_INT)){

          $sql_kecepatan = mysqli_query($conn, "UPDATE client SET minimum=$min_fix, maksimum=$max_fix, average=$avg_fix where id_client = ".$idClient."");
          echo '<td>'.$min_fix.'</td>';
          echo '<td>'.$max_fix.'</td>';
          echo '<td>'.$avg_fix.'</td>';

        }  else if(!filter_var($avg_fix, FILTER_VALIDATE_INT)){
          if (empty($avg_fix)) {
            $sql_kecepatan = mysqli_query($conn, "UPDATE client SET minimum=0, maksimum=0, average=0 where id_client = ".$idClient."");
            echo '<td> - </td>';
            echo '<td> - </td>';
            echo '<td> - </td>';
          } else {
            $min_super_fix = substr($min_fix,0,1);
            $max_super_fix = substr($max_fix,0,1);
            $avg_super_fix = substr($avg_fix,0,1);
            $sql_kecepatan = mysqli_query($conn, "UPDATE client SET minimum=$min_super_fix, maksimum=$max_super_fix, average=$avg_super_fix where id_client = ".$idClient."");
            echo '<td>'.$min_super_fix.'</td>';
            echo '<td>'.$max_super_fix.'</td>';
            echo '<td>'.$avg_super_fix.'</td>';
          }
        }



        //kondisi jika hasil angka 1 digit
          $id_status_baru=1;
          if($received_matang >= 1){
            if (empty($avg_fix)) {
             $id_status_baru = 3;
           } else {
            $id_status_baru = 1;
          }

        } else if($lost_matang >= 1) {
          $id_status_baru = 2;

        } 

        $sql_status = mysqli_query($conn, "UPDATE client SET id_status=$id_status_baru where id_client = $idClient");
        $sql_nama_status = mysqli_query($conn, "SELECT klien.id_status, status.nama_status FROM client klien INNER JOIN status status ON (klien.id_status = status.id_status) WHERE id_client = ".$idClient."");
        while ($data_status = mysqli_fetch_assoc($sql_nama_status)) {
          $id_status1 = $data_status['id_status'];
          $nama_status1 = $data_status['nama_status'];
          if($id_status1 == 1){
            echo '<td style="color:green">';
            echo $nama_status1.'</td>';

          } else if($id_status1 == 2) {
            echo '<td style="color:red"><b>';
            echo $nama_status1.'</b></td>';

          } else if($id_status1 == 3) {
            echo '<td style="color:orange">';
            echo $nama_status1.'</td>';
          }

        }
        $no++;
      }

    ?>
  </tr>
</tbody>
</table>

