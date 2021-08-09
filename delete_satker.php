<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $d_sale = find_by_id('satker',(int)$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$d_sale){
    $session->msg("d","Missing satker id.");
      if($user['user_level']==2){
              redirect('satker.php', false);
          }else{
    redirect('satker.php');
        }
  }
?>
<?php
  $delete_id = delete_by_id('satker',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","satker deleted.");
      if($user['user_level']==2){
              redirect('satker.php', false);
          }else{
      redirect('satker.php');
        }
  } else {
      $session->msg("d","satker deletion failed.");
          if($user['user_level']==2){
              redirect('satker.php', false);
          }else{
      redirect('satker.php');
          }
  }
?>
