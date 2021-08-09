<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(6);
?>
<?php
  $user = find_by_id('users',$_SESSION['user_id']);
  $d_sale = find_by_id('detail_pengajuan',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","Missing detail pengajuan id.");
      if($user['id_satker'] == 1 or $user['id_satker'] == 2 or $user['id_satker'] == 3 or $user['id_satker'] == 4 or $user['id_satker'] == 14){
        redirect('detail_pengajuan_pum.php?id='.$d_sale['id_pencairan']);
      }else{
        redirect('detail_pengajuan.php?id='.$d_sale['id_pengajuan']);
      }
  }
?>
<?php
  $delete_id = delete_by_id('detail_pengajuan',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","detail pengajuan deleted.");
      if($user['id_satker'] == 1 or $user['id_satker'] == 2 or $user['id_satker'] == 3 or $user['id_satker'] == 4 or $user['id_satker'] == 14){
        redirect('detail_pengajuan_pum.php?id='.$d_sale['id_pencairan']);
      }else{
        redirect('detail_pengajuan.php?id='.$d_sale['id_pengajuan']);
      }
  } else {
      $session->msg("d","detail pengajuan deletion failed.");
      if($user['id_satker'] == 1 or $user['id_satker'] == 2 or $user['id_satker'] == 3 or $user['id_satker'] == 4 or $user['id_satker'] == 14){
        redirect('detail_pengajuan_pum.php?id='.$d_sale['id_pencairan']);
      }else{
        redirect('detail_pengajuan.php?id='.$d_sale['id_pengajuan']);
      }
  }
?>
