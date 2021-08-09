<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  if($user['user_level'] == 3){ 
    page_require_level(3);
  }else if($user['user_level'] == 8){
    page_require_level(8);
  }else if($user['user_level'] == 6){
    page_require_level(6);
  } 
  
?>
<?php


$sales = find_all_global('pengajuan',$_GET['id'],'id_nodin');
$id = find_all_global('pengajuan',$_GET['id'],'id_nodin');
$pengajuan = find_by_id('pengajuan',(int)$_GET['id']);
$nodin = find_all_global('nodin',$_GET['id'],'id');
var_dump();
$idi= $_GET['id'];


if(isset($_GET['s']) and $_GET['s']==='hapus_adk'){
      $query  = "UPDATE pengajuan SET ";
      $query .= "upload_adk=''";
      $query .= "WHERE id='{$idi}'";
     // echo $query; exit();
      $result = $db->query($query);
      $session->msg('s',' Berhasil di Batalkan');
      if($user['user_level']==5){
    redirect('pengajuan_bpp.php?id='.$pengajuan['id_nodin']);
    }else{
    redirect('pengajuan_bpp.php?id='.$pengajuan['id_nodin'], false);
    }
}


if(isset($_POST['no_spm'])){
  $req_fields = array('spm');
  $id = remove_junk($db->escape($_POST['id']));
  $spm = remove_junk($db->escape($_POST['spm']));
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id']));
    
    $query  = "UPDATE pengajuan SET ";
    $query .=" SPM = '{$spm}'";
    $query .=" WHERE id='{$id}'";
    //var_dump($query);exit();
    if($db->query($query)){
      $session->msg('s',"Konfirmasi Updated ");
      if($user['user_level']==2){
       redirect('pengajuan_bpp.php?id='.$_GET['id'], false);
      }else{
      redirect('pengajuan_bpp.php?id='.$_GET['id'], false);
      }
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      if($user['user_level']==2){
       redirect('pengajuan_bpp.php?id='.$_GET['id'], false);
     }else{
        redirect('pengajuan_bpp.php?id='.$_GET['id'], false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('pengajuan_bpp.php?id='.$_GET['id'],false);
  }

}


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
            <span><a href="nodin_bpp.php">All Nodin</a> / <a href="pengajuan_bpp.php?id=<?=$_GET['id']?>">All Pengajuan</a></span>
          </strong>
          <div class="pull-right">
          <?php if($nodin[0]['approvel_atasan']!=1){?>
            <a href="add_pengajuan.php?id=<?=$idi;?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Add</a>
            <?php } ?>
          </div>
        </div>
        <div class="panel-body" style="width:100%">
          <table id="tabel" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center"> SPM </th>
                <th class="text-center"> Jenis Pengajuan </th>
                <th class="text-center"> Status Verifikasi </th> 
                <th class="text-center"> Status SPM </th>
                <th class="text-center">Berkas SPM</th>             
                <th class="text-center"> Status KPPN </th> 
                <th class="text-center"> Status SP2D </th>
                <th class="text-center"> Status Pengambilan Uang </th>
                <th class="text-center"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr class="text-center"> 
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php 
                  if($_SESSION['user_id'] == 38){
                    ?>
                    <a href="#" class="btn btn-primary" id="UploadSPM" data-toggle="modal" data-target="#uploadSPM" data-id='<?=$sale['id'];?>'><?php echo $sale['SPM']; ?></a>
                    <?php
                  }else{
                    echo remove_junk($sale['SPM']);
                  }
                  ?>
              </td>
               <td><?php $jenis = find_by_id('jenis_pengajuan',$sale['id_jenis_pengajuan']); echo $jenis['keterangan']?>/<?php $jenis=find_by_id('jenis_bendahara',$sale['id_jenis_bendahara']); echo $jenis['keterangan']?></td>
               <td class="text-center"><?php if($sale['status_verifikasi']==0){?><span class="label label-danger">Belom di Proses</span><?php }else{?>
             <span class="label label-success">Sudah di Proses oleh <?php $user = find_by_id('users',(int)$sale['status_verifikasi']);echo $user['name'];?></span><?php } ?>

             <?php $p = find_by_filed('pengajuan',$sale['id'],'id');  
                        if($p['verifikasi_kasubbag_v']==1){   ?>
                        <span class="label label-success">Terverifikasi Kasubbag verifikator</span>
                        <?php }else if($p['verifikasi_kasubbag_v']==2){ ?>
                        <span class="label label-danger">Ditolak Kasubbag verifikator</span>
                        <?php }else{ ?>
                          <span class="label label-warning"> Kasubbag belom verifikasi</span>
                        <?php } ?>
                        
            <?php $verif = find_all_global('verifikasi',$sale['id'],'id_pengajuan');if($verif[0]['id_pengajuan']!=NULL){?>
          
               <a href="<?php 
                  if($sale['id_jenis_pengajuan']==1){
                    echo "verif_LSsppd.php?id=".$sale['id_nodin']."&v=".$sale['id'];
                  }else if($sale['id_jenis_pengajuan']==2){
                    echo "verif_sppdLn.php?id=".$sale['id_nodin']."&v=".$sale['id'];
                  }else if($sale['id_jenis_pengajuan']==3){
                    echo "verif_LSHonor.php?id=".$sale['id_nodin']."&v=".$sale['id'];
                  }else if($sale['id_jenis_pengajuan']==4){
                    echo "verif_LSjasprof.php?id=".$sale['id_nodin']."&v=".$sale['id'];
                  }else if($sale['id_jenis_pengajuan']==5){
                    echo "verif_LSkur50.php?id=".$sale['id_nodin']."&v=".$sale['id'];
                  }else{
                    echo "verif_GU.php?id=".$sale['id_nodin']."&v=".$sale['id'];
            
                  }
                
                ?>" class="btn btn-warning" style="margin: 20px;" target="_BLANK">Kekurangan</a>
            <?php } ?>
            </td>
            
            <td class="text-center"><?php if($sale['status_spm']==0){?><span class="label label-danger">Belom di Proses</span><?php }else{?>
             <span class="label label-success">Sudah di Proses oleh <?php $user = find_by_id('users',(int)$sale['status_spm']);echo $user['name'];?></span><?php } ?>
            </td>
            <td class="text-center">
                <a href="detail_dokumen.php?id=<?=$sale['id']?>" class="btn btn-primary">Upload Dokumen</a>
                <a href="histori.php?id=<?=$sale['id']?>" class="btn btn-primary">Histori
                <?php $hsl = find_count_global('histori',$sale['id'],'id_pengajuan'); 
                    if($hsl[0]['jml'] > 0){
                      echo '<span class="badge">'.$hsl[0]['jml'].'</span>';
                      } ?>
                </a>
                
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
                  <?php if($nodin[0]['approvel_atasan']!=1){?>
                     <a href="edit_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-pencil"></span>
                     </a>
                     <?php } ?>
                     <?php if($user['user_level'] == 5){ ?>
                     <a href="detail_pengajuan_ben.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail Pengajuan" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-eye-open"></span>
                     </a>
                     <?php }else{ ?>
                     <a href="detail_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail Pengajuan" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-eye-open"></span>
                     </a>
                     <?php } ?>
                     <?php if($nodin[0]['approvel_atasan']!=1){?>
                     <a onclick="return confirm('Yakin Hapus?')" href="delete_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                     <?php } ?>
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


<!-- Modal edit no nodin-->
<div class="modal fade" id="uploadSPM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit SPM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">No SPM</label>
        <input type="number" class="form-control" id="spm" name="spm" placeholder="SPM">
        <input type="hidden" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="no_spm" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>