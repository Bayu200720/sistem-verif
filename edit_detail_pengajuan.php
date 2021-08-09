<?php
  $page_title = 'edit Detail Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(6);
  
  $detail = find_by_id('detail_pengajuan',(int)$_GET['id']);
  //var_dump($detail);exit();
  if(!$detail){
    $session->msg("d","Missing detail pengajuan id.");
    redirect('detail_pengajuan.php');
  }

?>
<?php
 if(isset($_POST['edit_detail_pengajuan'])){
   $req_fields = array('no_sptjb','nominal');
   validate_fields($req_fields);
   if(empty($errors)){
     $no_sptjb  = remove_junk($db->escape($_POST['no_sptjb']));
     $nominal = preg_replace("/[^0-9]/", "", $_POST['nominal']);
     $nominal = remove_junk($db->escape($nominal));
     //$nominal  = remove_junk($db->escape($_POST['nominal']));
     $ppn = preg_replace("/[^0-9]/", "", $_POST['ppn']);
     $ppn = remove_junk($db->escape($ppn));
    
     //$ppn  = remove_junk($db->escape($_POST['ppn']));
     $pph = preg_replace("/[^0-9]/", "", $_POST['pph']);
     $pph = remove_junk($db->escape($pph));

     //$pph  = remove_junk($db->escape($_POST['pph']));
    $akun  = remove_junk($db->escape($_POST['id_akun']));//var_dump($akun); echo "yeee"; exit();
    //  if( isset($akun)){
    //    var_dump($detail);
    //    echo $akun = $detail['id_akun']; echo "ok"; exit();
    //  }

     $keterangan   = remove_junk($db->escape($_POST['keterangan']));
     $tanggal   = remove_junk($db->escape($_POST['tanggal']));
     $date    = make_date();
     $id_pengajuan = remove_junk($db->escape($_GET['id']));

     if($_POST['pph1'] == 'pph5p'){
      $pph = $nominal * 5/100;
    }else if($_POST['pph1']== 'pph15p'){
      $pph = $nominal * 15/100;
    }else if($_POST['pph1']== 'pph2p'){
      $pph = $nominal * 2/100;
    }else if($_POST['pph1']=='pph'){
      $pph=0;
    }

     $query  = "UPDATE detail_pengajuan SET";
     $query .=" no_sptjb='{$no_sptjb}',nominal='{$nominal}',id_akun='{$akun}',keterangan='{$keterangan}',pph='{$pph}',ppn='{$ppn}',tanggal_dp='{$tanggal}'";
     $query .=" WHERE id= '{$id_pengajuan}'";
     if($db->query($query)){
       $session->msg('s',"Detail Pengajuan edited ");
       redirect('detail_pengajuan.php?id='.$detail['id_pengajuan'], false);
     } else {
       $session->msg('d',' Sorry failed to edited!');
       redirect('detail_pengajuan.php?id='.$detail['id_pengajuan'], false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('detail_pengajuan.php?id='.$detail['id_pengajuan'],false);
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
            <span>Edit New Detail Pengajuan</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  SPTJB </span>
                  <input type="text" class="form-control" name="no_sptjb" placeholder="NO SPTJB" value="<?=$detail['no_sptjb']?>" required>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  Akun</span>
                  <select class="form-control" name="id_akun" required>
                      <option value="">Pilih Jenis Pengajuan</option>
                      <?php $user=find_by_id('users',$_SESSION['user_id']); $jenis = find_all_global('akun',$user['id_satker'],'id_satker');
                    foreach ($jenis as $j): ?>
                      <option value="<?php echo (int)$j['id'] ?>" <?php if($j['id']==$detail['id_akun']){echo "selected";}?>><?php echo $j['keterangan'] ?>-<?php echo $j['mak'] ?></option>
                    <?php endforeach; ?>
                </select>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  Nominal</span>
                  <input type="text" id="e_nominal" class="form-control" name="nominal" placeholder="Nominal" value="<?=$detail['nominal']?>" required>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  Tanggal</span>
                  <input type="date" id="e_tanggal" class="form-control" name="tanggal" placeholder="tanggal" value="<?=$detail['tanggal_dp']?>" required>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-text">
                  <input type="radio" name="pph1" aria-label="Checkbox for following text input" value="pph2p">                 
                    <i > PPH 23 2%</i> 
                    <input type="radio" name="pph1" aria-label="Checkbox for following text input" value="pph15p">                 
                    <i > PPH 21 15%</i> 
                    <input type="radio" name="pph1" aria-label="Checkbox for following text input" value="pph5p">                 
                    <i > PPH 21 5%</i>
                    <input type="radio" name="pph1" aria-label="Checkbox for following text input" value="pph">                 
                    <i > None</i> 
                </div>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  PPh</span>
                  <input type="text" id="e_pph" class="form-control" name="pph" placeholder="pph" value="<?=$detail['pph']?>">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  PPn</span>
                  <input type="text" id="e_ppn" class="form-control" name="ppn" placeholder="ppn" value="<?=$detail['ppn']?>">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                   Keterangan</span>
                 <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="<?=$detail['keterangan']?>">
               </div>
              </div>

              <button type="submit" name="edit_detail_pengajuan" class="btn btn-danger">Update Detail pengajuan</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
