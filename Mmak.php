<?php
$page_title = 'MAK';
require_once('includes/load.php');
  // Checkin What level user has permission to view this page
page_require_level(6);
?>
<?php
$user=find_by_id('users',$_SESSION['user_id']);
$satker = find_all_global('satker',$user['id_satker'],'id');

$tahun = date('Y');

$sales = find_all_global('akun',$tahun,'tahun'); 
?>
<?php
if(isset($_POST['submit_mak'])){
 $req_fields = array('tahun','kode','id_satker','uraian','nominal');
 validate_fields($req_fields);
 if(empty($errors)){
   $tahun   = remove_junk($db->escape($_POST['tahun']));
   $kode = remove_junk($db->escape($_POST['kode']));
   $id_satker = remove_junk($db->escape($_POST['id_satker']));
   $uraian = remove_junk($db->escape($_POST['uraian']));
   $nominal = remove_junk($db->escape($_POST['nominal']));
   $date    = make_date();
   $query  = "INSERT INTO akun (";
   $query .=" tahun,mak,keterangan,id_satker,nominal";
   $query .=") VALUES (";
   $query .=" '{$tahun}','{$kode}','{$uraian}','{$id_satker}','{$nominal}'";
   $query .=")";
   if($db->query($query)){
     $session->msg('s',"MAK added ");
     if($user['user_level']==2){
      redirect('Mmak.php', false);
    }else{
     redirect('Mmak.php', false);
   }
 } else {
   $session->msg('d',' Sorry failed to added!');
   if($user['user_level']==2){
    redirect('Mmak.php', false);
  }else{
   redirect('Mmak.php', false);
 }
}

} else{
 $session->msg("d", $errors);
 redirect('Mmak.php',false);
}

}

if(isset($_POST['update_mak'])){
  $req_fields = array('tahun','kode','uraian','id','nominal');
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id'])); 
    $tahun   = remove_junk($db->escape($_POST['tahun']));
    $kode = remove_junk($db->escape($_POST['kode']));
    $uraian = remove_junk($db->escape($_POST['uraian']));
    $id_satker = remove_junk($db->escape($_POST['id_satker']));
    $nominal = remove_junk($db->escape($_POST['nominal']));
    
    if($id_satker==''){
      $akun=find_all_global(akun,$id,'id');
      $id_satker = $akun[0]['id_satker'];
    }
    $date    = make_date();
    $query  = "UPDATE akun SET ";
    $query .=" tahun='{$tahun}',mak='{$kode}',keterangan='{$uraian}',id_satker='{$id_satker}',nominal='{$nominal}'";
    $query .=" WHERE id='{$id}'";
    if($db->query($query)){
      $session->msg('s',"MAK Update");
      if($user['user_level']==2){
       redirect('Mmak.php', false);
     }else{
      redirect('Mmak.php', false);
    }
  } else {
    $session->msg('d',' Sorry failed to added!');
    if($user['user_level']==2){
     redirect('Mmak.php', false);
   }else{
    redirect('Mmak.php', false);
  }
}

} else{
  $session->msg("d", $errors);
  redirect('Mmak.php',false);
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
      redirect('Mmak.php', false);
    }else{
      redirect('Mmak.php');
    }
  }
  ?>
  <?php
  $delete_id = delete_by_id('akun',(int)$d_sale['id']);
  if($delete_id){
    $session->msg("s","akun deleted.");
    if($user['user_level']==2){
      redirect('Mmak.php', false);
    }else{
      redirect('Mmak.php');
    }
  } else {
    $session->msg("d","akun deletion failed.");
    if($user['user_level']==2){
      redirect('Mmak.php', false);
    }else{
      redirect('Mmak.php');
    }
  }
}
?>

<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
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
          <a href="#" class="btn btn-primary" id="mak" data-toggle="modal" data-target="#TambahMAK"><span class="glyphicon glyphicon-plus">ADD</span></a>
          <a href="#" class="btn btn-success" id="import"  data-toggle="modal" data-target="#UploadCSV" data-id="<?=$_GET['id'];?>" ><span class="glyphicon glyphicon-upload"></span></a>
          <a href="uploads/data_excle/mak.csv">Excle</a>
        </div>
      </div>
      <div class="panel-body" style="width:100%">
        <table id="tabel" class="table table-bordered table-striped" style="width:100%;">
          <thead>
            <tr>
              <th class="text-center" >#</th>
              <th class="text-center" > Tahun</th>
              <th class="text-center" > Kode </th>
              <th class="text-center" > Uraian </th>
              <th class="text-center" > Satker </th>
              <th class="text-center" > Nominal </th>
              <th class="text-center"> Actions </th>
            </tr>
          </thead>
          <tbody>
           <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo $sale['tahun']; ?></td>
               <td class="text-center"><?php echo $sale['mak'];  ?></td>
               <td class="text-center"><?php echo $sale['keterangan']; ?></td>
               <td class="text-center"><?php $satker1=find_all_global('satker',$sale['id_satker'],'id');echo  $satker1[0]['keterangan'] ;  ?></td>  
               <td class="text-center"><?php echo rupiah($sale['nominal']); ?></td> 
               <td class="text-center">
                <div class="btn-group">
                 <a href="#" title="Edit" <?php $akun = find_by_id('akun',$sale['id']);?> class="btn btn-warning btn-xs" id="editakun" data-toggle="modal" 
                   data-target="#UpdateMAK" data-id='<?=$akun['id'];?>' data-tahun='<?=$akun['tahun'];?>' data-kode='<?=$akun['mak'];?>' data-uraian='<?=$akun['keterangan'];?>'>
                   <span class="glyphicon glyphicon-pencil"></span>
                 </a>
                 <a onclick="return confirm('Yakin Hapus?')" href="Mmak.php?id=<?php echo (int)$sale['id'];?>&status=delete_akun" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
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
      <form action="Mmak.php" method="POST">
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
          <div class="form-group">
            <label for="exampleInputEmail1">Nominal</label>
            <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Nominal">
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
      <form action="Mmak.php" method="POST">
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
           
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nominal</label>
            <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Nominal">
          </div>
          <div class="form-group">
              <label for="exampleInputEmail1">Satker</label>  
                  <select class="form-control" name="id_satker" required>
                      <option value="">Pilih Satker</option>
                      <?php $jenis = find_all('satker');?>
                    <?php  foreach ($jenis as $j): ?>
                      <option value="<?php echo (int)$j['id'] ?>">
                        <?php echo $j['keterangan'] ?></option>
                    <?php endforeach; ?>
              </select>
  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="submit_mak" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>



<?php include_once('layouts/footer.php'); ?>
