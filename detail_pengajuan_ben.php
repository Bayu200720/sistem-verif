<?php
  $page_title = 'All Detail Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   // Checkin What level user has permission to view this page
   $user = find_by_id('users',$_SESSION['user_id']);
  // var_dump($user['user_level']);
    if($user['user_level'] == 2){ //echo "ok 3";exit();
    page_require_level(3); 
    }else if($user['user_level'] == 7 ){ //echo "7";exit();
      page_require_level(7); 
    }else if($user['user_level'] == 6){ //echo "3";exit();
      page_require_level(6); 
    }else if($user['user_level'] == 5){ //echo "3";exit();
      page_require_level(5);
     
    }else{
      page_require_level(3);
    }  
  ?>
<?php
$sales = find_detail($_GET['id']);
$sales1 = find_all_global('pengajuan',$_GET['id'],'id');

if($_GET['status'] == 'h'){
  $id =$_GET['id'];
  $query="DELETE FROM detail_pengajuan WHERE id_pengajuan =".$id;
  $hasil=$db->query($query);
  
  if($hasil){
      $session->msg('s',"Delete Success ");
      if($user['user_level']==2){
      redirect('detail_pengajuan.php?id='.$id, false);
      }else{
      redirect('detail_pengajuan.php?id='.$id, false);
      }
  } else {
      $session->msg('d',' Sorry failed to added!');
      if($user['user_level']==2){
      redirect('detail_pengajuan.php?id='.$id, false);
  }else{
      redirect('detail_pengajuan.php?id='.$id, false);
  }
  }
}



if(isset($_POST['update_kekurangan'])){
  $req_fields = array('verifikasi');
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id']));
    $verifikasi   = remove_junk($db->escape($_POST['verifikasi']));

    $query  = "UPDATE detail_pengajuan SET ";
    $query .=" keterangan_verifikasi= '{$verifikasi}'";
    $query .=" WHERE id='{$id}'";
      $pengajuan = find_by_id('detail_pengajuan',$id);


    if($db->query($query)){
      $session->msg('s',"Kekurangan Updated ");
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$pengajuan['id_pengajuan'], false);
      }else{
      redirect('detail_pengajuan.php?id='.$pengajuan['id_pengajuan'], false);
      }
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$pengajuan['id_pengajuan'], false);
     }else{
        redirect('detail_pengajuan.php?id='.$pengajuan['id_pengajuan'], false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('detail_pengajuan.php?id='.$pengajuan['id_pengajuan'],false);
  }

}

if(isset($_POST['update_kekuranganKsV'])){
  $req_fields = array('verifikasi');
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id']));
    $verifikasi   = remove_junk($db->escape($_POST['verifikasi']));

    $query  = "UPDATE detail_pengajuan SET ";
    $query .=" keterangan_k_verifikasi= '{$verifikasi}'";
    $query .=" WHERE id='{$id}'";
      $pengajuan = find_by_id('detail_pengajuan',$id);


    if($db->query($query)){
      $session->msg('s',"Kekurangan Updated ");
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$pengajuan['id_pengajuan'], false);
      }else{
      redirect('detail_pengajuan.php?id='.$pengajuan['id_pengajuan'], false);
      }
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$pengajuan['id_pengajuan'], false);
     }else{
        redirect('detail_pengajuan.php?id='.$pengajuan['id_pengajuan'], false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('detail_pengajuan.php?id='.$pengajuan['id_pengajuan'],false);
  }

}



if($_GET['v']=='insert'){

  $verif = find_by_filed('verifikasi',$_GET['id'],'id_pengajuan');

  $id_pengajuan = $_GET['id'];
  $update ="UPDATE `pengajuan` SET `status_verifikasi`=".$_SESSION['user_id']." WHERE `pengajuan`.`id` =".$id_pengajuan;
  //    echo $update; exit();
  $db->query($update);
  if($verif == NULL){
    $query = "INSERT INTO verifikasi (`id_pengajuan`) VALUES (".$id_pengajuan.")";
    if($db->query($query)){
      $session->msg('s',"Sukses insert verifikasi ");
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
      }else{
      redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
      }
    } else {
      $session->msg('d',' Sorry failed to Insert!');
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
     }else{
        redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('detail_pengajuan.php?id='.$id_pengajuan,false);
  }

}

