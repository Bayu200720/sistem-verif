<?php
  $page_title = 'All Detail Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   // Checkin What level user has permission to view this page
   $user = find_by_id('users',$_SESSION['user_id']);
  // var_dump($user['user_level']);
    if($user['user_level'] == 3){ //echo "ok 3";exit();
    page_require_level(3);
    }else if($user['user_level'] == 6){ //echo "3";exit();
      page_require_level(6); 
    }else if($user['user_level'] == 5){ //echo "3";exit();
      page_require_level(5);
    
    }else{
      page_require_level(3);
    }

$pengajuan = find_by_id('pengajuan',$_POST['id']);
  ?>

<?php


if(isset($_POST["Import_span"])){
  
  $allowedExts = array("gif", "jpeg", "jpg", "png","csv");
  $extension = end(explode(".", $_FILES["file"]["name"]));
 // echo $extension; echo $_FILES["file"]["type"]; exit();
  if (($_FILES["file"]["size"] < 20000)
  && in_array($extension, $allowedExts)){

          $filename=$_FILES["file"]["tmp_name"];    
          if($_FILES["file"]["size"] > 0)
          {
              $file = fopen($filename, "r");
          
              while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
              {
                  $hasil[]=$getData;
                  //var_dump($hasil);
                 // $akun=find_all_global('akun',$getData['4'],'mak');
                //  $sql = "INSERT into detail_Pengajuan (no_sptjb,nominal,pph,ppn,id_pengajuan,id_akun) 
                  //    values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$_POST['id']."','".$akun[0]['id']."')";
                      //echo $sql;exit();
                    //  $hasil=$db->query($sql);
             //      print_r($hasil);
              }
             // echo count($has)
              for($i=1;$i<count($hasil);$i++){
                 // $akun=find_all_global('akun',$hasil[$i][4],'mak');
                 $spm =substr($hasil[$i][10],0,5); 
                  $sql = "UPDATE pengajuan SET sp2d='".$hasil[$i][1]."' WHERE SPM ='".$spm."'";
                 //echo $sql;echo "<br>";
                $result= $db->query($sql);
                //echo $sql; echo "<br>";//exit();
              }
              //exit();
              if($result){
                  $session->msg('s',"Berhasil Import ");
                  if($user['user_level']==6){
                  redirect('ben.php?id='.$_POST['id'], false);
                  }else{
                  redirect('ben.php?id='.$_POST['id'], false);
                  }
              } else {
                  $session->msg('d',' Sorry failed to Import!');
                  if($user['user_level']==6){
                  redirect('ben.php?id='.$_POST['id'], false);
                  }else{
                  redirect('ben.php?id='.$_POST['id'], false);
                  }
              }
              
             // var_dump($hasil);
              fclose($file); 
          }
  }else{
      $session->msg('d',' Format File CSV Only!');
      redirect('detail_pengajuan.php?id='.$pengajuan['id'], false);
  }
}   



