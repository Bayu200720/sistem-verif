<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
  $pengajuan = find_by_id('pengajuan',(int)$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$pengajuan){
    $session->msg("d","Missing Pengajuan id.");
    if($user['user_level']==2){
       redirect('pengajuan_verif.php');
     }else{
      redirect('pengajuan_verif.php');
    }
  }
  $query  = "UPDATE pengajuan SET ";
        $query .= "status_verifikasi='0'";
        $query .= " WHERE id='{$pengajuan["id"]}'";
        // echo $query; exit();
        $result = $db->query($query);

        $qd= "DELETE FROM verifikasi WHERE id_pengajuan =".$pengajuan['id'];
       
        $db->query($qd);
  
        
        $session->msg('s',' Berhasil di Batalkan');
        if($user['user_level']==2){
           redirect('pengajuan_verif.php?id='.$pengajuan['id_nodin'], false);
        }else{
           redirect('pengajuan_verif.php?id='.$pengajuan['id_nodin'], false);
        }
?>