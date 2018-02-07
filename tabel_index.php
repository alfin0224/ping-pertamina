<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// $page1 = $_GET['page'];
// $postData = $_POST['idClient'];
// $url=$_SERVER['REQUEST_URI'.'index.php?page=$page1'];
// header("Refresh: 30; URL=$url");
?>
<?php
include "koneksi_db/koneksi.php";
include("proses/cek_login.php");
$limit = 5;
// Cek apakah terdapat data page pada URL
$page = (isset($_GET['page']))? $_GET['page'] : 1;
$limit_start = ($page - 1) * $limit;
?>
<table class="table table-striped table-bordered datatable">                       
  <thead>
    <tr>
      <th>No</th>
      <th>Ip Address</th>
      <th>Area</th>
      <th>Received</th>
      <th>Lost</th>
      <th>Kecepatan</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>

    <?php
    if(isset($keyword)){ // Jika veriabel $keyword ada (user telah mengklik tombol search)
      $param = '%'.$keyword.'%';
      // Buat query untuk menampilkan data siswa berdasarkan NIS / Nama / Jenis Kelamin / Telp / Alamat
      // $sql_client =  mysqli_query($conn, "SELECT C.id_client, C.ip_address, S.nama_status, C.id_status, K.nama_area FROM client C INNER JOIN status S ON (C.id_status = S.id_status) 
      //   INNER JOIN area K ON (C.id_area = K.id_area) WHERE C.ip_address LIKE :ip_a OR S.nama_status LIKE :nama_st OR K.nama_area LIKE :nama_ar
      //   order by id_client asc LIMIT $limit_start, $limit");

      $stmt = mysqli_prepare($conn, "SELECT C.id_client, C.ip_address, S.nama_status, C.id_status, K.nama_area FROM client C INNER JOIN status S ON (C.id_status = S.id_status) 
        INNER JOIN area K ON (C.id_area = K.id_area) WHERE C.ip_address LIKE :ip_a OR S.nama_status LIKE :nama_st OR K.nama_area LIKE :nama_ar
        order by id_client asc LIMIT $limit_start, $limit");
      mysqli_stmt_bind_param($stmt,':ip_a', $param);
      mysqli_stmt_bind_param($stmt,':nama_st', $param);
      mysqli_stmt_bind_param($stmt,':nama_ar', $param);
      mysqli_stmt_execute($stmt);
    }else{ // Jika user belum mengklik tombol search
      // Buat query untuk menampilkan semua data siswa
      // $sql_client = mysqli_query($conn, "SELECT C.id_client, C.ip_address, S.nama_status, C.id_status, K.nama_area FROM client C INNER JOIN status S ON (C.id_status = S.id_status) 
      //   INNER JOIN area K ON (C.id_area = K.id_area) order by id_client asc LIMIT $limit_start, $limit");

      $stmt = mysqli_prepare($conn, "SELECT C.id_client, C.ip_address, S.nama_status, C.id_status, K.nama_area FROM client C INNER JOIN status S ON (C.id_status = S.id_status) 
        INNER JOIN area K ON (C.id_area = K.id_area) order by id_client asc LIMIT $limit_start, $limit");
      mysqli_stmt_execute($stmt);
    }
    $no=$limit_start+1;
    $result = mysqli_stmt_get_result($stmt);
    while($data = mysqli_fetch_assoc($result)){
      $idClient = $data['id_client'];
      $ip_client = $data['ip_address'];
      $id_status = $data['id_status'];
      $status_client = $data['nama_status'];
      $nama_area = $data['nama_area'];
      ?>

      <?php
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
        <td><?php echo $nama_area; ?></td>
        <td><?php echo $received_matang.' ms'?></td>
        <td><?php echo $lost_matang.' ms'?></td>

        <?php

        if (filter_var($avg_fix, FILTER_VALIDATE_INT)){

          $sql_kecepatan = mysqli_query($conn, "UPDATE client SET minimum=$min_fix, maksimum=$max_fix, average=$avg_fix where id_client = ".$idClient."");
          echo '<td><a href="#kecepatan" class="btn btn-default btn-small" id="custId" data-toggle="modal" data-id='.$idClient.'>Detail</a></td>';

        }  else if(!filter_var($avg_fix, FILTER_VALIDATE_INT)){
          if (empty($avg_fix)) {
            echo '<td> - </td>';
          } else {
            $min_super_fix = substr($min_fix,0,1);
            $max_super_fix = substr($max_fix,0,1);
            $avg_super_fix = substr($avg_fix,0,1);
            $sql_kecepatan = mysqli_query($conn, "UPDATE client SET minimum=$min_super_fix, maksimum=$max_super_fix, average=$avg_super_fix where id_client = ".$idClient."");
            echo '<td><a href="#kecepatan" class="btn btn-default btn-small" id="custId" data-toggle="modal" data-id='.$idClient.'>Detail</a></td>';
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

      echo'
      <td style="text-align:center">
        <a alt="edit" class="btn btn-info" href="form_edit_client.php?id_client='.$data['id_client'].'">
          <i class="fa fa-edit "></i>
        </a>
        <a class="btn btn-danger" href="proses/proses_hapus_client.php?id_client='.$data['id_client'].'" onClick="return konfirmasi_hapus();">
          <i class="fa fa-trash-o "></i>
        </a> </td>';
        $no++;
      }
      ?>
    </tr> 

  </tbody>
</table>
<ul class="pagination">
  <!-- LINK FIRST AND PREV -->
  <?php
                    if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
                      ?>
                      <li class="disabled"><a href="#">First</a></li>
                      <li class="disabled"><a href="#">&laquo;</a></li>
                      <?php
                    }else{ // Jika page bukan page ke 1
                      $link_prev = ($page > 1)? $page - 1 : 1;
                      ?>
                      <li><a href="net_monitoring.php?page=1">First</a></li>
                      <li><a href="net_monitoring.php?page=<?php echo $link_prev; ?>">&laquo;</a></li>
                      <?php
                    }
                    ?>
                    <?php
                    $query  = "SELECT COUNT(*) AS jumData FROM client";
                    $hasil  = mysqli_query($conn, $query);
                    $data  = mysqli_fetch_array($hasil);
                  // $jumData = $data['jumData'];
                  // $jumlah_page = ceil($jumData/$limit);
                $jumlah_page = ceil($data['jumData'] / $limit); // Hitung jumlah halamannya
                $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang ak
                $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
                $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
                for($i = $start_number; $i <= $end_number; $i++){
                  $link_active = ($page == $i)? ' class="active"' : '';
                  ?>
                  <li<?php echo $link_active; ?>><a href="net_monitoring.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                  <?php
                }
                ?>

                <!-- LINK NEXT AND LAST -->
                <?php
                            // Jika page sama dengan jumlah page, maka disable link NEXT nya
                            // Artinya page tersebut adalah page terakhir 
                            if($page == $jumlah_page){ // Jika page terakhir
                              ?>
                              <li class="disabled"><a href="#">&raquo;</a></li>
                              <li class="disabled"><a href="#">Last</a></li>
                              <?php
                            }else{ // Jika Bukan page terakhir
                              $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                              ?>
                              <li><a href="net_monitoring.php?page=<?php echo $link_next; ?>">&raquo;</a></li>
                              <li><a href="net_monitoring.php?page=<?php echo $jumlah_page; ?>">Last</a></li>
                              <?php
                            }
                            ?>
                          </ul>
                          <script src="assets/js/ajax.js"></script>