<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(5);
?>
<?php

if($_GET['status']==='deleteKc'){
    //var_dump($_GET);exit();
    $update ="UPDATE `pencairan` SET `status` = '0' WHERE `pencairan`.`status` = {$_GET['id']}";
    $db->query($update);
    $delete_id = delete_by_id('k_cair',(int)$_GET['id']);
  if($delete_id){
      $session->msg("s","Tanda Terima Pencairan deleted.");
      if($user['user_level']==2){
              redirect('cetakP.php', false);
          }else{
      redirect('cetakP.php');
        }
  } else {
      $session->msg("d","Tanda Terima Pencairan deletion failed.");
          if($user['user_level']==2){
              redirect('cetakP.php', false);
          }else{
      redirect('cetakP.php');
          }
  }

}

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
                  redirect('pengajuan_ben.php', false);
                } else {
                  $session->msg('d',' Sorry failed to updated!');
                  redirect('pengajuan_ben.php', false);
                }
      } else {
         $session->msg("d", $errors);
         redirect('pengajuan_ben.php',false);
      }
}

$sales = find_all('k_cair');

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
            <span>All Cetak Pencairan</span>
          </strong>
          <div class="pull-right">
          
          </div>
        </div>
        <div class="panel-body"  style="width: 100%;">
          <table id="tabel" class="table table-bordered table-striped"  style="width: 100%;">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center"> Waktu</th>
                <th class="text-center"> Total</th>
                <th class="text-center"> Cetak</th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo $sale['time_add'];?></td>
               <td class="text-center"><?php $t=sumStatus($sale['id']); echo rupiah($t['jum']);?></td>
               <td class="text-center">
                     <a href="cetaktt1.php?id=<?=$sale['id'];?>"  class="btn btn-primary btn-xs"  title="Cetak" title="Cetak" data-toggle="tooltip" target="_BLANK"><span class="glyphicon glyphicon-print"></span> 
                     
                     </a>
                     <a onclick="return confirm('Yakin Hapus?')" href="cetakP.php?id=<?php echo (int)$sale['id'];?>&status=deleteKc" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
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
      <form action="pengajuan_ben.php" method="POST">
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
      <form action="pengajuan_ben.php" method="POST">
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
      <form action="pengajuan_ben.php" method="POST">
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
