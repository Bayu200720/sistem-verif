<?php
  $page_title = 'Add Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(6);
  $all_categories = find_all('jenis');
 
  $user = find_by_id('users',(int)$_SESSION['user_id']);

  $satker = find_all_global('satker',$user['id_satker'],'id');

 // var_dump($satker);exit();
 
?>
<?php
 if(isset($_POST['save_setting'])){
   $req_fields = array('id');
   validate_fields($req_fields);
   if(empty($errors)){
     $id  = remove_junk($db->escape($_POST['id']));
     $prefik   = remove_junk($db->escape($_POST['prefik']));
     $tahun   = remove_junk($db->escape($_POST['tahun']));
     $ppk = remove_junk($db->escape($_POST['ppk']));
     $nip_ppk = remove_junk($db->escape($_POST['nip_ppk']));
     $pimpinan   = remove_junk($db->escape($_POST['pimpinan']));
     $nip_pimpinan = remove_junk($db->escape($_POST['nip_pimpinan']));
     $bpp = remove_junk($db->escape($_POST['bpp']));
     $nip_bpp = remove_junk($db->escape($_POST['nip_bpp']));
     $keterangan = remove_junk($db->escape($_POST['keterangan']));
     $jabatan_pimpinan = remove_junk($db->escape($_POST['jabatan_pimpinan']));
     $date    = make_date();
     $query  = "UPDATE satker SET ";
     $query .=" prefik='{$prefik}',tahun='{$tahun}',ppk='{$ppk}',nip_ppk='{$nip_ppk}',pimpinan='{$pimpinan}',nip_pimpinan='{$nip_pimpinan}',bpp='{$bpp}',nip_bpp='{$nip_bpp}',jabatan_pimpinan='{$jabatan_pimpinan}' WHERE id='{$id}'";
      // var_dump($query);exit();
     if($db->query($query)){
       $session->msg('s',"Setting Updated ");
       if($user['user_level']==2){
        redirect('setting.php', false);
       }else{
       redirect('setting.php?id='.$id_nodin.'', false);
       }
     } else {
       $session->msg('d',' Sorry failed to added!');
       if($user['user_level']==2){
        redirect('setting.php', false);
      }else{
        redirect('setting.php?id='.$id_nodin.'', false);
      }
     }

   } else{
     $session->msg("d", $errors);
        redirect('setting.php?id='.$id_nodin.'', false);
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
            <span>Menu Setting</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class=""></i>Tahun
                  </span>
                  <input type="hidden" value="<?=$satker[0]['id'];?>" class="form-control" name="id">
                  <input type="text" class="form-control" value="<?=$satker[0]['tahun'];?>" name="tahun" placeholder="tahun">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class=""></i>Prefik
                  </span>
                  
                  <input type="text" class="form-control" value="<?=$satker[0]['prefik'];?>" name="prefik" placeholder="prefik">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class=""></i>PPK
                  </span>
                  
                  <input type="text" class="form-control" value="<?=$satker[0]['ppk'];?>" name="ppk" placeholder="ppk">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class=""></i>NIP PPK
                  </span>
                  
                  <input type="text" class="form-control" value="<?=$satker[0]['nip_ppk'];?>" name="nip_ppk" placeholder="nip_ppk">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class=""></i>Jabatan Pimpinan
                  </span>
                  
                  <input type="text" class="form-control" value="<?=$satker[0]['jabatan_pimpinan'];?>" name="jabatan_pimpinan" placeholder="jabatan_pimpinan">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class=""></i>Pimpinan
                  </span>
                  
                  <input type="text" class="form-control" value="<?=$satker[0]['pimpinan'];?>" name="pimpinan" placeholder="pimpinan">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class=""></i>Nip Pimpinan
                  </span>
                  
                  <input type="text" class="form-control" value="<?=$satker[0]['nip_pimpinan'];?>" name="nip_pimpinan" placeholder="nip_pimpinan">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class=""></i>BPP
                  </span>
                 
                  <input type="text" class="form-control" value="<?=$satker[0]['bpp'];?>" name="bpp" placeholder="bpp">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class=""></i>NIP BPP
                  </span>
                 
                  <input type="text" class="form-control" value="<?=$satker[0]['nip_bpp'];?>" name="nip_bpp" placeholder="nip_bpp">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class=""></i>Satker
                  </span>
                 
                  <input type="text" class="form-control" value="<?=$satker[0]['keterangan'];?>" name="keterangan" placeholder="keterangan">
               </div>
              </div>

    

              <button type="submit" name="save_setting" class="btn btn-primary">Save</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
