<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sales = find_all_global('pengajuan',$_GET['id'],'id_nodin');
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
            <a href="add_pengajuan.php?id=<?=$idi;?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus">Add</a>
          </div>
        </div>
        <div class="panel-body">
          <table id="tabel" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th> SPM </th>
                <th class="text-center" > Status Verifikasi </th> 
                <th class="text-center" > Status SPM </th>              
                <th class="text-center" > Status KPPN </th> 
                <th class="text-center" > Status SP2D </th>
                <th class="text-center" > Upload </th>
                <th class="text-center" > Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['SPM']); ?></td>
             <td class="text-center"><?php if($sale['status_verifikasi']==0){?><a href="update_verifikasi.php?id=<?=$sale['id']?>" class="btn btn-success">Proses</a><?php }else{?>
             <a href="batal_verifikasi.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal
              [<?php $user = find_by_id('users',(int)$sale['status_verifikasi']);echo $user['name'];?>]
             </a><?php } ?>
            </td>
            
            <td class="text-center"><?php if($sale['status_spm']==0){?><a href="update_spm.php?id=<?=$sale['id']?>" class="btn btn-success">Proses</a><?php }else{?>
             <a href="batal_spm.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal
             [<?php $user = find_by_id('users',(int)$sale['status_spm']);echo $user['name'];?>]
             </a><?php } ?>
            </td>

            <td class="text-center"><?php if($sale['status_kppn']==0){?><a href="update_kppn.php?id=<?=$sale['id']?>" class="btn btn-success">Proses</a><?php }else{?>
             <a href="batal_kppn.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal
             [<?php $user = find_by_id('users',(int)$sale['status_kppn']);echo $user['name'];?>]
             </a><?php } ?>
            </td>

            <td class="text-center"><?php if($sale['status_sp2d']==0){?><a href="update_sp2d.php?id=<?=$sale['id']?>" class="btn btn-success">Proses</a><?php }else{?>
             <a href="batal_sp2d.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal
             [<?php $user = find_by_id('users',(int)$sale['status_sp2d']);echo $user['name'];?>]
             </a><?php } ?>
            </td>

            <td class="text-center"><?php if($sale['upload']=='0'){?><a href="media.php?id=<?=$sale['id']?>" class="btn btn-primary">Upload</a><?php }else{?>
             <a href="uploads/products/<?=$sale['upload']?>" class="btn btn-success" target="_blank">Preview</a>
             <a href="batal_upload.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal</a>
             <?php } ?>
            </td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="detail_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail Pengajuan" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a onclick="return confirm('Yakin Hapus?')" href="delete_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
