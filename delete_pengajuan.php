<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(6);
 // page_require_level(5);
?>
<?php
  $d_sale = find_by_id('pengajuan',(int)$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$d_sale){
    $session->msg("d","Missing pengajuan id.");
      if($user['user_level']==2){
              redirect('pengajuan_bpp.php?id='.$d_sale["id_nodin"].'', false);
          }else{
            redirect('pengajuan_bpp.php?id='.$d_sale["id_nodin"].'');
        }
  }
?>

<?php
  $delete_id = delete_by_id('pengajuan',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","pengajuan deleted.");
      if($user['user_level']==2){
              redirect('pengajuan_bpp.php?id='.$d_sale["id_nodin"].'', false);
          }else{
            redirect('pengajuan_bpp.php?id='.$d_sale["id_nodin"].'');
        }
  } else {
      $session->msg("d","pengajuan deletion failed.");
          if($user['user_level']==2){
              redirect('pengajuan_bpp.php?id='.$d_sale["id_nodin"].'', false);
          }else{
            redirect('pengajuan_bpp.php?id='.$d_sale["id_nodin"].'');
          }
  }
?>


?>