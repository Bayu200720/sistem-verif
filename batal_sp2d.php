<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(5);
?>
<?php
  $pengajuan = find_by_id('pengajuan',(int)$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$pengajuan){
    $session->msg("d","Missing Pengajuan id.");
        if($user['user_level']==5){
           redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
        }else{
    redirect('detail_dokumen_ses.php?id='.$_GET['id']);
      }
  }
  $query  = "UPDATE pengajuan SET ";
        $query .= "status_sp2d='0'";
        $query .= "WHERE id='{$pengajuan["id"]}'";
        $result = $db->query($query);
        $pencairan= find_all_global('pencairan',$pengajuan['id'],'id_pengajuan');
        //var_dump($pencairan);exit();
        $delete_id = delete_by_id('pencairan',$pencairan[0]['id']);
        $session->msg('s',' Berhasil di Batalkan');
            if($user['user_level']==5){
           redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
        }else{
      redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
        }
?>