<?php
  $page_title = 'Add Detail Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(6);
  
  $all_categories = find_all('jenis');
  $all_photo = find_all('media');
?>

<?php
 if(isset($_POST['add_detail_pengajuan'])){
   $req_fields = array('no_sptjb','nominal','id_akun','pph','ppn','tanggal','id_pencairan');
   validate_fields($req_fields);
   $teks5 = $_POST['nominal'];
  $nominal = preg_replace("/[^0-9]/", "", $teks5);
  
 

   if(empty($errors)){
     $no_sptjb  = remove_junk($db->escape($_POST['no_sptjb']));
     $tanggal  = remove_junk($db->escape($_POST['tanggal']));
     $nominal  = remove_junk($db->escape($nominal));
      $akun  = remove_junk($db->escape($_POST['id_akun']));
      $id_pencairan  = remove_junk($db->escape($_POST['id_pencairan']));

    

     if($db->escape($_POST['pph'])==''){
      $pph=0;
     }else{
      $pph = preg_replace("/[^0-9]/", "", $_POST['pph']);
    // $pph  = remove_junk($db->escape($_POST['pph']));
     }
     if($db->escape($_POST['ppn'])==''){
      $ppn=0;
     }else{
      $ppn = preg_replace("/[^0-9]/", "", $_POST['ppn']);
     //$ppn  = remove_junk($db->escape($_POST['ppn']));
     }

     if($_POST['pph1'] == 'pph5p'){
      $pph = $nominal * 5/100;
    }else if($_POST['pph1']== 'pph15p'){
      $pph = $nominal * 15/100;
    }else if($_POST['pph1']== 'pph2p'){
      $pph = $nominal * 2/100;
    }else if($_POST['pph1']=='pph'){
      $pph=0;
    }
    //var_dump($_POST['pph1']);
    //var_dump($pph);exit();

     $keterangan   = remove_junk($db->escape($_POST['keterangan']));
     $date    = make_date();
    // $id_pengajuan = remove_junk($db->escape($_GET['id']));
     $query  = "INSERT INTO detail_pengajuan (";
     $query .=" no_sptjb,nominal,id_akun,keterangan,id_pengajuan,pph,ppn,tanggal_dp,id_pencairan";
     $query .=") VALUES (";
     $query .=" '{$no_sptjb}', '{$nominal}', '{$akun}', '{$keterangan}', '{$id_pengajuan}','{$pph}','{$ppn}','{$tanggal}','{$id_pencairan}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"Detail Pengajuan added ");
       redirect('detail_pengajuan_pum.php?id='.$_GET["id"], false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('detail_pengajuan_pum.php?id='.$_GET["id"], false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('detail_pengajuan_pum.php?id='.$_GET["id"],false);
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
            <span>Add New Detail Pengajuan</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  SPTJB</span>
                  <input type="text" class="form-control" name="no_sptjb" placeholder="NO SPTJB" required>
                  <input type="hidden" name="id_pencairan" value="<?php echo $_GET['id'] ?>" />
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
               
                <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  Jenis Pengajuan</span>      
                  <select class="form-control" name="id_akun" required>
                      <option value="">Pilih Jenis Pengajuan</option>
                      <?php $user=find_by_id('users',$_SESSION['user_id']); $jenis = find_all_global('akun',$user['id_satker'],'id_satker');//var_dump($jenis);exit();?>
                    <?php  foreach ($jenis as $j): ?>
                      <option value="<?php echo (int)$j['id'] ?>">
                        <?php echo $j['keterangan'] ?>-<?php echo $j['mak'] ?></option>
                    <?php endforeach; ?>
                </select>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  Nominal</span>
                  <input type="text" id="rupiah" class="form-control" name="nominal" placeholder="Nominal" required>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  Tanggal</span>
                  <input type="date" id="rupiah" class="form-control" name="tanggal" placeholder="tanggal" required>
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
                   PPH</span>
                  <input type="text" id="pph" class="form-control" name="pph" placeholder="pph" value="0" placeholder="PPH" required>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  PPN</span>
                  <input type="text" id="ppn" class="form-control" name="ppn" placeholder="ppn" value="0" required>
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  Keterangan</span>
                  <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" required>
               </div>
              </div>

              <button type="submit" name="add_detail_pengajuan" class="btn btn-danger">Add Detail pengajuan</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>


<?php include_once('layouts/footer.php'); ?>

<script>

var rupiah = document.getElementById('rupiah');
  rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah1(this.value, 'Rp. ');
  });

  var pph = document.getElementById('pph');
		pph.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatpph() untuk mengubah angka yang di ketik menjadi format angka
			pph.value = formatRupiah1(this.value, 'Rp. ');
		});

    var ppn = document.getElementById('ppn');
		ppn.addEventListener('keyup', function(e){
			ppn.value = formatRupiah1(this.value, 'Rp. ');
		});
</script>
