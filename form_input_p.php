<?php
  $page_title = 'Add Panjar';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(6);
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
          <form method="post" action="pengajuan_pum_ben.php" class="clearfix">
             <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  Tanggal</span>
                  <input type="date" class="form-control" name="tanggal" placeholder="tanggal" required>
                  <input type="hidden" name="id_satker" value="<?=$_GET['id_satker']?>">
                  <input type="hidden" name="id" value="<?=$_GET['id']?>">
               </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  Jenis Pengajuan</span>
                  <input type="text" class="form-control" value="<?php echo $_GET['spm']?>" name="spm" placeholder="spm" required>
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

              <button type="submit" name="add_panjar" class="btn btn-primary">Add</button>
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
