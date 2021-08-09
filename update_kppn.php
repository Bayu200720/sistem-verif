<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(4);
?>
<?php
  $pengajuan = find_by_id('pengajuan',(int)$_GET['id']);
    $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$pengajuan){
    $session->msg("d","Missing Pengajuan id.");
    if($user['user_level']==4){
           redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
        }else{
           redirect("detail_dokumen_ses.php?id=".$_GET['id'],false);
        }
  }
  $query  = "UPDATE pengajuan SET ";
        $query .= "status_kppn='".$_SESSION['user_id']."'";
        $query .= "WHERE id='{$pengajuan["id"]}'";
        $result = $db->query($query);
        //echo $query;
        $session->msg('s',' Berhasil di Proses');
        if($user['user_level']==4){
           redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
        }else{
           redirect('detail_dokumen_ses.php?id='.$_GET['id']);
        }
?>