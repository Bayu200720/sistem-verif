<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $d_sale = find_by_id('nodin',(int)$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$d_sale){
    $session->msg("d","Missing nodin id.");
      if($user['user_level']==2){
              redirect('nodin.php', false);
          }else{
    redirect('nodin.php');
        }
  }
?>
<?php
  $delete_id = delete_by_id('nodin',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","nodin deleted.");
      if($user['user_level']==2){
              redirect('nodin.php', false);
          }else{
      redirect('nodin.php');
        }
  } else {
      $session->msg("d","nodin deletion failed.");
          if($user['user_level']==2){
              redirect('nodin.php', false);
          }else{
      redirect('nodin.php');
          }
  }
?>
