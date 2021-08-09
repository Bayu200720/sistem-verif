<?php
  $page_title = 'Add Detail Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(6);
?>

<?php


?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="detail_pengajuan_nodin_pum.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  MAK</span>
                  <select class="form-control" name="id_akun" required>
                      <option value="">Pilih Jenis Pengajuan</option>
                      <?php $user=find_by_id('users',$_SESSION['user_id']); $jenis = find_all_global_tahun('akun',$user['id_satker'],'id_satker',$user['tahun']); ?>
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
                  <input type="hidden" name="id_pengajuan_pum" value="<?=$_GET['id']?>">
               </div>
              </div>

              <button type="submit" name="add_transaksi" class="btn btn-primary">Add</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<script>

var rupiah = document.getElementById('rupiah');
  rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah1(this.value, 'Rp. ');
  });

</script>
