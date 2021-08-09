<?php
  $page_title = 'All Detail Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   // Checkin What level user has permission to view this page
   $user = find_by_id('users',$_SESSION['user_id']);
  // var_dump($user['user_level']);
    if($user['user_level'] == 2){ //echo "ok 3";exit();
    page_require_level(3); 
    }else if($user['user_level'] == 7 ){ //echo "7";exit();
      page_require_level(7); 
    }else if($user['user_level'] == 6){ //echo "3";exit();
      page_require_level(6); 
    }else{
      page_require_level(3);
    }    

  ?>

<?php



$filename = "toy_csv.csv";
$fp = fopen('php://output', 'w');

// $filed=find_filed_tabel('db_pengajuan','detail_pengajuan');//var_dump($filed);exit();
// //$h=find_all('satker');var_dump($h);exit();
// foreach ($filed as $sale):
//   $header[] = $sale[0];
// endforeach;
$header = array('sptjb', 'nominal','pph','ppn','id_pengajuan','id_akun');

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

$sql = $db->query("SELECT no_sptjb,nominal,pph,ppn,id_pengajuan,id_akun FROM detail_pengajuan");
while($row= $db->fetch_row($sql)){
    fputcsv($fp, $row);
}
exit;
?>


