<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $user = find_by_id('users',$_SESSION['user_id']);
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
        <div class="panel-body" width="100%">
          <table id="tabel" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center" > SPM </th>
                <th class="text-center" > Satker </th>
                <th class="text-center" > Jenis Pengajuan </th>
                <th class="text-center" > Nominal Pengajuan </th>
                <th class="text-center" > Status Verifikasi </th> 
                <th class="text-center" > Upload </th>
                <th class="text-center" > Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php $tot=0; foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center" ><?php echo remove_junk($sale['SPM']); ?></td>
               <td class="text-center"><?php $nodin=find_by_id('nodin',$sale['id_nodin']);$satker=find_by_id('satker',$nodin['id_satker']); echo $satker['keterangan']?></td>
                <td class="text-center"><?php $nodin=find_by_id('nodin',$sale['id_nodin']);$jenis=find_by_id('jenis',$nodin['id_jenis']); echo $jenis['keterangan']?></td>
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
            <td class="text-center"><?php if($sale['upload']==''){?><a href="media.php?id=<?=$sale['id']?>" class="btn btn-primary">Upload</a><?php }else{?>
             <a href="uploads/products/<?=$sale['upload']?>" class="btn btn-success" target="_blank">Preview</a>
             <a href="batal_upload.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal</a>
             <?php } ?>
            </td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-pencil"></span>
                     </a>
                     <a href="detail_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail Pengajuan" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-eye-open"></span>
                     </a>
                     <a onclick="return confirm('Yakin Hapus?')" href="delete_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>
             <?php $tot+=$tp['jum']; endforeach;?>
           </tbody>
           <tr>
                <th class="text-center" >#</th>
                <th class="text-center" > SPM </th>
                <th class="text-center" > Satker </th>
                <th class="text-center" > Jenis Pengajuan </th>
                <th class="text-center" > <?=rupiah($tot);?> </th>
                <th class="text-center" > Status Verifikasi </th> 
                <th class="text-center" > Upload </th>
                <th class="text-center" > Actions </th>
            </tr>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>