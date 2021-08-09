<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
   $user = find_by_id('users',(int)$_SESSION['user_id']);
   $status = find_by_id('user_groups',(int)$user['user_level']);
   $c_satker     = count_by_id('satker');
   $c_SPM       = count_by_id('pengajuan');
   $c_sptjb          = count_by_id('detail_pengajuan');
   $c_user          = count_by_id('users');
   $spm_proses   = spm_proses($user['id_satker']);
   $spm_belom_diproses   = spm_blm_proses($user['id_satker']);
   $pj= find_count_statusVerif_tahun('upload_pertanggungjawaban','',$user['id_satker'],$user['tahun']); 
   $realisasi_bpp = find_realisasi_bpp($user['id_satker'],$user['tahun']);

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel">-
      <div class="jumbotron text-center">
         <h1>Selamat Datang <?php echo $user['name'];?></h1>
         <p>Status Anda Sebagai <?php echo $status['group_name'];?></p>
      </div>
    </div>
 </div>
 
   <div class="col-md-6">
  
   </div>
</div>
  <div class="row">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $spm_belom_diproses[0]['total_spm'];?>  </h2>
          <p class="text-muted">SPM Belom di Cair</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-list"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php echo $spm_proses[0]['total_spm'];?> </h2>
          <p class="text-muted">SPM Cair</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php echo $pj[0]['jml'];?> </h2>
          <p class="text-muted">Pertanggungjawaban Belom di Upload</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php echo rupiah($realisasi_bpp[0]['total']);?></h2>
          <p class="text-muted">Realisasi</p>
        </div>
       </div>
    </div>
</div>
  <div class="row">
   <div class="col-md-12">
      <div class="panel">
        <div class="jumbotron text-center">
          

        </div>
      </div>
   </div>
  </div>
  

 
 </div>


</div>


<?php include_once('layouts/footer.php'); ?>



<script type="text/javascript">
  // $(document).ready(function() {
	// 	$('#Body_dp').load('notif.php');
  //       $('#Detail_Nodin').modal('show');
    
  //   });
</script>

     <!-- Modal Detail Pengajuan-->
<div class="modal fade" id="Detail_Nodin" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:50vw">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pemberitahuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="Body_dp" style="width:100%;">
      
    </div>
    </div>
  </div>
</div>



