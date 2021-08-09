<?php
$page_title = 'MAK';
require_once('includes/load.php');
  // Checkin What level user has permission to view this page
page_require_level(6);
?>
<?php
$user=find_by_id('users',$_SESSION['user_id']);
$satker = find_all_global('satker',$user['id_satker'],'id');

$sales = find_all_global_tahun('akun',$user['id_satker'],'id_satker',$satker[0]['tahun']);
?>
<?php
if(isset($_POST['submit_mak'])){
 $req_fields = array('tahun','kode','id_satker','uraian');
 validate_fields($req_fields);
 if(empty($errors)){
   $tahun   = remove_junk($db->escape($_POST['tahun']));
   $kode = remove_junk($db->escape($_POST['kode']));
   $id_satker = remove_junk($db->escape($_POST['id_satker']));
   $uraian = remove_junk($db->escape($_POST['uraian']));
   $date    = make_date();
   $query  = "INSERT INTO akun (";
   $query .=" tahun,mak,keterangan,id_satker";
   $query .=") VALUES (";
   $query .=" '{$tahun}','{$kode}','{$uraian}','{$id_satker}'";
   $query .=")";
   if($db->query($query)){
     $session->msg('s',"MAK added ");
     if($user['user_level']==2){
      redirect('mak.php', false);
    }else{
     redirect('mak.php', false);
   }
 } else {
   $session->msg('d',' Sorry failed to added!');
   if($user['user_level']==2){
    redirect('mak.php', false);
  }else{
   redirect('mak.php', false);
 }
}

} else{
 $session->msg("d", $errors);
 redirect('mak.php',false);
}

}

if(isset($_POST['update_mak'])){
  $req_fields = array('tahun','kode','uraian','id');
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id'])); 
    $tahun   = remove_junk($db->escape($_POST['tahun']));
    $kode = remove_junk($db->escape($_POST['kode']));
    $uraian = remove_junk($db->escape($_POST['uraian']));
    $date    = make_date();
    $query  = "UPDATE akun SET ";
    $query .=" tahun='{$tahun}',mak='{$kode}',keterangan='{$uraian}'";
    $query .=" WHERE id='{$id}'";
    if($db->query($query)){
      $session->msg('s',"MAK Update");
      if($user['user_level']==2){
       redirect('mak.php', false);
     }else{
      redirect('mak.php', false);
    }
  } else {
    $session->msg('d',' Sorry failed to added!');
    if($user['user_level']==2){
     redirect('mak.php', false);
   }else{
    redirect('mak.php', false);
  }
}

} else{
  $session->msg("d", $errors);
  redirect('mak.php',false);
}

}



?>

<?php

if($_GET['status']=='delete_akun'){
  $d_sale = find_by_id('akun',(int)$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$d_sale){
    $session->msg("d","Missing akun id.");
    if($user['user_level']==2){
      redirect('mak.php', false);
    }else{
      redirect('mak.php');
    }
  }
  ?>
  <?php
  $delete_id = delete_by_id('akun',(int)$d_sale['id']);
  if($delete_id){
    $session->msg("s","akun deleted.");
    if($user['user_level']==2){
      redirect('mak.php', false);
    }else{
      redirect('mak.php');
    }
  } else {
    $session->msg("d","akun deletion failed.");
    if($user['user_level']==2){
      redirect('mak.php', false);
    }else{
      redirect('mak.php');
    }
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
          <span>All MAK</span>
        </strong>
        <div class="pull-right">
         <!-- <a href="#" class="btn btn-primary" id="mak" data-toggle="modal" data-target="#TambahMAK">Tambah</a>
          <a href="#" class="btn btn-success" id="import"  data-toggle="modal" data-target="#UploadCSV" data-id="<?=$_GET['id'];?>" >Import Data</a>-->
        </div>
      </div>
      <div class="panel-body" style="width:100%">
        <table id="tabel" class="table table-bordered table-striped" style="width:100%;">
          <thead>
            <tr>
              <th class="text-center" style="width: 5%;">#</th>
              <th class="text-center" style="width: 15%;"> Tahun</th>
              <th class="text-center" style="width: 25%;"> Kode </th>
              <th class="text-center" style="width: 40%;"> Uraian </th>             
              <th class="text-center" style="width: 15%;"> Actions </th>
            </tr>
          </thead>
          <tbody>
           <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo $sale['tahun']; ?></td>
               <td class="text-center"><?php echo $sale['mak'];  ?></td>  
               <td class="text-center"><?php echo $sale['keterangan']; ?></td>

               <td class="text-center">
                <div class="btn-group">
                 <!--<a href="#" title="Edit" <?php $akun = find_by_id('akun',$sale['id']);?> class="btn btn-warning btn-xs" id="editakun" data-toggle="modal" 
                   data-target="#UpdateMAK" data-id='<?=$akun['id'];?>' data-tahun='<?=$akun['tahun'];?>' data-kode='<?=$akun['mak'];?>' data-uraian='<?=$akun['keterangan'];?>'>
                   <span class="glyphicon glyphicon-edit"></span>
                 </a>
                 <a onclick="return confirm('Yakin Hapus?')" href="mak.php?id=<?php echo (int)$sale['id'];?>&status=delete_akun" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                   <span class="glyphicon glyphicon-trash"></span>
                 </a>-->
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


<!-- Modal input nodin-->
<div class="modal fade" id="TambahMAK" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah MAK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="mak.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" placeholder="tahun">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Kode</label>
            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Uraian</label>
            <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Uraian">
            <input type="hidden" class="form-control" id="id_satker" value="<?php $users=find_by_id('users',$_SESSION['user_id']);echo $users['id_satker'] ;?>" name="id_satker" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="submit_mak" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit nodin-->
<div class="modal fade" id="UpdateMAK" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update MAK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="mak.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" placeholder="tahun">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Kode</label>
            <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Uraian</label>
            <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Uraian">
            <input type="hidden" class="form-control" id="id" name="id" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="update_mak" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Upload-->
<div class="modal fade" id="UploadCSV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data MAK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="import.php" name="upload_excel" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
         <div class="form-group">
          <label for="exampleInputEmail1">Masukkan File CSV</label>
          <input type="file" class="form-control" id="sptb" name="file" placeholder="sptb"> 
        </div>
        <input type="hidden" class="form-control" id="id" name="id" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="ImportMAK" value="Upload">
      </div>
    </form>
  </div>
</div>
</div>
<?php include_once('layouts/footer.php'); ?>
