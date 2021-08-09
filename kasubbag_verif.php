<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $user = find_by_id('users',$_SESSION['user_id']);
  var_dump($user['user_level']);
   if($user['user_level'] == 2){ //echo "ok 3";exit();
   page_require_level(3); 
   }else if($user['user_level'] == 7 ){ //echo "7";exit();
     page_require_level(7); 
   }else{ //echo "3";exit();
     page_require_level(3); 
   }
?>
<?php
$sales = find_all('pengajuan');
$id = find_all_global('pengajuan',$_GET['id'],'id_nodin');
$idi= $_GET['id'];
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
            <span>All Pengajuan</span>
          </strong>
          <div class="pull-right">
            
          </div>
        </div>
        <div class="panel-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" > SPM </th>
                <th class="text-center" > Nominal Pengajuan </th>
                <th class="text-center" style="width: 15%;"> Status Verifikasi </th> 
                <th class="text-center" style="width: 15%;"> Dokumen Pengajuan </th>
                <th class="text-center" style="width: 15%;"> Dokumen Pertanggungjawaban </th>
                <th class="text-center" style="width: 15%;"> Status SPM </th> 
                <th class="text-center" style="width: 15%;"> Status KPPN </th> 
                <th class="text-center" style="width: 15%;"> Status SP2D </th>
                <th class="text-center" style="width: 15%;"> Status Pengambilan Uang </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php $tot=0; foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center" >
                <?php echo remove_junk($sale['SPM']); ?>/<?php $nodin=find_by_id('nodin',$sale['id_nodin']);$jenis=find_by_id('jenis',$nodin['id_jenis']); echo $jenis['keterangan']?>
                 /<?php $nodin=find_by_id('nodin',$sale['id_nodin']);$satker=find_by_id('satker',$nodin['id_satker']); echo $satker['keterangan']?>
              </td>
                <td class="text-center" ><?php $tp=find_NominalPengajuan($sale['id']);echo rupiah($tp['jum']);?></td>
            <td class="text-center">
                <?php if($sale['status_verifikasi']=='0'){?>
                    <a class="btn btn-success" href="<?php $jenis= find_by_id('jenis_pengajuan',$sale['id_jenis_pengajuan']); echo $jenis['link']?>.php?id=<?php echo $sale['id']?>&v=insert"><?=$jenis['keterangan']?></a>
                <?php }else{
                    
                    $v = find_by_filed('verifikasi',$sale['id'],'id_pengajuan');  
                    if($v['status_pengajuan']==1){
                    ?>
                    <span class="label label-success">Terverifikasi verifikator</span><br>
                    <?php }else{ ?>
                    <span class="label label-danger">Ditolak verifikator</span><br>
                    <?php } ?>
                    <br>

                    <?php $p = find_by_filed('pengajuan',$sale['id'],'id');  
                    if($p['verifikasi_kasubbag_v']==1){   ?>
                    <span class="label label-success">Terverifikasi Kasubbag verifikator</span>
                    <?php }else{ ?>
                    <span class="label label-danger">Ditolak Kasubbag verifikator</span>
                    <?php } ?>
                    
                <a href="<?php $jenis= find_by_id('jenis_pengajuan',$sale['id_jenis_pengajuan']); echo $jenis['link'];?>.php?id=<?=$sale['id']?>" class="btn btn-success">Edit</a>
                    <br>
                <?php if($user['user_level'] == 2 ){  ?>
                <a href="batal_verifikasi.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal
                [<?php $user = find_by_id('users',(int)$sale['status_verifikasi']);echo $user['name'];?>]
                </a>
                
                <?php }} ?>
                
            </td>
            <td class="text-center"><?php if($sale['upload']==''){?><?php }else{?>
             <a href="uploads/products/<?=$sale['upload']?>" class="btn btn-success" target="_blank">Preview</a>
             <!-- <a href="batal_upload.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal</a> -->
             <?php } ?>
            </td>
            <td class="text-center" >
                <?php if($sale['upload_pertanggungjawaban']==''){?><?php }else{?>
                <a href="uploads/pertanggungjawaban/<?=$sale['upload_pertanggungjawaban']?>" class="btn btn-success" target="_blank">Preview</a>
                <?php } ?>
            </td>
            <td class="text-center"><?php if($sale['status_spm']==0){?><span class="label label-danger">Belom di Proses</span><?php }else{?>
             <span class="label label-success">Sudah di Proses oleh <?php $user = find_by_id('users',(int)$sale['status_spm']);echo $user['name'];?></span><?php } ?>
            </td>
            <td class="text-center">
            <?php if($sale['penolakan_kppn']!=''){?><span class="label label-danger">Penolakan KPPN perbaiakan= <?=$sale['penolakan_kppn'];?></span><?php }else{ ?>
               
               <?php } ?>
               <?php if($sale['status_kppn']==0){?><span class="label label-danger">Belom di Proses</span><?php }else{?>
                <span class="label label-success">Sudah di Proses oleh <?php $user = find_by_id('users',(int)$sale['status_kppn']);echo $user['name'];?></span><?php } ?>
            </td>

            <td class="text-center"><?php if($sale['status_sp2d']==0){?><span class="label label-danger">Belom Cair</span><?php }else{?>
             <span class="label label-success">Sudah Cair [<?php $user = find_by_id('users',(int)$sale['status_sp2d']);echo $user['name'];?>]</span><?php } ?>
            </td>
            <td class="text-center">
                <?php if($sale['status_pengambilan_uang']==0){?><span class="label label-danger">Belom di Ambil</span><?php }else{?>
                 <span class="label label-success">Sudah Diambil <?php $user = find_by_id('users',(int)$sale['status_sp2d']);?></span><?php } ?>
            </td>
               <td class="text-center">
                  <div class="btn-group">
                     
                     <a href="detail_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail Pengajuan" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
            
                  </div>
               </td>
             </tr>
             <?php $tot+=$tp['jum']; endforeach;?>
           </tbody>
           <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" > SPM </th>
                <th class="text-center" > Satker </th>
                <th class="text-center" > Jenis Pengajuan </th>
                <th class="text-center" > <?=rupiah($tot);?> </th>
                <th class="text-center" style="width: 15%;"> Status Verifikasi </th> 
                <th class="text-center" style="width: 15%;"> Dokumen Pengajuan </th>
                <th class="text-center" style="width: 15%;"> Dokumen Pertanggungjawaban </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>

<!-- jQuery -->
<script src="libs/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="libs/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="libs/js/jquery.dataTables.js"></script>
<script src="libs/js/dataTables.bootstrap4.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>