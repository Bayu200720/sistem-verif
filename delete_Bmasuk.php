<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $d_sale = find_by_id('product_in',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","Missing sale id.");
    redirect('Bmasuk.php');
  }
?>
<?php

  $delete_id = delete_by_id('product_in',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","sale deleted.");

      redirect('Bmasuk.php');
  } else {
      $session->msg("d","sale deletion failed.");
      redirect('Bmasuk.php');
  }
?>
