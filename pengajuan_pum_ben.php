<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);
?>
<?php
$user=find_by_id('users',$_SESSION['user_id']);
$satker = find_all_global('satker',$user['id_satker'],'id');
$sales1 = find_all_global_tahun('pengajuan_pum',$user['id_satker'],'id_satker',$satker[0]['tahun']);
$sales = find_all_global('pengajuan_pum',$user['tahun'],'tahun');


?>
<?php


 if(isset($_POST['add_panjar'])){
   $req_fields = array('spm','tanggal','id_satker','nominal');
   validate_fields($req_fields);
   if(empty($errors)){
     $spm   = remove_junk($db->escape($_POST['spm']));
     $id   = remove_junk($db->escape($_POST['id']));
     $tanggal   = remove_junk($db->escape($_POST['tanggal']));
     $id_satker = remove_junk($db->escape($_POST['id_satker']));
     $teks5 = $_POST['nominal'];
     $nominal1 = preg_replace("/[^0-9]/", "", $teks5);
     $nominal = remove_junk($db->escape($nominal1));
     $tahun = $satker[0]['tahun'];
     $query  = "INSERT INTO pencairan (";
     $query .=" tanggal,nominal,id_satker,spm";
     $query .=") VALUES (";
     $query .=" '{$tanggal}','{$nominal}','{$id_satker}','{$spm}'";
     $query .=")";
     if($db->query($query)){
       $query1 = "UPDATE pengajuan_pum SET status_pencairan= 1 WHERE id = '{$id}'";
       $db->query($query1);
       $session->msg('s',"pengajuan added ");
       if($user['user_level']==2){
        redirect('pengajuan_pum_ben.php', false);
       }else{
       redirect('pengajuan_pum_ben.php', false);
       }
     } else {
       $session->msg('d',' Sorry failed to added!');
       if($user['user_level']==2){
        redirect('pengajuan_pum_ben.php', false);
      }else{
         redirect('pengajuan_pum_ben.php', false);
      }
     }

   } else{
     $session->msg("d", $errors);
     redirect('pengajuan_pum_ben.php',false);
   }

 }

 



 if(isset($_POST['update_nodin'])){
  $req_fields = array('id_jenis','tanggal','tahun','id');
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id']));
    $id_jenis   = remove_junk($db->escape($_POST['id_jenis']));
    $tanggal   = remove_junk($db->escape($_POST['tanggal']));
    $id_satker = remove_junk($db->escape($_POST['id_satker']));
    $tahun = remove_junk($db->escape($_POST['tahun']));
    $no_nodin = remove_junk($db->escape($_POST['no_nodin']));
    $user_id   = remove_junk($db->escape($_SESSION['user_id']));
    $date    = make_date();
    $query  = "UPDATE pengajuan_pum SET ";
    $query .=" tanggal= '{$tanggal}',jenis_pengajuan='{$id_jenis}',tahun='{$tahun}',no='{$no_nodin}'";
    $query .=" WHERE id='{$id}'";
    //var_dump($query);exit();
 
    if($db->query($query)){
      $session->msg('s',"Nodin Updated ");
      if($user['user_level']==2){
       redirect('pengajuan_UP.php', false);
      }else{
      redirect('pengajuan_UP.php', false);
      }
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      if($user['user_level']==2){
       redirect('pengajuan_UP.php', false);
     }else{
        redirect('pengajuan_UP.php', false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('pengajuan_UP.php',false);
  }

}


if($_GET['p']=='update'){

    $id   = remove_junk($db->escape($_GET['id']));
  
    $query  = "UPDATE nodin SET ";
    $query .=" status_pengajuan= 1";
    $query .=" WHERE id='{$id}'";
  //echo $query;exit();
  	
    if($db->query($query)){
      $session->msg('s',"Telah di ajukan ke bagian keuangan ");
     // ini_set( 'display_errors', 1 );   
   // error_reporting( E_ALL );    
    $from = $user['email'];    
    $to = "bayukominfo20@gmail.com";    
    $subject = "Pengajuan SPM ".$satker[0]['keterangan'];    
    $message = "pengajuan SPM";   
    $headers = "From:" . $from;    
    mail($to,$subject,$message, $headers);    
    echo "Pesan email sudah terkirim.";
      if($user['user_level']==2){
       redirect('nodin_bpp.php', false);
      }else{
      redirect('nodin_bpp.php', false);
      }
    } else {
      $session->msg('d',' Sorry failed to Pengajuan!');
      if($user['user_level']==2){
       redirect('nodin_bpp.php', false);
     }else{
        redirect('nodin_bpp.php', false);
     }
    }

}

if($_GET['p']=='update_approval'){

  $id   = remove_junk($db->escape($_GET['id']));

  $query  = "UPDATE pengajuan_pum SET ";
  $query .=" 	status= 2";
  $query .=" WHERE id='{$id}'";
  
  if($db->query($query)){
    $session->msg('s',"Telah di ajukan ke bagian keuangan ");

  // $from = $user['email'];    
  // $to = "bayukominfo20@gmail.com";    
  // $subject = "Pengajuan SPM ".$satker[0]['keterangan'];    
  // $message = "pengajuan SPM";   
  // $headers = "From:" . $from;    
  // mail($to,$subject,$message, $headers);    
  // echo "Pesan email sudah terkirim.";
    if($user['user_level']==2){
     redirect('pengajuan_UP.php', false);
    }else{
    redirect('pengajuan_UP.php', false);
    }
  } else {
    $session->msg('d',' Sorry failed to Pengajuan!');
    if($user['user_level']==2){
     redirect('pengajuan_UP.php', false);
   }else{
      redirect('pengajuan_UP.php', false);
   }
  }

}

if($_GET['p']=='batal'){

  $id   = remove_junk($db->escape($_GET['id']));

  $query  = "UPDATE nodin SET ";
  $query .=" status_pengajuan= 0";
  $query .=" WHERE id='{$id}'";
//echo $query;exit();
  if($db->query($query)){
    $session->msg('s',"Telah di berhasil di batalkan  ");
    if($user['user_level']==2){
     redirect('nodin_bpp.php', false);
    }else{
    redirect('nodin_bpp.php', false);
    }
  } else {
    $session->msg('d',' Sorry failed to Pengajuan!');
    if($user['user_level']==2){
     redirect('nodin_bpp.php', false);
   }else{
      redirect('nodin_bpp.php', false);
   }
  }

}

 ?>

<?php

if($_GET['status']=='delete_nodin'){
  $d_sale = find_by_id('pengajuan_pum',(int)$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$d_sale){
    $session->msg("d","Missing nodin id.");
      if($user['user_level']==2){
              redirect('pengajuan_UP.php', false);
          }else{
    redirect('pengajuan_UP.php');
        }
  }
?>
<?php
  $delete_id = delete_by_id('pengajuan_pum',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","nodin deleted.");
      if($user['user_level']==2){
              redirect('pengajuan_UP.php', false);
          }else{
      redirect('pengajuan_UP.php');
        }
  } else {
      $session->msg("d","nodin deletion failed.");
          if($user['user_level']==2){
              redirect('pengajuan_UP.php', false);
          }else{
      redirect('pengajuan_UP.php');
          }
  }
}
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span><a href="pengajuan_pum_ben.php">All Pengajuan</a></span>
          </strong>
          <div class="pull-right">
          
          </div>
        </div>
        <div class="panel-body" style="width:100%"> 
          <table id="tabel" class="table table-primary table-bordered table-striped table-dark table-hover " style="width:100%">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center" > Tanggal</th>
                <th class="text-center" > Jenis </th>
                <th class="text-center" >Nomor Nodin </th>
                <th class="text-center"> Cetak Nodin </th>
                <th class="text-center"> Status Pengajuan </th>               
                <th class="text-center"> Actions </th>
             </tr>
            </thead>
           <tbody >
             <?php foreach ($sales as $sale):?>
             <tr >
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo $sale['tanggal']; ?></td>
               <td class="text-center"><?php echo $sale['jenis_pengajuan'];  ?></td>
               <td class="text-center"><?php echo $sale['no']; ?></td>

                <td class="text-center">
                <a href="cetakNP.php?id=<?=$sale['id']?>" class="btn btn-primary" target="_BLANK"><span class="glyphicon glyphicon-print"></span></a>
                </td>
                <td class="text-center">

                <?php if($sale['status_pencairan'] == 1){
                                $pengajuan = find_all_global('pengajuan_pum',$sale['id'],'id'); 
                        ?>
                        <a class="btn btn-success" disabled>Sudah Diproses</a>
                      <?php }else if($sale['status_pencairan'] == 0){?>
                        <a onclick="add_panjar(<?php echo $sale['id_satker']?>,'<?php echo $sale['jenis_pengajuan']?>',<?php echo $sale['id']?>);" class="btn btn-warning" >Proses</a>
                      <?php } ?>
                
                </td>
                <td class="text-center">
                      <div class="btn-group">                    
                      </div>
                  </td>
              </tr>

            
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal Detail ADD Panjar-->
<div class="modal fade" id="form_panjar" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:50vw">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Panjar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="Body_input" style="width:100%;">
      
    </div>
    </div>
  </div>
</div>



<?php include_once('layouts/footer.php'); ?>
