<?php
  $page_title = 'All Nodin';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sales = find_all('nodin');
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
     $query  = "INSERT INTO nodin (";
     $query .=" tanggal,id_user,id_jenis,id_satker,p_pengajuan,no_nodin";
     $query .=") VALUES (";
     $query .=" '{$tanggal}','{$user_id}','{$id_jenis}','{$id_satker}','{$p_pengajuan}','{$no_nodin}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"Nodin added ");
       if($user['user_level']==2){
        redirect('nodin.php', false);
       }else{
       redirect('nodin.php', false);
       }
     } else {
       $session->msg('d',' Sorry failed to added!');
       if($user['user_level']==2){
        redirect('nodin.php', false);
      }else{
         redirect('nodin.php', false);
      }
     }

   } else{
     $session->msg("d", $errors);
     redirect('nodin.php',false);
   }

 }

 if(isset($_POST['update_nodin'])){
  $req_fields = array('id_jenis','tanggal','id_satker','p_pengajuan','id');
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
       redirect('nodin.php', false);
      }else{
      redirect('nodin.php', false);
      }
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      if($user['user_level']==2){
       redirect('nodin.php', false);
     }else{
        redirect('nodin.php', false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('nodin.php',false);
  }

}

 ?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>All Nodin</span>
          </strong>
          <div class="pull-right">
          <a href="#" class="btn btn-primary" id="nodin" data-toggle="modal" data-target="#NodinPengajuan"><span class="glyphicon glyphicon-plus">ADD</span></a>
          </div>
        </div>
        <div class="panel-body" width="100%">
          <table id="tabel" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 15%;"> Tanggal</th>
                <th class="text-center" style="width: 15%;"> Jenis </th>
                <th class="text-center" style="width: 15%;"> Satker </th> 
                <th class="text-center" style="width: 15%;"> Pegawai Pengajuan </th>
                <th class="text-center" style="width: 15%;">Nomor Nodin </th>
                <th class="text-center" style="width: 100px;"> Cetak Nodin </th>              
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo $sale['tanggal']; ?></td>
               <td class="text-center"><?php $jenis = find_by_id('jenis',$sale['id_jenis']); echo $jenis['keterangan'];  ?></td>
               <td class="text-center"><?php $jenis = find_by_id('satker',$sale['id_satker']); echo $jenis['keterangan'];  ?></td>
               <td class="text-center"><?php echo $sale['p_pengajuan']; ?></td>
               <td class="text-center"><?php echo $sale['no_nodin']; ?></td>

            <td class="text-center">
             <a href="cetakNodin.php?id=<?=$sale['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>
            </td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="#"   class=""   >
                       
                     </a>
                     <a href="#" title="Edit" <?php $nodin = find_by_id('nodin',$sale['id']);?> class="btn btn-warning btn-xs" id="editnodin" data-toggle="modal" 
                     data-target="#UpdateNodinPengajuan" data-id='<?=$nodin['id'];?>' data-tanggal='<?=$nodin['tanggal'];?>' data-pp='<?=$nodin['p_pengajuan'];?>' data-no_nodin='<?=$nodin['no_nodin'];?>'>
                     <span class="glyphicon glyphicon-pencil"></span>
                     </a>
                     <a href="pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail nodin" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-eye-open"></span>
                     </a>
                     <a onclick="return confirm('Yakin Hapus?')" href="delete_nodin.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
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
      <form action="nodin.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Tanggal</label>
        <input type="date" class="form-control" id="nodin" name="tanggal" placeholder="tanggal">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Nomor Nodin</label>
        <input type="text" class="form-control" id="no_nodin" name="no_nodin" placeholder="Nomor Nodin">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Pegawai Pengajuan</label>
        <input type="text" class="form-control" id="nodin" name="p_pengajuan" placeholder="Pegawai Pengajuan">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Satker</label>
                <select class="form-control" name="id_satker">
                      <option value="">Pilih Satker</option>
                      <?php $satker = find_all('satker');?>
                    <?php  foreach ($satker as $sat): ?>
                      <option value="<?php echo (int)$sat['id'] ?>">
                        <?php echo $sat['keterangan'] ?></option>
                    <?php endforeach; ?>
                </select>
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Jenis Pengajuan</label>
                <select class="form-control" name="id_jenis">
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
      <form action="nodin.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Nomor Nodin</label>
        <input type="text" class="form-control" id="no_nodin" name="no_nodin" placeholder="Nomor Nodin">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Pegawai Pengajuan</label>
        <input type="text" class="form-control" id="pp" name="p_pengajuan" placeholder="Pegawai Pengajuan">
        <input type="hidden" class="form-control" id="id" name="id" >
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Satker</label>
                <select class="form-control" name="id_satker">
                      <option value="">Pilih Satker</option>
                      <?php $satker = find_all('satker');?>
                    <?php  foreach ($satker as $sat): ?>
                      <option value="<?php echo (int)$sat['id'] ?>">
                        <?php echo $sat['keterangan'] ?></option>
                    <?php endforeach; ?>
                </select>
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Jenis Pengajuan</label>
                <select class="form-control" name="id_jenis">
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