if($_GET['s']=='ok'){

  $verif = find_by_id('verifikasi',$_GET['id']);

  $id_verif = $_GET['id'];
  $update ="UPDATE `verifikasi` SET `status_pengajuan`= 1 WHERE `id` =".$id_verif;
    // echo $update; exit();

    if($db->query($update)){
      $session->msg('s',"Sukses verifikasi di terima ");
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$verif['id_pengajuan'], false);
      }else{
      redirect('detail_pengajuan.php?id='.$verif['id_pengajuan'], false);
      }
    } else {
      $session->msg('d',' Sorry failed to Insert!');
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$verif['id_pengajuan'], false);
     }else{
        redirect('detail_pengajuan.php?id='.$verif['id_pengajuan'], false);
     }
    }
}

if($_GET['s']=='batal'){
  $verif = find_by_id('verifikasi',$_GET['id']);
  $id_verif = $_GET['id'];
  $update ="UPDATE `verifikasi` SET `status_pengajuan`= '' WHERE `id` =".$id_verif;

    if($db->query($update)){
      $session->msg('s',"Sukses verifikasi di batalkan ");
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$verif['id_pengajuan'], false);
      }else{
      redirect('detail_pengajuan.php?id='.$verif['id_pengajuan'], false);
      }
    } else {
      $session->msg('d',' Sorry failed to Insert!');
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$verif['id_pengajuan'], false);
     }else{
        redirect('detail_pengajuan.php?id='.$verif['id_pengajuan'], false);
     }
    }
}

if($_GET['s']=='kasubbatal'){
  $pengajuan = find_by_id('pengajuan',$_GET['id']);
  $id_pengajuan = $_GET['id'];
  $update ="UPDATE `pengajuan` SET `verifikasi_kasubbag_v`= '' WHERE `id` =".$id_pengajuan;
    // echo $update; exit();

    if($db->query($update)){
      $session->msg('s',"Sukses verifikasi di batalkan ");
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
      }else{
      redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
      }
    } else {
      $session->msg('d',' Sorry failed to Insert!');
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
     }else{
        redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
     }
    }
}

if($_GET['s']=='kasubok'){
  $pengajuan = find_by_id('pengajuan',$_GET['id']);
  $id_pengajuan = $_GET['id'];
  $update ="UPDATE `pengajuan` SET `verifikasi_kasubbag_v`= '1' WHERE `id` =".$id_pengajuan;
    // echo $update; exit();

    if($db->query($update)){
      $session->msg('s',"Sukses verifikasi Terima ");
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
      }else{
      redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
      }
    } else {
      $session->msg('d',' Sorry failed to Insert!');
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
     }else{
        redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
     }
    }
}

if($_GET['s']=='tolak'){
  $pengajuan = find_by_id('pengajuan',$_GET['id']);
  $id_pengajuan = $_GET['id'];
  $update ="UPDATE `pengajuan` SET `verifikasi_kasubbag_v`= '2' WHERE `id` =".$id_pengajuan;
    // echo $update; exit();

    if($db->query($update)){
      $session->msg('s',"Sukses verifikasi Tolak ");
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
      }else{
      redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
      }
    } else {
      $session->msg('d',' Sorry failed to Insert!');
      if($user['user_level']==2){
       redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
     }else{
        redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
     }
    }
}

