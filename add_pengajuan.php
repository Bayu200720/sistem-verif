<?php
  $page_title = 'Add Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(6);
  $all_categories = find_all('jenis');
  $satker = find_all('satker');
  $all_photo = find_all('media');
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  $nodin = find_all_global('nodin',$_GET['id'],'id');
  var_dump($nodin[0]['id_jenis']);
 
?>
<?php
 if(isset($_POST['add_pengajuan'])){
   //var_dump($_POST);exit();
   $req_fields = array('spm','id_jenis_pengajuan');
   validate_fields($req_fields);
   if(empty($errors)){
     $spm  = remove_junk($db->escape($_POST['spm']));
     $id_jenis   = remove_junk($db->escape($_POST['id_jenis']));
     $tanggal   = remove_junk($db->escape($_POST['tanggal']));
     $id_satker = remove_junk($db->escape($_POST['id_satker']));
     $p_pengajuan = remove_junk($db->escape($_POST['p_pengajuan']));
     $user_id   = remove_junk($db->escape($_SESSION['user_id']));
     $id_nodin = remove_junk($db->escape($_POST['id']));
     $id_jenis_pengajuan = remove_junk($db->escape($_POST['id_jenis_pengajuan']));
     $id_jenis_bendahara = remove_junk($db->escape($_POST['id_jenis_bendahara']));
     $date    = make_date();
     $query  = "INSERT INTO pengajuan (";
     $query .=" SPM,id_nodin,id_jenis_pengajuan,id_jenis_bendahara ";
     $query .=") VALUES (";
     $query .=" '{$spm}','{$id_nodin}',{$id_jenis_pengajuan},{$id_jenis_bendahara}";
     $query .=")";
     $result =$db->query($query);
     
  
     if($result){
       $session->msg('s',"Pengajuan added ");
       if($user['user_level']==2){
        redirect('pengajuan_bpp.php='.$id_nodin.'', false);
       }else{
       redirect('pengajuan_bpp.php?id='.$id_nodin.'', false);
       }
     } else {
       $session->msg('d',' Sorry failed to added!,make sure the SPM number is not the same');
       if($user['user_level']==2){
        redirect('pengajuan_bpp.php='.$id_nodin.'', false);
      }else{
        redirect('pengajuan_bpp.php?id='.$id_nodin.'', false);
      }
     }

   } else{
     $session->msg("d", $errors);
        redirect('pengajuan_bpp.php?id='.$id_nodin.'', false);
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
            <span>All Nodin / All Pengajuan / Add New Pengajuan</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_pengajuan.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  
                  <?php 
                  $user = find_by_id('users',$_SESSION['user_id']); 
                   if($user['id_satker'] == 1 ||$user['id_satker'] == 2 || $user['id_satker'] == 3 || $user['id_satker'] == 4 ||$user['id_satker'] == 14){ 
                 ?>
                  <input type="number" class="form-control"  value="<?php echo rand()?>" name="spm">
                  <?php }else{ ?>
                    <input type="text" class="form-control" name="spm" placeholder="SPM" required>
                  <?php } ?>
                  <input type="hidden" class="form-control" value="<?=$_GET['id'];?>" name="id" placeholder="SPM" >
               </div>
              </div>

              

              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <select class="form-control" name="id_jenis_pengajuan" required>
                      <option value="">Pilih Jenis Pengajuan</option>
                      <?php 
                    if($nodin[0]['id_jenis'] == 2){
                      $jenis = find_all_global('jenis_pengajuan',6,'id');
                      var_dump($jenis);
                    }else if($nodin[0]['id_jenis'] == 6){
                        $jenis = find_all_global_op('jenis_pengajuan',7,'id','=');
                        var_dump($jenis);
                    }else{
                      $jenis = find_all_global_ls('jenis_pengajuan',6,7,'id');
                      echo "LSSS"; 
                    }
                      ?>
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
                      <option value="">Pilih Jenis Bendahara</option>
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

              <button type="submit" name="add_pengajuan" class="btn btn-danger">Add pengajuan</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
