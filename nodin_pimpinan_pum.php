<?php
  $page_title = 'All Nodin';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(8);
?>
<?php
$user=find_by_id('users',$_SESSION['user_id']);
$satker = find_all_global('satker',$user['id_satker'],'id');
$sales = find_all_global_tahun('pengajuan_pum',$user['id_satker'],'id_satker',$satker[0]['tahun']);
$pengajuan = find_nodin_j_pengajuan_count($satker[0]['tahun'],$user['id_satker']);


?>
<?php

if($_GET['p']=='update'){

    $id   = remove_junk($db->escape($_GET['id']));
  
    $query  = "UPDATE pengajuan_pum SET ";
    $query .=" status= 1";
    $query .=" WHERE id='{$id}'";
  //echo $query;exit();
  	
    if($db->query($query)){

      $session->msg('s',"Telah di Approvel ");
   
      if($user['user_level']==8){
       redirect('nodin_pimpinan_pum.php', false);
      }else{
      redirect('nodin_pimpinan_pum.php', false);
      }
    } else {
      $session->msg('d',' Sorry failed to Pengajuan!');
      if($user['user_level']==8){
       redirect('nodin_pimpinan_pum.php', false);
     }else{
        redirect('nodin_pimpinan_pum.php', false);
     }
    }

}


if($_GET['p']=='batal'){

  $id   = remove_junk($db->escape($_GET['id']));

  $query  = "UPDATE pengajuan_pum SET ";
  $query .=" status= 0";
  $query .=" WHERE id='{$id}'";
  if($db->query($query)){
    $session->msg('s',"Berhasil di batalkan  ");
    if($user['user_level']==8){
     redirect('nodin_pimpinan_pum.php', false);
    }else{
    redirect('nodin_pimpinan_pum.php', false);
    }
  } else {
    $session->msg('d',' Sorry failed to Pengajuan!');
    if($user['user_level']==8){
     redirect('nodin_pimpinan_pum.php', false);
   }else{
      redirect('nodin_pimpinan_pum.php', false);
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
            <span><a href="nodin_pimpinan_pum.php">All Nodin Pengajuan UP</a></span>
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
                <th class="text-center" >Nomor Nodin </th>
                <th class="text-center"> Cetak Nodin </th>  
                <th class="text-center"> Status Pengajuan</th>             
                <th class="text-center"> Actions </th>
             </tr>
            </thead>
           <tbody >
             <?php foreach ($sales as $sale):?>
             <tr >
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo $sale['tanggal']; ?></td>
               <td class="text-center"><?php echo $sale['jenis_pengajuan']?></td>
               <td class="text-center"><?php echo $sale['no']; ?></td>
                <td class="text-center">
                <a href="cetakNP.php?id=<?=$sale['id']?>" class="btn btn-primary" target="_BLANK"><span class="glyphicon glyphicon-print"></span></a>
                </td>
                <td class="text-center">
           
                      <?php if($sale['status'] == 1){
                                $pengajuan = find_all_global('pengajuan_pum',$sale['id'],'id'); 
                        ?>
                        <a onclick="return confirm('Apakah anda yakin untuk membatalkan Approvel?');" href="nodin_pimpinan_pum.php?id=<?=$sale['id']?>&key=ajukan&p=batal" class="btn btn-success" <?php if($pengajuan[0]['status'] == 0){?> disabled <?php } ?>>Sudah Diapprovel</a>
                      <?php }else if($sale['status'] == 2){ ?>
                        <a onclick="return confirm('Apakah anda yakin untuk Approvel?');" href="nodin_pimpinan_pum.php?id=<?=$sale['id']?>&key=ajukan&p=update" class="btn btn-primary">Approvl</a>
                      <?php } ?>
                
                </td>
              

                <td class="text-center">
                      <div class="btn-group">
                        <a href="detail_pengajuan_nodin_pum.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail nodin" data-toggle="tooltip">
                          <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
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
