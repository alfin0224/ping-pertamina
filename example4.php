<?php
echo "hello world";
session_start();

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$rp = isset($_POST['rp']) ? $_POST['rp'] : 10;
$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : 'id_client';
$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : 'desc';
$query = isset($_POST['query']) ? $_POST['query'] : false;
$qtype = isset($_POST['qtype']) ? $_POST['qtype'] : false;


    if(isset($_GET['Add'])){ // this is for adding records

        $rows = $_SESSION['aksi'];
        $rows[$_GET['id_client']] = 
        array(
            'ip_address'=>$_GET['ip_address']
            , 'subnet_mask'=>$_GET['subnet_mask']
            , 'vlan'=>$_GET['vlan']
            , 'id_area'=>$_GET['id_area']
            , 'lokasi' => $_GET['lokasi']
            );
        $_SESSION['Example4'] = $rows;

    }
    elseif(isset($_GET['Edit'])){ // this is for Editing records
        $rows = $_SESSION['Example4'];
        
        unset($rows[trim($_GET['Orgid_client'])]);  // just delete the original entry and add.
        
        $rows[$_GET['ip_address']] = 
        array(
            'name'=>$_GET['Name']
            , 'favorite_color'=>$_GET['FavoriteColor']
            , 'favorite_pet'=>$_GET['FavoritePet']
            , 'primary_language'=>$_GET['PrimaryLanguage']
            );
        $_SESSION['Example4'] = $rows;
    }
    elseif(isset($_GET['Delete'])){ // this is for removing records
        $rows = $_SESSION['Example4'];
        unset($rows[trim($_GET['Delete'])]);  // to remove the \n
        $_SESSION['Example4'] = $rows;
    }
    else{

        if(isset($_SESSION['Example4'])){ // get session if there is one
            $rows = $_SESSION['Example4'];
        }
        else{ // create session with some data if there isn't
        $sql = "SELECT ip_address,subnet_mask, id_area, id_status FROM client $where $sort LIMIT 30";
        $result = runSQL($sql);
        $rows[1] = array('name'=>'Tony',   'favorite_color'=>'green',  'favorite_pet'=>'hamster',   'primary_language'=>'english');
        $rows[2] = array('name'=>'Mary',   'favorite_color'=>'red',    'favorite_pet'=>'groundhog', 'primary_language'=>'spanish');
        $rows[3] = array('name'=>'Seth',   'favorite_color'=>'silver', 'favorite_pet'=>'snake',     'primary_language'=>'french');
        $rows[4] = array('name'=>'Sandra', 'favorite_color'=>'blue',   'favorite_pet'=>'cat',       'primary_language'=>'mandarin');
        $_SESSION['Example4'] = $rows;
    }



    header("Content-type: application/json");
    $jsonData = array('page'=>$page,'total'=>0,'rows'=>array());
    foreach($rows AS $rowNum => $row){
            //If cell's elements have named keys, they must match column names
            //Only cell's with named keys and matching columns are order independent.
        $entry = array('id' => $rowNum,
            'cell'=>array(
                'employeeID'       => $rowNum,
                'name'             => $row['name'],
                'primary_language' => $row['primary_language'],
                'favorite_color'   => $row['favorite_color'],
                'favorite_pet'     => $row['favorite_pet']
                )
            );
        $jsonData['rows'][] = $entry;
    }
    $jsonData['total'] = count($rows);
    echo json_encode($jsonData);

}