if($_GET['status']=='batal'){
  $dp = find_by_id('detail_pengajuan',$_GET['id']);
  $id_pengajuan = $_GET['idp'];
  $update ="UPDATE `detail_pengajuan` SET `id_pengajuan`= '' WHERE `id` =".$dp['id'];

    if($db->query($update)){
      $session->msg('s',"Sukses di batalkan ");
      if($user['user_level']==2){
       redirect('detail_pengajuan_ben.php?id='.$id_pengajuan, false);
      }else{
      redirect('detail_pengajuan_ben.php?id='.$id_pengajuan, false);
      }
    } else {
      $session->msg('d',' Sorry failed to Insert!');
      if($user['user_level']==2){
       redirect('detail_pengajuan_ben.php?id='.$id_pengajuan, false);
     }else{
        redirect('detail_pengajuan_ben.php?id='.$id_pengajuan, false);
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
            <?php $user=find_by_id('users',$_SESSION['user_id']);  if( $user['user_level']== '6'){?>
            <span><a href="nodin_bpp.php">All Nodin</a> / <a href="pengajuan_bpp.php?id=<?=$sales1[0]['id_nodin']?>">All Pengajuan</a> /<a href="detail_pengajuan.php?id=<?=$_GET['id']?>">All Detail Pengajuan</a></span>
          <?php }else{ ?>
              <span> <a href="nodin_bpp.php">All Nodin</a> /<a href="pengajuan_bpp.php?id=<?=$sales1[0]['id_nodin']?>">All Pengajuan</a> / All Detail Pengajuan</span>
          <?php } ?>
          </strong>
          <div class="pull-right">
            <?php $user1=find_by_id('users',$_SESSION['user_id']);  if( $user1['user_level'] != '3'){?>

              
              <?php $user=find_by_id('users',$_SESSION['user_id']);  if( $user['user_level']== '6' or $user['user_level']== '5'){?>
                <a href="all_sptjb_pum.php?id=<?=$_GET['id'];?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Add</a>
            
              <?php }else{ ?>
               
              <?php } ?>

            <?php } ?>     
          </div>
        </div>
        <div class="panel-body" style="width:100%">
          <table id="tabel" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 15%;"> NO SPTJB </th>
                <th class="text-center" style="width: 15%;"> Akun</th>
                <th class="text-center" style="width: 15%;"> Nominal </th> 
                <th class="text-center" style="width: 15%;"> PPH </th>
                <th class="text-center" style="width: 15%;"> PPN </th>
                <th class="text-center" style="width: 15%;"> Tanggal </th>               
                <th class="text-center" style="width: 15%;"> Keterangan </th>
                <th class="text-center" style="width: 15%;"> Kekurangan Verifikasi </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>

             <?php
              $tot=0;
              $tot1=0;
              $tot2=0;
             foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo $sale['no_sptjb']; ?></td>
               <td class="text-center"><?php $akun= find_by_id('akun',$sale['id_akun']); echo $akun['mak'] ;?>-<?=$akun['keterangan'] ;?></td>
               <td class="text-center"><?php echo rupiah($sale['nominal']); ?></td>
               <td class="text-center"><?php echo rupiah($sale['pph']); ?></td>
               <td class="text-center"><?php echo rupiah($sale['ppn']); ?></td>
               <td class="text-center"><?php echo $sale['tanggal_dp']; ?></td>
               <td class="text-center"><?php echo $sale['keterangan'];  ?></td>
               <td class="text-center">
               <?php  if($user['user_level'] != 6 and $user['user_level'] != 3 and $user['user_level'] != 4 and $user['user_level'] != 5 ){?>
                   <?php if($sale['keterangan_verifikasi']==''){ ?><a href="#" class="btn btn-primary" id="kekurangan"  data-toggle="modal" data-target="#PenolakanKPPN" data-id='<?=$sale['id'];?>' data-verifikasi='<?=$sale['keterangan_verifikasi'];?>'>Keterangan Verifikasi</a>
                   <?php }else{ ?><a href="#" class="btn btn-warning" id="kekurangan"  data-toggle="modal" data-target="#PenolakanKPPN" data-id='<?=$sale['id'];?>' data-verifikasi='<?=$sale['keterangan_verifikasi'];?>'><?=$sale['keterangan_verifikasi'];?></a><?php } ?>
               <?php  }else{ ?>
                <span class="label label-danger"><?=$sale['keterangan_verifikasi'];?></span>
               <?php } ?>
               </td>
               <td class="text-center">
               <?php if($user['user_level'] == 5){ ?>

                  <a onclick="return confirm('Yakin Hapus?')" href="detail_pengajuan_ben.php?id=<?php echo (int)$sale['id'];?>&status=batal&idp=<?php echo $_GET['id']?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                        <span class="glyphicon glyphicon-trash"></span>
                      </a>

               <?php } ?>

               <?php if($user['user_level'] != 2 and $user['user_level'] != 3 and $user['user_level'] != 4 and $user['user_level'] != 5 and $user['user_level'] != 7){?>
                  <div class="btn-group">
                     <a href="edit_detail_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-pencil"></span>
                     </a>


                     <a href="transaksi_db_a.php?id=<?=(int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail SIV" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-eye-open"></span>
                     </a>

                     <a onclick="return confirm('Yakin Hapus?')" href="delete_detail_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                     <a onclick="return confirm('Yakin Cetak?')" href="cetak_sptjb.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-success btn-xs"  title="Sptjb" data-toggle="tooltip" target="_BLANK">
                       <span class="glyphicon glyphicon-print"></span>
                     </a>
                     <a onclick="return confirm('Yakin Cetak?')" href="cetak_nominatif.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-success btn-xs"  title="Nominatif" data-toggle="tooltip" target="_BLANK">
                       <span class="glyphicon glyphicon-print"></span>
                     </a>
                  </div>
                <?php } ?>
               </td>
             </tr>

             <?php $tot+=$sale['nominal']; $tot1+=$sale['pph']; $tot2+=$sale['ppn']; endforeach;?>
           </tbody>
           <tfoot>
           
            <tr>
                <th class="text-center">Jumlah</th>
                <th class="text-center">  </th>
                <th class="text-center"> </th>
                <th class="text-center"> <?=rupiah($tot);?> </th> 
                <th class="text-center"> <?=rupiah($tot1);?> </th>
                <th class="text-center"> <?=rupiah($tot2);?> </th>
                <th class="text-center">Status Verifikasi  </th>
                <th class="text-center"> 
                  <?php   if($user['user_level'] != 6 and $user['user_level'] != 3 and $user['user_level'] != 4 and $user['user_level'] != 5 and $user['user_level'] != 7){?>
                      <?php $v=find_all_global('verifikasi',$_GET['id'],'id_pengajuan');
                        if($v[0]['status_pengajuan']==''){?>
                           <a href="detail_pengajuan.php?id=<?=$v[0]['id']?>&s=ok" class="btn btn-success">Terima</a>
                           
                        <?php }else{ ?>
                          <a href="detail_pengajuan.php?id=<?=$v[0]['id']?>&s=batal" class="btn btn-danger">Batalkan</a>
                        <?php } ?>
                  <?php } ?>
                </th>
                <th class="text-center">  </th>
                <th class="text-center"> </th>
             </tr>
             </tfoot>
             <?php $user = find_by_id('users',$_SESSION['user_id']);
              //var_dump($user['user_level']);
            if($user['user_level'] == 7){ 
              ?>
            <tr>
                <th class="text-center"></th>
                <th class="text-center">  </th>
                <th class="text-center"> </th>
                <th class="text-center"> </th> 
                <th class="text-center"> </th>
                <th class="text-center"> </th>
                <th class="text-center"> </th>    
                <th class="text-center">Status Verifikasi Kasubbbag Verifiaksi  </th>
                <th class="text-center"> 
                      <?php $v=find_by_id('pengajuan',$_GET['id']);
                        if($v['verifikasi_kasubbag_v']==''){?>
                           <a href="detail_pengajuan.php?id=<?=$_GET['id']?>&s=kasubok" class="btn btn-success">Terima</a>
                           <a href="detail_pengajuan.php?id=<?=$_GET['id']?>&s=tolak" class="btn btn-danger">Tolak</a>
                        <?php }else{ ?>
                          <a href="detail_pengajuan.php?id=<?=$_GET['id']?>&s=kasubbatal" class="btn btn-danger">Batalkan</a>
                        <?php } ?>
                </th>
                <th class="text-center"></th>
             </tr>
            <?php } ?>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>


<!-- Modal Edit verifikasi-->
<div class="modal fade" id="PenolakanKPPN" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kekurangan Verifikasi </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="detail_pengajuan.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Masukkan Kekurangan</label>
        <input type="text" class="form-control" id="verifikasi" name="verifikasi" placeholder="verifikasi" required> 
       </div>
       <input type="hidden" class="form-control" id="id" name="id" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update_kekurangan" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="KeteranganKsVerif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kekurangan Kasubbag Verifikasi </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="detail_pengajuan.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Masukkan Kekurangan</label>
        <input type="text" class="form-control" id="verifikasi" name="verifikasi" placeholder="verifikasi" required> 
       </div>
       <input type="hidden" class="form-control" id="id" name="id" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update_kekuranganKsV" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Import Data-->
<div class="modal fade" id="UploadCSV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data dari Skim</h5>
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
        <input type="submit" class="btn btn-primary" name="Import" value="Upload">
      </div>
      </form>
    </div>
  </div>
</div>