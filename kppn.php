<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $user = find_by_id('users',$_SESSION['user_id']);
   if($user['user_level'] == 2){ //echo "ok 3";exit();
   page_require_level(3); 
   }else if($user['user_level'] == 4 ){ //echo "7";exit();
     page_require_level(4); 
   }else{ //echo "3";exit();
     page_require_level(3); 
   }
?>
<?php
$sales =find_pengajuanok();
$id = find_all_global('pengajuan',$_GET['id'],'id_nodin');
$idi= $_GET['id'];
?>

<?php

if(isset($_POST['update_penolakan'])){
  $req_fields = array('keterangan');
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id']));
    $keterangan   = remove_junk($db->escape($_POST['keterangan']));
    $date    = make_date();
    $query  = "UPDATE pengajuan SET ";
    $query .=" penolakan_kppn= '{$keterangan}'";
    $query .=" WHERE id='{$id}'";
    if($db->query($query)){
      $session->msg('s',"Keterangan penolakan KPPN Updated ");
      if($user['user_level']==2){
       redirect('kppn.php', false);
      }else{
      redirect('kppn.php', false);
      }
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      if($user['user_level']==2){
       redirect('kppn.php', false);
     }else{
        redirect('kppn.php', false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('kppn.php',false);
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
                  redirect('kppn.php', false);
                } else {
                  $session->msg('d',' Sorry failed to updated!');
                  redirect('kppn.php', false);
                }
      } else {
         $session->msg("d", $errors);
         redirect('kppn.php',false);
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
        <div class="panel-body" style="width:100%">
               <table id="tabel" class="table table-bordered table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center" > SPM </th>
                      <th class="text-center" > Histori </th>
                      <th class="text-center" > Jenis Pengajuan</th>
                      <th class="text-center" > Satker </th>
                      <th class="text-center" > Tanggal </th>
                      <th class="text-center" > Nominal Pengajuan </th>
                      <th class="text-center" > Status </th>
                      <th class="text-center"> Actions </th>
                  </tr>
                  </thead>
                <tbody>
                  <?php $tot=0; foreach ($sales as $sale):?>
                  <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td class="text-center" >
                      <?php echo remove_junk($sale['SPM']); ?>
                      
                    </td>
                    <td class="text-center">
                        <a href="histori.php?id=<?=$sale['id']?>" class="btn btn-primary">Histori
                        <?php $hsl = find_count_global('histori',$sale['id'],'id_pengajuan'); 
                            if($hsl[0]['jml'] > 0){
                              echo '<span class="badge">'.$hsl[0]['jml'].'</span>';
                              } ?>
                        </a>
                        
                    </td>
                    <td class="text-center"><?php $nodin=find_by_id('nodin',$sale['id_nodin']);$jenis=find_by_id('jenis',$nodin['id_jenis']); echo $jenis['keterangan']?> </td>
                    <td class="text-center" ><?php $nodin=find_by_id('nodin',$sale['id_nodin']);$satker=find_by_id('satker',$nodin['id_satker']); echo $satker['keterangan']?></td>
                    <td class="text-center"><?php $nodin= find_by_id('nodin',$sale['id_nodin']);echo $nodin['tanggal']; ?></td>
                    <td class="text-center" ><?php $tp=find_NominalPengajuan($sale['id']);echo rupiah($tp['jum']);?></td>
                    <td class="text-center" >
                          <?php if($sale['status_kppn'] == 0){
                                  echo "<span class='glyphicon glyphicon-remove-circle btn-danger'></span>Belom Proses ";
                              }else{
                                  echo "<span class='glyphicon glyphicon-ok-circle btn-success'></span>Telah di Proses ";
                              }	             		
                          ?>
                     </td>
                    <td class="text-center">
                        <div class="btn-group">
                          <a href="detail_dokumen_ses.php?id=<?=$sale['id']?>" class="btn btn-success btn-xs" title="Detail status Pengajuan" data-toggle="tooltip" > <span class="glyphicon glyphicon-folder-open"></span></a>
                          <a href="detail_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail Pengajuan" data-toggle="tooltip">
                            <span class="glyphicon glyphicon-eye-open"></span>
                          </a>
                  
                        </div>
                    </td>
                  </tr>
                  <?php $tot+=$tp['jum']; endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                      <th class="text-center" >#</th>
                      <th class="text-center" >  </th>
                      <th class="text-center" >  </th>
                      <th class="text-center" >  </th>
                      <th class="text-center" >  </th>
                      <th class="text-center" >  <?=rupiah($tot);?> </th>
                      <th class="text-center" > Status </th>
                      <th class="text-center" > </th>
                  </tr>
                  </tfoot>
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

<!-- Modal Edit Penolakan-->
<div class="modal fade" id="PenolakanKPPN" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Penolakan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="kppn.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Masukkan Penolakan KPPN</label>
        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="keterangan"> 
       </div>
       <input type="hidden" class="form-control" id="id" name="id" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update_penolakan" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>


<?php include_once('layouts/footer.php'); ?>
