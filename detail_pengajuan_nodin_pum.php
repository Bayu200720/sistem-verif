<?php
  $page_title = 'Detail Pengajuan';
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
if($_GET['status'] == 'delete'){
    echo "okeee detete";
  $d_sale = find_by_id('detail_pengajuan_pum',(int)$_GET['id']);
  if(!$d_sale){
    $session->msg("d","Missing sale id.");
    header("Refresh:1");
  }
?>
<?php

  $delete_id = delete_by_id('detail_pengajuan_pum',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","pengajuan deleted.");

      redirect('detail_pengajuan_nodin_pum.php?id='.$d_sale['id_pengajuan_pum']);
  } else {
      $session->msg("d","pengajuan deletion failed.");
      redirect('detail_pengajuan_nodin_pum.php?id='.$d_sale['id_pengajuan_pum']);
  }
}
?>

<?php


$sales = find_all_global('detail_pengajuan_pum',$_GET['id'],'id_pengajuan_pum');
$id = find_all_global('pengajuan',$_GET['id'],'id_nodin');
$pengajuan = find_by_id('detail_pengajuan_pum',(int)$_POST['id_akun']);

$nodin = find_all_global('pengajuan_pum',$_GET['id'],'id');
$idi= $_GET['id'];

if(isset($_POST['add_transaksi'])){
     $id_akun= remove_junk($db->escape($_POST['id_akun']));
     $teks5 = $_POST['nominal'];
     $nominal1 = preg_replace("/[^0-9]/", "", $teks5);
     $nominal = remove_junk($db->escape( $nominal1));
     $id_pengajuan_pum = remove_junk($db->escape($_POST['id_pengajuan_pum']));
     $query  = "INSERT INTO detail_pengajuan_pum (";
     $query .=" id_akun,nominal,id_pengajuan_pum ";
     $query .=") VALUES (";
     $query .=" '{$id_akun}', '{$nominal}', '{$id_pengajuan_pum}'";
     $query .=")";
    $result = $db->query($query);
    $session->msg('s',' Berhasil di Batalkan');
    if($user['user_level']==5){
  redirect('detail_pengajuan_nodin_pum.php?id='.$id_pengajuan_pum);
  }else{
  redirect('detail_pengajuan_nodin_pum.php?id='.$id_pengajuan_pum, false);
  }
}

if(isset($_POST['update_transaksi'])){
    $id_akun= remove_junk($db->escape($_POST['id_akun']));
    $teks5 = $_POST['nominal'];
    $nominal1 = preg_replace("/[^0-9]/", "", $teks5);
    $nominal = remove_junk($db->escape( $nominal1));
    $id= remove_junk($db->escape($_POST['id']));
    $id_pengajuan_pum = remove_junk($db->escape($_POST['id_pengajuan_pum']));
    $query  = "UPDATE detail_pengajuan_pum SET ";
    $query .=" id_akun='{$id_akun}',nominal='{$nominal}' ";
    $query .=" WHERE id='{$id}'";
   $result = $db->query($query);
   $session->msg('s',' Berhasil di Batalkan');
   if($user['user_level']==5){
 redirect('detail_pengajuan_nodin_pum.php?id='.$id_pengajuan_pum);
 }else{
 redirect('detail_pengajuan_nodin_pum.php?id='.$id_pengajuan_pum, false);
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
            <span><a href="pengajuan_UP.php">All Nodin Pengajuan</a> / <a href="detail_pengajuan_nodin_pum.php?id=<?=$_GET['id']?>">All Detail Pengajuan</a></span>
          </strong>
          <div class="pull-right">
          <?php if($nodin[0]['status']!=1){?>
            <a onclick="Add_detail(<?=$idi;?>);" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Add</a>
            <?php } ?>
          </div>
        </div>
        <div class="panel-body" style="width:100%">
          <table id="tabel" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center"> MAK </th>
                <th class="text-center"> Nominal </th>
                <th class="text-center"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr class="text-center"> 
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php $akun =find_by_id('akun',$sale['id_akun']); echo $akun['mak'].'-'.$akun['keterangan']; ?></td>
               <td><?php echo rupiah($sale['nominal']); ?></td>
            

               <td class="text-center">
                  <div class="btn-group">
                  <?php if($nodin[0]['status']!=1){?>
                     <a  onclick="update_detail(<?=(int)$sale['id'];?>);" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-pencil"></span>
                     </a>
                     <?php } ?>
                     <?php if($nodin[0]['status']!=1){?>
                     <a onclick="return confirm('Yakin Hapus?')" href="detail_pengajuan_nodin_pum.php?id=<?php echo (int)$sale['id'];?>&status=delete" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
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

  <!-- Modal Detail ADD Transaksi-->
<div class="modal fade" id="Detail_Nodin" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:50vw">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Detail Pengajuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="Body_dp" style="width:100%;">
      
    </div>
    </div>
  </div>
</div>

      <!-- Modal Edit Transaksi-->
<div class="modal fade" id="Update" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:50vw">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Detail Pengajuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="Body_edit" style="width:100%;">
      
    </div>
    </div>
  </div>
</div>



<?php include_once('layouts/footer.php'); ?>







