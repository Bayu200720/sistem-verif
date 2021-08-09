<?php
  $page_title = 'All Nodin';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);
?>
<?php
$user=find_by_id('users',$_SESSION['user_id']);
$satker = find_all_global('satker',$user['id_satker'],'id');
$sales = find_all_global_tahun('nodin',$user['id_satker'],'id_satker',$satker[0]['tahun']);
$pengajuan = find_nodin_j_pengajuan_count($satker[0]['tahun'],$user['id_satker']);//var_dump($pengajuan);exit();


?>
<?php


 if(isset($_POST['submit_nodin'])){
   $req_fields = array('id_jenis','tanggal','id_satker','p_pengajuan');
   validate_fields($req_fields);
   if(empty($errors)){
     $id_jenis   = remove_junk($db->escape($_POST['id_jenis']));
     $tanggal   = remove_junk($db->escape($_POST['tanggal']));
     $id_satker = remove_junk($db->escape($_POST['id_satker']));
     $p_pengajuan = remove_junk($db->escape($_POST['p_pengajuan']));
     $no_nodin = remove_junk($db->escape($_POST['no_nodin']));
     $user_id   = remove_junk($db->escape($_SESSION['user_id']));
     $date    = make_date();
     $tahun = $satker[0]['tahun'];
     $query  = "INSERT INTO nodin (";
     $query .=" tanggal,id_user,id_jenis,id_satker,p_pengajuan,no_nodin,tahun";
     $query .=") VALUES (";
     $query .=" '{$tanggal}','{$user_id}','{$id_jenis}','{$id_satker}','{$p_pengajuan}','{$no_nodin}','{$tahun}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"Nodin added ");
       if($user['user_level']==2){
        redirect('nodin_bpp.php', false);
       }else{
       redirect('nodin_bpp.php', false);
       }
     } else {
       $session->msg('d',' Sorry failed to added!');
       if($user['user_level']==2){
        redirect('nodin_bpp.php', false);
      }else{
         redirect('nodin_bpp.php', false);
      }
     }

   } else{
     $session->msg("d", $errors);
     redirect('nodin_bpp.php',false);
   }

 }

 



 if(isset($_POST['update_nodin'])){
  $req_fields = array('id_jenis','tanggal','p_pengajuan','id');
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id']));
    $id_jenis   = remove_junk($db->escape($_POST['id_jenis']));
    $tanggal   = remove_junk($db->escape($_POST['tanggal']));
    $id_satker = remove_junk($db->escape($_POST['id_satker']));
    $p_pengajuan = remove_junk($db->escape($_POST['p_pengajuan']));
    $no_nodin = remove_junk($db->escape($_POST['no_nodin']));
    $user_id   = remove_junk($db->escape($_SESSION['user_id']));
    $date    = make_date();
    $query  = "UPDATE nodin SET ";
    $query .=" tanggal= '{$tanggal}',id_user='{$user_id}',id_jenis='{$id_jenis}',p_pengajuan='{$p_pengajuan}',no_nodin='{$no_nodin}'";
    $query .=" WHERE id='{$id}'";
 
    if($db->query($query)){
      $session->msg('s',"Nodin Updated ");
      if($user['user_level']==2){
       redirect('nodin_bpp.php', false);
      }else{
      redirect('nodin_bpp.php', false);
      }
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      if($user['user_level']==2){
       redirect('nodin_bpp.php', false);
     }else{
        redirect('nodin_bpp.php', false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('nodin_bpp.php',false);
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

  $query  = "UPDATE nodin SET ";
  $query .=" 	approvel_atasan= 2";
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
  $d_sale = find_by_id('nodin',(int)$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$d_sale){
    $session->msg("d","Missing nodin id.");
      if($user['user_level']==2){
              redirect('nodin_bpp.php', false);
          }else{
    redirect('nodin_bpp.php');
        }
  }
?>
<?php
  $delete_id = delete_by_id('nodin',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","nodin deleted.");
      if($user['user_level']==2){
              redirect('nodin_bpp.php', false);
          }else{
      redirect('nodin_bpp.php');
        }
  } else {
      $session->msg("d","nodin deletion failed.");
          if($user['user_level']==2){
              redirect('nodin_bpp.php', false);
          }else{
      redirect('nodin_bpp.php');
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
            <span><a href="nodin_bpp.php">All Nodin</a></span>
          </strong>
          <div class="pull-right">
          <a href="allSPM.php" class="btn btn-primary" id="nodin"></span>ALL SPM</a>
            <?php if($pengajuan[0]['status'] == 0){?>
        		  <a href="#" onclick="showT('DT_p')" class="btn btn-primary" id="nodin"><span class="glyphicon glyphicon-plus"></span>ADD</a>
            <?php }else{ ?>
                  <span class="btn btn-danger glyphicon glyphicon-warning-sign">upload pertanggungjawaban terlebih dahulu</span>
            <?php } ?>
          </div>
        </div>
        <div class="panel-body" style="width:100%"> 
          <table id="tabel" class="table table-primary table-bordered table-striped table-dark table-hover " style="width:100%">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center" > Tanggal</th>
                <th class="text-center" > Jenis </th>
                <th class="text-center" > Pegawai Pengajuan </th>
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
               <td class="text-center"><?php $jenis = find_by_id('jenis',$sale['id_jenis']); echo $jenis['keterangan'];  ?></td>
        
               <td class="text-center"><?php echo $sale['p_pengajuan']; ?></td>
               <td class="text-center"><?php echo $sale['no_nodin']; ?></td>

                <td class="text-center">
                <a href="cetakNodin.php?id=<?=$sale['id']?>" class="btn btn-primary" target="_BLANK"><span class="glyphicon glyphicon-print"></span></a>
                </td>
                <td class="text-center">

                <?php if($sale['approvel_atasan'] == 1){
                                $pengajuan = find_all_global('pengajuan',$sale['id'],'id_nodin'); 
                        ?>
                        <a class="btn btn-success" disabled>Sudah Diapprovel</a>
                      <?php }else if($sale['approvel_atasan'] == 2){?>
                        <a href="nodin_bpp.php?id=<?=$sale['id']?>&key=ajukan&p=update_approval" class="btn btn-warning" disabled>Menunggu Approval</a>
                      <?php }else{ $sp1= find_nodin_j_pengajuan_j_dt_count($satker[0]['tahun'],$user['id_satker'],$sale['id']); ?>
                        <a onclick="return confirm('Apakah Anda Yakin ingin mengajuan Approval?')" href="nodin_bpp.php?id=<?=$sale['id']?>&key=ajukan&p=update_approval" class="btn btn-primary" <?php if($sp1[0]['status'] == 0){ echo 'disabled';}?>>Ajukan Approval</a>
                  <?php } ?>




                      <?php $sp= find_nodin_j_pengajuan_j_dt_count($satker[0]['tahun'],$user['id_satker'],$sale['id']); 
							if($sp[0]['status'] == 0){ 
 							 echo "<span class='btn btn-danger'>isi detail transaksi dulu</span>";}else{?>
                      
                  <?php }?>
                
                </td>
              

                <td class="text-center">
                      <div class="btn-group">
                      <a onclick="Tampil(<?=$sale['id'];?>)" class="btn btn-success btn-xs"  title="Detail nodin">
                          <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
                        <?php if($sale['approvel_atasan'] != 1){ ?>
                        
                        <a href="#" title="Edit" <?php $nodin = find_by_id('nodin',$sale['id']);?> class="btn btn-warning btn-xs" id="editnodin" data-toggle="modal"  title="Edit nodin"
                        data-target="#UpdateNodinPengajuan" data-id='<?=$nodin['id'] ?>' data-tanggal='<?=$nodin['tanggal'];?>' data-pp='<?=$nodin['p_pengajuan'];?>' data-no_nodin='<?=$nodin['no_nodin'];?>'>
                        <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <?php } ?>
                        <a href="pengajuan_bpp.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail nodin" data-toggle="tooltip">
                          <span class="glyphicon glyphicon-eye-open"></span>
                        </a>

                        <?php $pengj = count_by_id_nodin('pengajuan',$sale['id']); if($pengj['total'] < 1 ){ ?>  
                        <a onclick="return confirm('Yakin Hapus?')" href="nodin_bpp.php?id=<?php echo (int)$sale['id'];?>&status=delete_nodin" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>

                       
                        <?php } ?>
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




     <!-- Modal Detail Pengajuan-->
<div class="modal fade" id="Detail_Nodin" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:90vw">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Nodin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="Body_dp" style="width:100%;">
      
    </div>
    </div>
  </div>
</div>


  
       <!-- Modal input nodin-->
  <div class="modal fade" id="DT_p" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengajuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="detail_p.php?status=ada" method="POST">
      <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">SPM</label>
              <input type="text" class="form-control" id="spm" name="spm" placeholder="SPM">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Pengajuan</label>
                      <select class="form-control" id="jenis" name="id_jenis_pengajuan">
                            <option value="">Pilih Jenis Pengajuan</option>
                            <?php $jenis = find_all('jenis_pengajuan');?>
                          <?php  foreach ($jenis as $j): ?>
                            <option value="<?php echo (int)$j['id'] ?>">
                              <?php echo $j['keterangan'] ?></option>
                          <?php endforeach; ?>
                      </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" onclick="simpan_dp()" name="add_pengajuan" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>






   <!-- Modal input nodin-->
<div class="modal fade" id="NodinPengajuan" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Nodin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="nodin_bpp.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Tanggal</label>
        <input type="date" class="form-control" id="nodin" name="tanggal" placeholder="tanggal" required> 
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Nomor Nodin</label>
        <input type="text" class="form-control" id="no_nodinn" name="no_nodin" placeholder="Nomor Nodin">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Pegawai Pengajuan</label>
        <input type="text" class="form-control" id="nodin" name="p_pengajuan" placeholder="Pegawai Pengajuan" required>
        <input type="hidden" class="form-control" id="id" value="<?php $users=find_by_id('users',$_SESSION['user_id']);echo $users['id_satker'] ;?>" name="id_satker" >
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Jenis Pengajuan</label>
                <select class="form-control" name="id_jenis" required>
                      <option value="">Pilih Jenis Pengajuan</option>
                      <?php $jenis = find_all('jenis');?>
                    <?php  foreach ($jenis as $j): ?>
                      <option value="<?php echo (int)$j['id'] ?>">
                        <?php echo $j['keterangan'] ?></option>
                    <?php endforeach; ?>
                </select>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit_nodin" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>



 <!-- Modal Edit nodin-->
 <div class="modal fade" id="UpdateNodinPengajuan" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Nodin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="nodin_bpp.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal" required>
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Nomor Nodin</label>
        <input type="text" class="form-control" id="no_nodin" name="no_nodin" placeholder="Nomor Nodin" required>
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Pegawai Pengajuan</label>
        <input type="text" class="form-control" id="pp" name="p_pengajuan" placeholder="Pegawai Pengajuan" required>
        <input type="hidden" class="form-control" id="id" name="id" >
        <input type="hidden" class="form-control" id="id_user" value="<?php $users=find_by_id('users',$_SESSION['user_id']);echo $users['id_satker'] ;?>" name="id_satker" >
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Jenis Pengajuan</label>
                <select class="form-control" name="id_jenis" required>
                      <option value="">Pilih Jenis Pengajuan</option>
                      <?php $jenis = find_all('jenis');?>
                    <?php  foreach ($jenis as $j): ?>
                      <option value="<?php echo (int)$j['id'] ?>">
                        <?php echo $j['keterangan'] ?></option>
                    <?php endforeach; ?>
                </select>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update_nodin" value="Update">
      </div>
      </form>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
