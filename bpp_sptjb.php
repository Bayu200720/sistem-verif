<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
?>
<?php
 //delete pencairan
 //var_dump($_GET['status']);exit();
$status= $_GET['status'];
//var_dump(($status === 'pencairan'));exit();
 if( isset($_GET['status']) and $status==="pencairan"){
   // var_dump($status);exit();
    $d_sale = find_by_id('pencairan',(int)$_GET['id']);

    if(!$d_sale){
                redirect('bpp_sptjb', false);
    }

    $delete_id = delete_by_id('pencairan',(int)$d_sale['id']);
    if($delete_id){
        $session->msg("s","pencairan deleted.");
        if($user['user_level']==2){
                redirect('bpp_sptjb', false);
            }else{
              redirect('bpp_sptjb');
          }
    } else {
        $session->msg("d","pencairan deletion failed.");
            if($user['user_level']==2){
                redirect('bpp_sptjb', false);
            }else{
              redirect('bpp_sptjb');
            }
    }

}


if(isset($_POST['cetak'])){
   // var_dump($_POST['id']);exit();
    $req_fields = array('nominal', 'tanggal','id_satker' );
    validate_fields($req_fields);
        if(isset($_POST['id'])){
          
          $sql  = "INSERT INTO `k_cair` (`id`, `time_add`) VALUES (NULL, current_timestamp())";
          $result = $db->query($sql);
            $cair = find_DESC('k_cair');
           $status= $cair['id'];
           $id= implode(',',$_POST['id']);
        $supdate = "UPDATE `pencairan` SET `status` = '{$status}' WHERE `id` in ($id)";
        //echo $supdate; exit();
        $db->query($supdate);
        $session->msg('s',"Pencairan updated.");
        redirect('bpp_sptjb',false);
        } else {
           $session->msg("d", $errors);
           redirect('bpp_sptjb',false);
        }
  }

