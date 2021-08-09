<?php
$page_title = 'Hostori';
require_once('includes/load.php');
  // Checkin What level user has permission to view this page
page_require_level(6);
?>
<?php
$user=find_by_id('users',$_SESSION['user_id']);
$satker = find_all_global('satker',$user['id_satker'],'id');
$sales = find_all_global_tahun('histori',$_GET['id'],'id_pengajuan',$satker[0]['tahun']);
?>
<?php
if(isset($_POST['submit_mak'])){
 $req_fields = array('tahun','komentar','id_user','id_pengajuan');
 validate_fields($req_fields);
 if(empty($errors)){
   $tahun   = remove_junk($db->escape($_POST['tahun']));
   $id_user = remove_junk($db->escape($_POST['id_user']));
   $komentar = remove_junk($db->escape($_POST['komentar']));
   $id_pengajuan = remove_junk($db->escape($_POST['id_pengajuan']));
  
   $query  = "INSERT INTO histori (";
   $query .=" tahun,komentar,id_user,id_pengajuan";
   $query .=") VALUES (";
   $query .=" '{$tahun}','{$komentar}','{$id_user}','{$id_pengajuan}'";
   $query .=")";
   if($db->query($query)){
     $session->msg('s',"Komentar added ");
     if($user['user_level']==2){
      redirect('histori.php?id='.$id_pengajuan, false);
    }else{
     redirect('histori.php?id='.$id_pengajuan, false);
   }
 } else {
   $session->msg('d',' Sorry failed to added!');
   if($user['user_level']==2){
    redirect('histori.php?id='.$id_pengajuan, false);
  }else{
   redirect('histori.php?id='.$id_pengajuan, false);
 }
}

} else{
 $session->msg("d", $errors);
 redirect('histori.php?id='.$id_pengajuan,false);
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
          <span>All Histori</span>
        </strong>
        <div class="pull-right">
         <a href="#" class="btn btn-primary" id="komentar" data-toggle="modal" data-target="#TambahMAK" data-id='<?=$_GET['id'];?>'>Tambah</a>
        </div>
      </div>
      <div class="panel-body" style="width:100%">
        <table id="tabel" class="table table-bordered table-striped" style="width:100%;">
          <thead>
            <tr>
              <th class="text-center" style="width: 5%;">#</th>
              <th class="text-center" style="width: 15%;"> User</th>
              <th class="text-center" style="width: 25%;"> Komentar </th>         
            </tr>
          </thead>
          <tbody>
           <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php $user=find_by_id('users',$sale['id_user']); echo $user['name']?></td>
               <td class="text-center"><?php echo $sale['komentar'];  ?></td>  
           </tr>
         <?php endforeach;?>
       </tbody>
     </table>
   </div>
 </div>
</div>
</div>


<!-- Modal input komentar-->
<div class="modal fade" id="TambahMAK" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Komentar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="histori.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Uraian</label>
            <textarea class="form-control" name="komentar"></textarea>   
            <input type="hidden" class="form-control" value="<?php echo $_SESSION['user_id'];?>" name="id_user">
            <input type="hidden" name="tahun" value="<?php $th=date('Y'); echo $th;?>">
            <input type="hidden" name="id_pengajuan" id="id">
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

<?php include_once('layouts/footer.php'); ?>
