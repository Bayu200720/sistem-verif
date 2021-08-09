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
$sales = find_all_global('pengajuan',$_GET['id'],'id_nodin');
$id = find_all_global('pengajuan',$_GET['id'],'id_nodin');
$idi= $_GET['id'];

if(isset($_POST['update_sp2d'])){
  $req_fields = array('sp2d', 'id' );
  validate_fields($req_fields);
      if(empty($errors)){
        $p_id      = $db->escape($_POST['id']);
        $sp2d     = $db->escape($_POST['sp2d']);
        
        $sql  = "UPDATE pengajuan SET";
        $sql .= " sp2d='{$sp2d}'";
        $sql .= " WHERE id ='{$p_id}'";
        $result = $db->query($sql);
        if( $result && $db->affected_rows() === 1){
                 //$h= update_product_qty_ok($p_id);
                    $session->msg('s',"SP2D updated.");
                  redirect('pengajuan_v.php?id='.$sales[0]['id_nodin'], false);
                } else {
                  $session->msg('d',' Sorry failed to updated!');
                  redirect('pengajuan_v.php?id='.$sales[0]['id_nodin'], false);
                }
      } else {
         $session->msg("d", $errors);
         redirect('pengajuan_v.php?id='.$sales[0]['id_nodin'],false);
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
            <span>All Pengajuan</span>
          </strong>
          <div class="pull-right">
            
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> SPM </th>
                <th class="text-center" style="width: 15%;"> Status Verifikasi </th>
                 
                <th class="text-center" style="width: 15%;"> Upload </th>
                <th class="text-center" style="width: 15%;">SP2D</th> 
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['SPM']); ?></td>
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
             <?php  if($user['user_level'] != 2 and $user['user_level'] != 3 and $user['user_level'] != 4 and $user['user_level'] != 5 and $user['user_level'] != 7){?>
             <a href="batal_upload.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal</a>
             <?php }} ?>
            </td>
            <td>
            <?php if($sale['sp2d'] == ''){?><a href="#" class="btn btn-primary" id="editsp2d" data-toggle="modal" data-target="#exampleModal" data-id='<?=$sale['id'];?>'>Input SP2D</a><?php }else{?>
              <a href="#" class="btn btn-warning" id="editsp2d" data-toggle="modal" data-target="#exampleModal" data-id='<?=$sale['id'];?>' data-sp2d='<?=$sale['sp2d'];?>'><?=$sale['sp2d'];?></a> <?php } ?>
             
             </td>
               <td class="text-center">
                  <div class="btn-group">
                <?php if($user['user_level'] != 2 and $user['user_level'] != 3 and $user['user_level'] != 4 and $user['user_level'] != 5 and $user['user_level'] != 7){?>
                     <a href="edit_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a onclick="return confirm('Yakin Hapus?')" href="delete_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                <?php } ?>
                     <a href="detail_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail Pengajuan" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
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

    <!-- Modal input sp2d-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SP2D</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Masukkan Kode SP2D</label>
        <input type="text" class="form-control" id="sp2d" name="sp2d" placeholder="SP2D">
        <input type="hidden" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update_sp2d" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>



  <!-- Modal edit sp2d-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit SP2D</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Edit Kode SP2D</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="sp2d" placeholder="SP2D">
        <input type="text" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update1_sp2d" value="Update">
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal edit sp2d-->
<div class="modal fade" id="exampleModalOK" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Coba SP2D</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Edit Kode SP2D</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="sp2d" placeholder="SP2D">
        <input type="text" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update1_sp2d" value="Update">
      </div>
      </form>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