if(isset($_POST['pencairan'])){
    $req_fields = array('nominal', 'tanggal','id_satker','uraian' );
    validate_fields($req_fields);
        if(empty($errors)){
          $uraian     = $db->escape($_POST['uraian']);
          $tanggal     = $db->escape($_POST['tanggal']);
          $nominal     = $db->escape($_POST['nominal']);
          $id_satker     = $db->escape($_POST['id_satker']);
          $keterangan     = $db->escape($_POST['keterangan']);
          // print_r($uraian);exit();
          
          $sql  = "INSERT INTO pencairan(spm,nominal,tanggal,keterangan,id_satker) VALUES ('{$uraian}',{$nominal},'{$tanggal}','{$keterangan}',{$id_satker})";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                   //$h= update_product_qty_ok($p_id);
                      $session->msg('s',"Pencairan updated.");
                    redirect('bpp_sptjb', false);
                  } else {
                    $session->msg('d',' Sorry failed to updated!');
                    redirect('bpp_sptjb', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('bpp_sptjb',false);
        }
  }

  

  if(isset($_POST['UpdatePanjar'])){
     // var_dump($_POST); exit();
    $req_fields = array('tanggal','id','nominal','id_satker' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id     = $db->escape($_POST['id']);
          $uraian     = $db->escape($_POST['uraian']);
          $nominal     = $db->escape($_POST['nominal']);
          $tanggal     = $db->escape($_POST['tanggal']);
          $id_satker     = $db->escape($_POST['id_satker']);
          $keterangan     = $db->escape($_POST['keterangan']);
          
          $sql  = "UPDATE pencairan SET";
          $sql .= " spm='{$uraian}',nominal='{$nominal}',tanggal='{$tanggal}',keterangan='{$keterangan}',id_satker={$id_satker}";
          $sql .= " WHERE id ='{$p_id}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                   //$h= update_product_qty_ok($p_id);
                      $session->msg('s',"Pencairan updated.");
                    redirect('bpp_sptjb', false);
                  } else {
                    $session->msg('d',' Sorry failed to updated!');
                    redirect('bpp_sptjb', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('bpp_sptjb',false);
        }
  }



if(isset($_POST['update_sp2d'])){
  $req_fields = array('sp2d', 'id' );
  validate_fields($req_fields);
      if(empty($errors)){
        $p_id     = $db->escape($_POST['id']);
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

$sales = find_all_global('pencairan',0,'status');

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
            <span>All Pencairan</span>
          </strong>
          <div class="pull-right">
          <a href="#" class="btn btn-primary" id="editsp2d" data-toggle="modal" data-target="#exampleModal" data-id='<?=$sale['id'];?>'>Input Panjar</a>
          </div>
        </div>
        <div class="panel-body"  style="width: 100%;">
          <table id="tabel" class="table table-bordered table-striped" style="width: 100%;">
            <thead>
              <tr>
                <th> Tanggal </th>
                <th> Nomor SPM </th>
                <th class="text-center" style="width: 15%;"> Nomor SPTJB</th>
                <th class="text-center" style="width: 15%;"> Jumlah</th>          
                <th class="text-center" style="width: 15%;">Status</th>
                <th class="text-center" style="width: 15%;">Aksi</th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php $pengajuan= find_by_id('pengajuan',$sale['id_pengajuan']);$nodin=find_by_id('nodin',$pengajuan['id_nodin']);
               $jenis=find_by_id('jenis',$nodin['id_jenis']); echo $jenis['keterangan']; ?></td>
               <td class="text-center"><?=$sale['tanggal']; ?></td>
               <td class="text-center"><?=rupiah($sale['nominal']);?></td>
               <td class="text-center"><?php $satker = find_by_id('satker',$sale['id_satker']); echo $satker['keterangan'];?></td>
               <td class="text-center"><?=$sale['keterangan'];?></td>
               <td style="display: none"></td>
            <td class="text-center">
                 <div class="btn-group">
                 
                     <a href="#" id="editpencairan" data-toggle="modal" data-target="#EditPanjar" data-id='<?=$sale['id'];?>' data-keterangan='<?=$sale['keterangan'];?>' data-tanggal='<?=$sale['tanggal'];?>' data-nominal='<?=$sale['nominal'];?>' data-spm='<?=$sale['spm'];?>' data-id_satker="<?=$sale['id_satker']?>" data-uraian="<?=$sale['spm']?>" class="btn btn-warning btn-xs" class="btn-edit" title="Edit" >
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a onclick="return confirm('Yakin Hapus?')" href="bpp_sptjb?id=<?php echo (int)$sale['id'];?>&status=pencairan" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
            </td>
                
             </tr>
            <?php endforeach;?>
            <input type="submit" name="cetak" class="btn btn-success" value="Cetak">
            </form>
           </tbody>
         </table>
        
        </div>
      </div>
    </div>
  </div>



<!-- Modal -->
<div class="modal fade" id="EditPanjar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Panjar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="bpp_sptjb" method="POST">
        <div class="modal-body">
          <div class="form-group">
                <label for="exampleInputEmail1">Uraian</label>
                <select name="uraian" id="uraian" class="form-control">
                  <?php 
                    $data = find_all('master_panjar');
                    foreach($data as $key => $value):?>
                      <option value="<?php echo $value['name'] ?>"><?php echo $value['name'] ?></option>
                  <?php endforeach;?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal">
                <input type="hidden" class="form-control" id="id" name="id" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nominal</label>
                <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal">
            </div>
            <div class="form-group">
                    <label for="exampleInputEmail1">Satker</label>
                        <select class="form-control" id="id_satker" name="id_satker">
                            <option value="">Pilih Satker</option>
                            <?php $jenis = find_all('satker');?>
                            <?php  foreach ($jenis as $j): ?>
                            <option value="<?php echo (int)$j['id'] ?>">
                                <?php echo $j['keterangan'] ?></option>
                            <?php endforeach; ?>
                        </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="UpdatePanjar">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal input sp2d-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Panjar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="bpp_sptjb" method="POST">
      <div class="modal-body">
        
      <div class="form-group">
          <label for="exampleInputEmail1">Uraian</label>
          <select name="uraian" class="form-control">
            <?php 
              $data = find_all('master_panjar');
              foreach($data as $key => $value):?>
                <option value="<?php echo $value['name'] ?>"><?php echo $value['name'] ?></option>
            <?php endforeach;?>
          </select>
        </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Tanggal</label>
        <input type="date" class="form-control" id="sp2d" name="tanggal" placeholder="tanggal">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Nominal</label>
        <input type="text" class="form-control" id="sp2d" name="nominal" placeholder="Nominal">
       </div>
       <div class="form-group">
             <label for="exampleInputEmail1">Satker</label>
                  <select class="form-control" name="id_satker">
                      <option value="">Pilih Satker</option>
                      <?php $jenis = find_all('satker');?>
                    <?php  foreach ($jenis as $j): ?>
                      <option value="<?php echo (int)$j['id'] ?>">
                        <?php echo $j['keterangan'] ?></option>
                    <?php endforeach; ?>
                </select>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Keterangan</label>
        <input type="text" class="form-control" id="sp2d" name="keterangan" placeholder="Keterangan">
       </div>
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="pencairan" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

<script>
  $(document).ready(function(){
    $('.btn-edit').on('click', function(){
      $('#id_satker').val($(this).data('id_satker'));
      $('#uraian').val($(this).data('uraian'));
    });
  })
</script>