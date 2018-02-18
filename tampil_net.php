<?php
/* koneksi ke db */
include "koneksi_db/koneksi.php";
include("proses/cek_login.php");
/* akhir koneksi db */
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (isset($_GET['action']) && $_GET['action'] == 'getdata') {

	$page = (isset($_POST['page']))?$_POST['page']: 1;
	$rp = (isset($_POST['rp']))?$_POST['rp'] : 10;
	$sortname = (isset($_POST['sortname']))? $_POST['sortname'] : 'ip_address';
	$sortorder = (isset($_POST['sortorder']))? $_POST['sortorder'] : 'asc';

	$sort = "ORDER BY $sortname $sortorder";
	$start = (($page-1) * $rp);
	$limit = "LIMIT $start, $rp";

	$query = (isset($_POST['query']))? $_POST['query'] : '';
	$qtype = (isset($_POST['qtype']))? $_POST['qtype'] : '';

	$where = "";
	if ($query) $where .= "WHERE $qtype LIKE '%$query%' ";


	$query = "SELECT C.id_client, C.ip_address, K.nama_area, C.subnet_mask, C.vlan , C.received, C.lost, C.minimum, C.maksimum, C.average, S.nama_status, C.id_status ";
	$query_from = "FROM client C INNER JOIN status S ON (C.id_status = S.id_status) 
	INNER JOIN area K ON (C.id_area = K.id_area)";

	$query .= $query_from . " $where $sort $limit";

	$query_total = "SELECT COUNT(*)". $query_from." ".$where;

	$sql = mysqli_query($conn, $query) or die($query);
	$sql_total = mysqli_query($conn, $query_total) or die($query_total);
	$total = mysqli_fetch_row($sql_total);
	$data = $_POST;
	$data['total'] = $total[0];
	$datax = array();
	$datax_r = array();
	while ($row = mysqli_fetch_row($sql)) {
		$rows['id'] = $row[0];
		$datax['cell'] = $row;
		array_push($datax_r, $datax);
	}
	$data['rows'] = $datax_r;
    // $json[] = array(
    //     'id_client'=>$data['id_client'],
    //     'ip_address'=>$data['ip_address'],
    //     'nama_area'=>$data['nama_area'],
    //     'subnet_mask'=>$data['subnet_mask'],
    //     'vlan'=>$data['vlan'],
    //     'received'=>$data['received'].' ms',
    //     'lost'=>$data['lost'].' ms',
    //     'minimum'=>$data['minimum'].' ms',
    //     'maksmimum'=>$data['maksmimum'].' ms',
    //     'average'=>$data['average'].' ms',
    //     'nama_status'=>$data['nama_status'],
    //     );
    echo json_encode($data);
    exit;
} else if (isset($_GET['action']) && $_GET['action'] == 'get_client') {
	$id_client = $_GET['id_client'];
	$query = "SELECT C.id_client, C.ip_address, K.nama_area, C.subnet_mask, C.vlan, C.received, C.lost, C.minimum, C.maksimum, C.average, S.nama_status, C.id_status
	FROM client C INNER JOIN status S ON (C.id_status = S.id_status) 
	INNER JOIN area K ON (C.id_area = K.id_area) WHERE id_client='$id_client'";
	$sql = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($sql);

	echo json_encode ($row);
	exit;
}
?>    
<style type="text/css">
.labelfrm {
  display:block;
  font-size:small;
  margin-top:5px;
}
.error {
  font-size:small;
  color:red;
}
</style>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.form.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/flexigrid/flexigrid.css">