if(isset($_POST["Import_detail"])){
  
  $allowedExts = array("gif", "jpeg", "jpg", "png","csv");
  $extension = end(explode(".", $_FILES["file"]["name"]));
 // echo $extension; echo $_FILES["file"]["type"]; exit();
  if (($_FILES["file"]["size"] < 20000)
  && in_array($extension, $allowedExts)){

          $filename=$_FILES["file"]["tmp_name"];    
          if($_FILES["file"]["size"] > 0)
          {
              $file = fopen($filename, "r");
          
              while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
              {
                  $hasil[]=$getData;
                 // $akun=find_all_global('akun',$getData['4'],'mak');
                //  $sql = "INSERT into detail_Pengajuan (no_sptjb,nominal,pph,ppn,id_pengajuan,id_akun) 
                  //    values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$_POST['id']."','".$akun[0]['id']."')";
                      //echo $sql;exit();
                    //  $hasil=$db->query($sql);
                   
              }
             // echo count($has)
              for($i=1;$i<count($hasil);$i++){
                 // $akun=find_all_global('akun',$hasil[$i][4],'mak');
                  $sql = "INSERT into detail_transaksi (id_detail_pengajuan,uraian,nominal,penerima,id_penerima,pph,ppn,tanggal_transaksi) 
                      values ('".$_POST['id']."','".$hasil[$i][5]."','".$hasil[$i][2]."','".$hasil[$i][0]."','".$hasil[$i][1]."','".$hasil[$i][3]."','".$hasil[$i][4]."','".$hasil[$i][6]."')";
                 // echo $sql;echo "<br>";
                 $result= $db->query($sql);
                //echo $sql; echo "<br>";//exit();
              }
             // exit();
              if($result){
                  $session->msg('s',"Berhasil Import ");
                  if($user['user_level']==6){
                  redirect('transaksi_db_a.php?id='.$_POST['id'], false);
                  }else{
                  redirect('transaksi_db_a.php?id='.$_POST['id'], false);
                  }
              } else {
                  $session->msg('d',' Sorry failed to Import!');
                  if($user['user_level']==6){
                  redirect('transaksi_db_a.php?id='.$_POST['id'], false);
                  }else{
                  redirect('transaksi_db_a.php?id='.$_POST['id'], false);
                  }
              }
              
             // var_dump($hasil);
              fclose($file); 
          }
  }else{
      $session->msg('d',' Format File CSV Only!');
      redirect('detail_pengajuan.php?id='.$pengajuan['id'], false);
  }
}   

 if(isset($_POST["Import"])){
  
    $allowedExts = array("gif", "jpeg", "jpg", "png","csv");
    $extension = end(explode(".", $_FILES["file"]["name"]));
   // echo $extension; echo $_FILES["file"]["type"]; exit();
    if (($_FILES["file"]["size"] < 20000)
    && in_array($extension, $allowedExts)){

            $filename=$_FILES["file"]["tmp_name"];    
            if($_FILES["file"]["size"] > 0)
            {
                $file = fopen($filename, "r");
            
                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
                {
                    $hasil[]=$getData;
                   // $akun=find_all_global('akun',$getData['4'],'mak');
                  //  $sql = "INSERT into detail_pengajuan (no_sptjb,nominal,pph,ppn,id_pengajuan,id_akun) 
                    //    values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$_POST['id']."','".$akun[0]['id']."')";
                        //echo $sql;exit();
                      //  $hasil=$db->query($sql);
                     
                }
               // echo count($has)
                for($i=1;$i<count($hasil);$i++){
                    $akun=find_all_global('akun',$hasil[$i][4],'mak');
                    $sql = "INSERT into detail_pengajuan (no_sptjb,nominal,pph,ppn,id_pengajuan,id_akun,tanggal_dp) 
                        values ('".$hasil[$i][0]."','".$hasil[$i][1]."','".$hasil[$i][2]."','".$hasil[$i][3]."','".$_POST['id']."','".$akun[0]['id']."','".$hasil[$i][5]."')";
                   // echo $sql;echo "<br>";exit();
                    $result= $db->query($sql);
                  //echo $sql; echo "<br>";//exit();
                }
                if($result){
                    $session->msg('s',"Berhasil Import ");
                    if($user['user_level']==6){
                    redirect('detail_pengajuan.php?id='.$pengajuan['id'], false);
                    }else{
                    redirect('detail_pengajuan.php?id='.$pengajuan['id'], false);
                    }
                } else {
                    $session->msg('d',' Sorry failed to Import!');
                    if($user['user_level']==6){
                    redirect('detail_pengajuan.php?id='.$pengajuan['id'], false);
                    }else{
                    redirect('detail_pengajuan.php?id='.$pengajuan['id'], false);
                    }
                }
                
               // var_dump($hasil);
                fclose($file); 
            }
    }else{
        $session->msg('d',' Format File CSV Only!');
        redirect('detail_pengajuan.php?id='.$pengajuan['id'], false);
    }
  }   


  if(isset($_POST["ImportMAK"])){
    

    $allowedExts = array("gif", "jpeg", "jpg", "png","csv");
    $extension = end(explode(".", $_FILES["file"]["name"]));
   // echo $extension; echo $_FILES["file"]["type"]; exit();
    if (($_FILES["file"]["size"] < 20000)
    && in_array($extension, $allowedExts)){

            $filename=$_FILES["file"]["tmp_name"];    
            if($_FILES["file"]["size"] > 0)
            {
                $file = fopen($filename, "r");
                while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
                {
                    $users=find_by_id('users',$_SESSION['user_id']);
                    $sql = "INSERT into akun (tahun,mak,keterangan,nominal,id_satker) 
                        values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";
                echo $sql;
                        $hasil=$db->query($sql);
                 
                }
              
               //var_dump($hasil); exit();
				
                if($hasil){
                    $session->msg('s',"Berhasil Import ");
                    if($user['user_level']==6){
                    redirect('Mmak.php', false);
                    }else{
                    redirect('Mmak.php', false);
                    }
                } else {
                 	 $session->msg('s',"Berhasil Import ");
                    //$session->msg('d',' Sorry failed to Import!');
                    if($user['user_level']==6){
                    redirect('Mmak.php', false);
                    }else{
                    redirect('Mmak.php', false);
                    }
                }
                fclose($file); 
            }
    }else{
        $session->msg('d',' Format File CSV Only!');
        redirect('Mmak.php', false);
    }
  }   
 ?>
