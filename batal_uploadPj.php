<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);
?>
<?php
  $pengajuan = find_by_id('pengajuan',(int)$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$pengajuan){
    $session->msg("d","Missing Pengajuan id.");
     if($user['user_level']==5){
       redirect('Pertanggungjawaban.php?id='.$pengajuan['id']);
     }else{
    	redirect('Pertanggungjawaban.php?id='.$pengajuan['id']);
     }
  }

	if(isset($_GET['status'])){
        if($_GET['status'] == 'H_kurang'){
          $query  = "UPDATE pengajuan SET ";
          $query .= "upload_kekurangan=''";
          $query .= "WHERE id='{$pengajuan["id"]}'";
          $result = $db->query($query);
          $session->msg('s',' Berhasil di Batalkan');
           if($user['user_level']==5){
        		 redirect('Pertanggungjawaban.php?id='.$pengajuan['id']);
       		}else{
        		redirect('Pertanggungjawaban.php?id='.$pengajuan['id'], false);
     		 }
        }
    }else{
        $query  = "UPDATE pengajuan SET ";
              $query .= "upload_pertanggungjawaban=''";
              $query .= "WHERE id='{$pengajuan["id"]}'";
              $result = $db->query($query);
              $session->msg('s',' Berhasil di Batalkan');
               if($user['user_level']==5){
            		 redirect('Pertanggungjawaban.php?id='.$pengajuan['id']);
          		 }else{
           			 redirect('Pertanggungjawaban.php?id='.$pengajuan['id'], false);
         		 }
    }
?>