<script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
<script type="text/javascript" src="assets/js/flexigrid.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
            //flexigrid handling
            $('#flex1').flexigrid
            (
            {
            	url: 'tampil_net.php?action=getdata',
            	dataType: 'json',

            	colModel : [
            	{display: 'No', name : 'id_client', width : 40, sortable : true, align: 'center', process: doaction},
            	{display: 'Ip Address', name : 'ip_address', width : 120, sortable : true, align: 'center', process: doaction},
            	{display: 'Nama Area', name : 'nama_area', width : 100, sortable : true, align: 'center', process: doaction},
            	{display: 'Subnet Mask', name : 'subnet_mask', width : 120, sortable : true, align: 'center', process: doaction},
            	{display: 'Vlan', name : 'vlan', width : 60, sortable : true, align: 'center', process: doaction},
            	{display: 'Received', name : 'received', width : 70, sortable : true, align: 'center', process: doaction},
            	{display: 'Lost', name : 'lost ms', width : 70, sortable : true, align: 'center',  process: doaction},
            	{display: 'Minimum', name : 'minimum', width : 70, sortable : true, align: 'center', process: doaction},
            	{display: 'Maksimum', name : 'maksmimum', width : 80, sortable : true, align: 'center', process: doaction},
            	{display: 'Average', name : 'average', width : 90, sortable : true, align: 'center', process: doaction},
            	{display: 'Status', name : 'nama_status', width : 200, sortable : true, align: 'center', process: doaction}
            	],

             buttons : [
             <?php if($_SESSION['role'] == 'super_admin'){ ?>
                 {
                    name : 'Edit',
                    bclass : 'edit',
                    onpress : aksi
                }
                ,

                {
                    name : 'Delete',
                    bclass : 'delete',
                    onpress : aksi
                }
                ,

                {
                    separator : true
                } 
                <?php }?>
                ],
                searchitems : [
                {display: 'Ip address', name : 'ip_address'},
                {display: 'Nama Area', name : 'nama_area'},
                {display: 'nama status', name : 'nama_status', isdefault: true}
                ],

                sortname: 'id_client',
                sortorder: 'asc',
                usepager: true,
                title: 'Data Jaringan Pertamina',
                useRp: true,
                rp: 15,
                showTableToggleBtn : true,
                width: '1010',
                height: 'auto'
            }
            );

        }); 
    function doaction( celDiv, id ) {
       $( celDiv ).click( function() {
          var id_client = $(this).parent().parent().children('td').eq(0).text();
          $.getJSON ('tampil_net.php',{action:'get_client',id_client:id_client}, function (json) {
             $('#ip_address').val(json.ip_address);
             $('#id_area').val(json.id_area);
             $('#id_status').val(json.id_status);
         }); 
          $('#id_client').attr('readonly','readonly');
          $('#input').attr('disabled','disabled');
          $('#edit, #delete').removeAttr('disabled');
      });
   }
   function showResponse(responseText, statusText) {
       var data = responseText['data'];
       var pesan = responseText['pesan'];
       //console.log(responseText);
       //alert(pesan);
       //resetForm();
       $('#flex1').flexReload();
   }
   function resetForm() {
       $('#input').removeAttr('disabled');
       $('#edit, #delete').attr('disabled','disabled');
       $('#id_client').removeAttr('readonly');
   }

   function aksi(com, grid) {
    if (com == 'Delete') {
        var conf = confirm('Delete ' + $('.trSelected', grid).length + ' items?')
        if(conf){
            $.each($('.trSelected', grid),
                function(key, value){
                    $.get('example4.php', { Delete: value.firstChild.innerText}
                        , function(){
                                        // when ajax returns (callback), update the grid to refresh the data
                                        var id_client = value.children[0].innerText; 
                                        window.location.href="proses/proses_hapus_client.php?id_client="+id_client;
                                        
                                        $("#flex1").flexReload();
                                    });
                });    
        }
    }
    else if (com == 'Edit') {
        var conf = confirm('Edit ' + $('.trSelected', grid).length + ' items?')
        if(conf){
            $.each($('.trSelected', grid),
                function(key, value){
                // in case we're changing the key
                var id_client = value.children[0].innerText; 
                window.location.href="form_edit_client.php?id_client="+id_client;
                //console.log(id_client);
            });
        }
    }
}
</script>
<table id="flex1" style="display:none font-size:18px;"></table>

<script type="text/javascript">
    // $(document).ready(function() {
    //     console.log($('#flex1 tr'));
    //     $('#flex1 tr').each(function() {
    //         console.log($(this));
    //         var abbr = $(this).find("td").attr('abbr');//.val();    
    //         //td.css('color','red');
    //         console.log(abbr);
    //     });

    // });
</script>
<script>

</script>