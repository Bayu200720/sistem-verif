<?php
  $page_title = 'All Nodin';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  if($user['user_level'] == 3){ 
    page_require_level(3);
  }else if($user['user_level'] == 8){
    page_require_level(8);
  }else if($user['user_level'] == 6){
    page_require_level(6);
  } 
?>
<?php
$user=find_by_id('users',$_SESSION['user_id']);
$sales = find_all_global('pengajuan',$_GET['id'],'id');
$idi= $_GET['id'];

if(isset($_GET['s']) and $_GET['s']==='hapus_adk'){
    $query  = "UPDATE pengajuan SET ";
    $query .= "upload_adk=''";
    $query .= "WHERE id='{$idi}'";
   // echo $query; exit();
    $result = $db->query($query);
    $session->msg('s',' Berhasil di Batalkan');
    if($user['user_level']==5){
  redirect('detail_dokumen.php?id='.$idi);
  }else{
  redirect('detail_dokumen.php?id='.$idi, false);
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
            <span>Detail Dokumen</span>
          </strong>
          <div class="pull-right">
                <a href="pengajuan_bpp.php?id=<?=$sales[0]['id_nodin'] ?>" class="btn btn-warning">Back</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
               
                <th class="text-center" style="width: 15%;"> Upload Dokumen Pengajuan</th>
                <th class="text-center" style="width: 15%;"> ADK SPP </th>
                <th class="text-center" style="width: 15%;"> SPM yang Telah di Proses</th>
                <th class="text-center" style="width: 15%;"> Dokumen SP2D</th>
                <th class="text-center" style="width: 15%;"> SP2D</th>
                <th class="text-center" style="width: 15%;"> Upload Dokumen Pertanggungjawaban</th>
             
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
                   
                     <td class="text-center">
                        <?php if($sale['upload']==''){?><a href="media.php?id=<?=$sale['id']?>" class="btn btn-primary">Upload</a><?php }else{?>
                             <a href="uploads/products/<?=$sale['upload']?>" class="btn btn-success" target="_blank">Preview</a>
                            <a href="batal_upload.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal</a>
                        <?php } ?>
                    </td>

                    <td class="text-center"><?php if($sale['upload_adk']==''){?><a href="media_adk.php?id=<?=$sale['id']?>" class="btn btn-primary">Upload</a><?php }else{?>
                             <a href="uploads/adk/<?=$sale['upload_adk']?>" class="btn btn-success" target="_blank">Download</a>
                            <a href="detail_dokumen.php?id=<?=$sale['id']?>&s=hapus_adk" class="btn btn-danger">Hapus</a>
                         <?php } ?>
                    </td>
                    <td class="text-center">
                         <?php if($sale['file_spm']!=''){?><a href="uploads/spm/<?=$sale['file_spm']?>" class="btn btn-success" target="_blank">Preview</a><?php } ?>
                    </td>
                    <td class="text-center">
                          <?php if($sale['file_sp2d']!=''){?><a href="uploads/sp2d/<?=$sale['file_sp2d']?>" class="btn btn-success" target="_blank">Preview</a><?php } ?>
                    </td>
                    <td class="text-center">
                          <?php echo $sale['sp2d']?>
                    </td>

                    <td class="text-center"><?php if($sale['upload_pertanggungjawaban']==''){?><a href="media_pertanggungjawaban.php?id=<?=$sale['id']?>" class="btn btn-primary">Upload</a><?php }else{?>
                             <a href="uploads/pertanggungjawaban/<?=$sale['upload_pertanggungjawaban']?>" class="btn btn-success" target="_blank">Preview</a>
                               <a href="batal_uploadPj.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal</a>
                             <?php } ?>
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
      <form action="nodin_bpp.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Tanggal</label>
        <input type="date" class="form-control" id="nodin" name="tanggal" placeholder="tanggal">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Nomor Nodin</label>
        <input type="text" class="form-control" id="no_nodinn" name="no_nodin" placeholder="Nomor Nodin">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Pegawai Pengajuan</label>
        <input type="text" class="form-control" id="nodin" name="p_pengajuan" placeholder="Pegawai Pengajuan">
        <input type="hidden" class="form-control" id="id" value="<?php $users=find_by_id('users',$_SESSION['user_id']);echo $users['id_satker'] ;?>" name="id_satker" >
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
      <form action="nodin_bpp.php" method="POST">
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
        <input type="hidden" class="form-control" id="id_user" value="<?php $users=find_by_id('users',$_SESSION['user_id']);echo $users['id_satker'] ;?>" name="id_satker" >
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
