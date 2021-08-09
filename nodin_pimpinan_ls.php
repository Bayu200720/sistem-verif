<?php
  $page_title = 'All Nodin';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(8);
?>
<?php
$user=find_by_id('users',$_SESSION['user_id']);
$satker = find_all_global('satker',$user['id_satker'],'id');
$sales = find_all_global_tahun_pum('nodin',$satker[0]['tahun']);
$pengajuan = find_nodin_j_pengajuan_count($satker[0]['tahun'],$user['id_satker']);

if(isset($_POST['nodin'])){
    $req_fields = array('no_nodin');
    $id = remove_junk($db->escape($_POST['id']));
    $no_nodin = remove_junk($db->escape($_POST['no_nodin']));
    validate_fields($req_fields);
    if(empty($errors)){
      $id   = remove_junk($db->escape($_POST['id']));
      
      $query  = "UPDATE nodin SET ";
      $query .=" no_nodin= '{$no_nodin}'";
      $query .=" WHERE id='{$id}'";
      //var_dump($query);exit();
      if($db->query($query)){
        $session->msg('s',"Konfirmasi Updated ");
        if($user['user_level']==2){
         redirect('nodin_pimpinan_ls.php?id='.$_GET['id'], false);
        }else{
        redirect('nodin_pimpinan_ls.php?id='.$_GET['id'], false);
        }
      } else {
        $session->msg('d',' Sorry failed to Updated!');
        if($user['user_level']==2){
         redirect('nodin_pimpinan_ls.php?id='.$_GET['id'], false);
       }else{
          redirect('nodin_pimpinan_ls.php?id='.$_GET['id'], false);
       }
      }
  
    } else{
      $session->msg("d", $errors);
      redirect('nodin_pimpinan_ls.php?id='.$_GET['id'],false);
    }
  
  }


?>
<?php

if($_GET['p']=='update'){
    $id   = remove_junk($db->escape($_GET['id']));

    $query  = "UPDATE nodin SET ";
    $query .=" approvel_atasan= 1";
    $query .=" WHERE id='{$id}'";
  //echo $query;exit();
  	
    if($db->query($query)){

        $query1  = "UPDATE nodin SET ";
        $query1 .=" status_pengajuan= 1";
        $query1 .=" WHERE id='{$id}'"; 

        $db->query($query1);
        $from = $user['email'];    
        $to = "bayukominfo20@gmail.com";    
        $subject = "Pengajuan SPM ".$satker[0]['keterangan'];    
        $message = "pengajuan SPM";   
        $headers = "From:" . $from;    
        mail($to,$subject,$message, $headers);    
        echo "Pesan email sudah terkirim.";

      $session->msg('s',"Telah di Approvel ");
    
      if($user['user_level']==8){
       redirect('nodin_pimpinan_ls.php', false);
      }else{
      redirect('nodin_pimpinan_ls.php', false);
      }
    } else {
      $session->msg('d',' Sorry failed to Pengajuan!');
      if($user['user_level']==8){
       redirect('nodin_pimpinan_ls.php', false);
     }else{
        redirect('nodin_pimpinan_ls.php', false);
     }
    }

}


if($_GET['p']=='batal'){

  $id   = remove_junk($db->escape($_GET['id']));

//   $query  = "UPDATE nodin SET ";
//   $query .=" approvel_atasan= 0";
//   $query .=" WHERE id='{$id}'";
  if($db->query($query)){
    $query1  = "UPDATE nodin SET ";
    $query1 .=" status_pengajuan= 2";
    $query1 .=" WHERE id='{$id}'";
    $db->query($query1);
    $session->msg('s',"Berhasil di batalkan  ");
    if($user['user_level']==8){
     redirect('nodin_pimpinan_ls.php', false);
    }else{
    redirect('nodin_pimpinan_ls.php', false);
    }
  } else {
    $session->msg('d',' Sorry failed to Pengajuan!');
    if($user['user_level']==8){
     redirect('nodin_pimpinan_ls.php', false);
   }else{
      redirect('nodin_pimpinan_ls.php', false);
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
            <span><a href="nodin_pimpinan_ls.php">All Nodin</a></span>
          </strong>
          <div class="pull-right">
          <a href="allSPM.php" class="btn btn-primary" id="nodin"></span>ALL SPM</a>
            <?php if($pengajuan[0]['status'] == 0){?>
        		 
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
               <td class="text-center">
               <a href="#" class="btn btn-primary" id="UploadSPM" data-toggle="modal" data-target="#uploadSPM" data-id='<?=$sale['id'];?>'><?php echo $sale['no_nodin']; ?></a> 
               </td>

                <td class="text-center">
                <a href="cetakNodinSes.php?id=<?=$sale['id']?>" class="btn btn-primary" target="_BLANK"><span class="glyphicon glyphicon-print"></span></a>
                </td>
                <td class="text-center">
           
                      <?php if($sale['status_pengajuan'] == 1){
                                $pengajuan = find_all_global('nodin',$sale['id'],'id'); 
                        ?>
                        <a onclick="return confirm('Apakah anda yakin untuk membatalkan Approvel?');" href="nodin_pimpinan_ls.php?id=<?=$sale['id']?>&key=ajukan&p=batal" class="btn btn-success" <?php if($pengajuan[0]['status_verifikasi'] != 0){?> disabled <?php } ?>>Sudah Diapprovel</a>
                      <?php }else if($sale['status_pengajuan'] == 2){ ?>
                        <a onclick="return confirm('Apakah anda yakin untuk Approvel?');" href="nodin_pimpinan_ls.php?id=<?=$sale['id']?>&key=ajukan&p=update" class="btn btn-primary">Approvel</a>
                      <?php } ?>
                
                </td>
              

                <td class="text-center">
                      <div class="btn-group">
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


<!-- Modal edit no nodin-->
 <div class="modal fade" id="uploadSPM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan no nodin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">No Nodin</label>
        <input type="number" class="form-control" id="no_nodin" name="no_nodin" placeholder="NO Nodin">
        <input type="hidden" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="nodin" value="Save">
      </div>
      </form>
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
