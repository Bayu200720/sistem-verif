<?php
  $page_title = 'Edit Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(6);
  $all_categories = find_all('jenis');
  $satker = find_all('satker');
  $pengajuan = find_by_id('pengajuan',$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
?>
<?php
 if(isset($_POST['update_pengajuan'])){
   $req_fields = array('spm','id_jenis_pengajuan');
   validate_fields($req_fields);
   if(empty($errors)){
     $spm  = remove_junk($db->escape($_POST['spm']));
     $id_jenis   = remove_junk($db->escape($_POST['id_jenis']));
     $tanggal   = remove_junk($db->escape($_POST['tanggal']));
     $id_satker = remove_junk($db->escape($_POST['id_satker']));
     $p_pengajuan = remove_junk($db->escape($_POST['p_pengajuan']));
     $user_id   = remove_junk($db->escape($_SESSION['user_id']));
     $id_jenis_pengajuan = remove_junk($db->escape($_POST['id_jenis_pengajuan']));
     $id_jenis_bendahara = remove_junk($db->escape($_POST['id_jenis_bendahara']));
     $date    = make_date();
     $query  = "UPDATE pengajuan SET";
     $query .=" SPM='{$spm}',id_jenis_pengajuan='{$id_jenis_pengajuan}', id_jenis_bendahara=$id_jenis_bendahara ";
     $query .= " WHERE id ='{$_GET['id']}'";
     if($db->query($query)){
       $session->msg('s',"Pengajuan berhasil di edit ");
       if($user['user_level']==2){
        redirect('pengajuan_bpp.php?id='.$pengajuan['id_nodin'], false);
      }else{
       redirect('pengajuan_bpp.php?id='.$pengajuan['id_nodin'], false);
      }
     } else {
       $session->msg('d',' Sorry failed to edit!');
          if($user['user_level']==2){
              redirect('pengajuan_bpp.php?id='.$pengajuan['id_nodin'], false);
          }else{
            redirect('pengajuan_bpp.php?id='.$pengajuan['id_nodin'], false);
          }
    }

   } else{
     $session->msg("d", $errors);
        if($user['user_level']==2){
        redirect('pengajuan_bpp.php?id='.$pengajuan['id_nodin'], false);
      }else{
     redirect('pengajuan_bpp.php?id='.$pengajuan['id_nodin'],false);
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
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Pengajuan</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="spm" placeholder="SPM" value="<?=$pengajuan['SPM'];?>" required>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <select class="form-control" name="id_jenis_pengajuan" required>
                      <option value="<?=$pengajuan['id_jenis_pengajuan'];?>"><?php $jenis=find_by_id('jenis_pengajuan',$pengajuan['id_jenis_pengajuan']); echo $jenis['keterangan']?></option>
                      <?php $jenis = find_all('jenis_pengajuan');?>
                    <?php  foreach ($jenis as $j): ?>
                      <option value="<?php echo (int)$j['id'] ?>">
                        <?php echo $j['keterangan'] ?></option>
                    <?php endforeach; ?>
                </select>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <select class="form-control" name="id_jenis_bendahara" required>
                  <option value="<?=$pengajuan['id_jenis_bendahara'];?>"><?php $jenis=find_by_id('jenis_bendahara',$pengajuan['id_jenis_bendahara']); echo $jenis['keterangan']?></option>
                      <?php  
                      $jenis = find_all('jenis_bendahara');
                      ?>
                    <?php  foreach ($jenis as $j): ?>
                      <option value="<?php echo (int)$j['id'] ?>">
                        <?php echo $j['keterangan'] ?></option>
                    <?php endforeach; ?>
                </select>
               </div>
              </div>

              <button type="submit" name="update_pengajuan" class="btn btn-danger">Update pengajuan</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
