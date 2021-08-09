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
        $query .= "status_sp2d='".$_SESSION['user_id']."'";
        $query .= "WHERE id='{$pengajuan["id"]}'";
        $result = $db->query($query);
        
      $data = find_Tpengajuan($pengajuan['id']);
      $pengajuan = find_by_id('pengajuan',$pengajuan['id']);
     // var_dump($pengajuan);
      $insert ="INSERT INTO pencairan(id_pengajuan,nominal,keterangan,tanggal,id_satker,spm,id_jenis_bendahara)VALUES({$pengajuan['id']},{$data['jum']},'Pengajuan','{$data['tanggal']}',{$data['id_satker']},{$data['SPM']},'{$pengajuan['id_jenis_bendahara']}')";
      //var_dump($insert);exit();
      $db->query($insert);

        $session->msg('s',' Berhasil di Proses');
            if($user['user_level']==5){
           redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
        }else{
      redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
        }
?>