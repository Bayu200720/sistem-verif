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

if(isset($_GET['status'])){
if($_GET['status'] === 'h'){
  //exit();
    $id =$_GET['id'];
    $query="DELETE FROM detail_transaksi WHERE id_detail_pengajuan =".$_GET['id']; 
    //echo $query; exit();
    $hasil=$db->query($query);  
    if($hasil){
        $session->msg('s',"Delete Success ");
        if($user['user_level']==2){
        redirect('transaksi_db_a.php?id='.$id, false);
        }else{
        redirect('transaksi_db_a.php?id='.$id, false);
        }
    } else {
        $session->msg('d',' Sorry failed to added!');
        if($user['user_level']==2){
        redirect('transaksi_db_a.php?id='.$id, false);
    }else{
        redirect('transaksi_db_a.php?id='.$id, false);
    }
    }    
  }
}


if(isset($_GET['status'])){
  if($_GET['status'] == 'del'){
  
    $id  = remove_junk($db->escape($_GET['id']));
    $transaksi= find_by_id('detail_transaksi',$id);

    $id_dp  = $transaksi['id_detail_pengajuan'];
  // var_dump($id_dp);exit();
  
    $keterangan   = remove_junk($db->escape($_POST['keterangan']));
    $query  = "DELETE FROM detail_transaksi WHERE id ='{$id}'";
 
    if($db->query($query)){
      $session->msg('s',"Detail Transaksi Deleted ");
      redirect('transaksi_db_a.php?id='.$id_dp, false);
    } else {
      $session->msg('d',' Sorry failed to Deleted!');
      redirect('transaksi_db_a.php?id='.$id_dp, false);
    }

  } else{
    $session->msg("d", $errors);
    redirect('transaksi_db_a.php?id='.$id_dp,false);
  }
}

if(isset($_POST['edit_transaksi'])){
  $req_fields = array('penerima','nominal','pph','ppn','tanggal');
  validate_fields($req_fields);
  var_dump($_POST);
  $teks5 = $_POST['nominal'];
 $nominal = preg_replace("/[^0-9]/", "", $teks5);

  if(empty($errors)){
    $penerima  = remove_junk($db->escape($_POST['penerima']));
    $tanggal  = remove_junk($db->escape($_POST['tanggal']));
    $nominal  = remove_junk($db->escape($nominal));
    $nip  = remove_junk($db->escape($_POST['id']));
    $id_t  = remove_junk($db->escape($_POST['id_t']));
    $id_dp  = remove_junk($db->escape($_POST['id_dp']));
    $keterangan  = remove_junk($db->escape($_POST['keterangan']));

    if($db->escape($_POST['pph'])==''){
     $pph=0;
    }else{
     $pph = preg_replace("/[^0-9]/", "", $_POST['pph']);
    }
    if($db->escape($_POST['ppn'])==''){
     $ppn=0;
    }else{
     $ppn = preg_replace("/[^0-9]/", "", $_POST['ppn']);
    }

    if($_POST['pph1'] == 'pph5p'){
     $pph = $nominal * 5/100;
   }else if($_POST['pph1']== 'pph15p'){
     $pph = $nominal * 15/100;
   }else if($_POST['pph1']== 'pph2p'){
     $pph = $nominal * 2/100;
   }

    $keterangan   = remove_junk($db->escape($_POST['keterangan']));
    $id_dp = remove_junk($db->escape($_POST['id_dp']));
    $query  = "UPDATE detail_transaksi SET";
    $query .=" penerima='{$penerima}',nominal ='{$nominal}',uraian='{$keterangan}',pph='{$pph}',ppn='{$ppn}',tanggal_transaksi='{$tanggal}',id_penerima='{$nip}'";
    $query .=" WHERE id='{$id_t}'";
 
    if($db->query($query)){
      $session->msg('s',"Detail Transaksi Updated ");
      redirect('transaksi_db_a.php?id='.$id_dp, false);
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      redirect('transaksi_db_a.php?id='.$id_dp, false);
    }

  } else{
    $session->msg("d", $errors);
    redirect('transaksi_db_a.php?id='.$id_dp,false);
  }
}


if(isset($_POST['add_transaksi'])){
  $req_fields = array('penerima','nominal','pph','ppn','tanggal');
  validate_fields($req_fields);
  $teks5 = $_POST['nominal'];
 $nominal = preg_replace("/[^0-9]/", "", $teks5);
 


  if(empty($errors)){
    $penerima  = remove_junk($db->escape($_POST['penerima']));
    $tanggal  = remove_junk($db->escape($_POST['tanggal']));
    $nominal  = remove_junk($db->escape($nominal));
    $nip  = remove_junk($db->escape($_POST['id']));
    $id_dp  = remove_junk($db->escape($_POST['id_dp']));
    $keterangan  = remove_junk($db->escape($_POST['keterangan']));

   

    if($db->escape($_POST['pph'])==''){
     $pph=0;
    }else{
     $pph = preg_replace("/[^0-9]/", "", $_POST['pph']);
   // $pph  = remove_junk($db->escape($_POST['pph']));
    }
    if($db->escape($_POST['ppn'])==''){
     $ppn=0;
    }else{
     $ppn = preg_replace("/[^0-9]/", "", $_POST['ppn']);
    //$ppn  = remove_junk($db->escape($_POST['ppn']));
    }

    if($_POST['pph1'] == 'pph5p'){
     $pph = $nominal * 5/100;
   }else if($_POST['pph1']== 'pph15p'){
     $pph = $nominal * 15/100;
   }else if($_POST['pph1']== 'pph2p'){
     $pph = $nominal * 2/100;
   }else if($_POST['pph']=='pph'){
     $pph = 0;
   }
   //var_dump($_POST['pph1']);
   //var_dump($pph);exit();

    $keterangan   = remove_junk($db->escape($_POST['keterangan']));
    $id_dp = remove_junk($db->escape($_POST['id_dp']));
    $query  = "INSERT INTO detail_transaksi (";
    $query .=" id_detail_pengajuan,penerima,nominal,uraian,pph,ppn,tanggal_transaksi,id_penerima";
    $query .=") VALUES (";
    $query .=" '{$id_dp}','{$penerima}', '{$nominal}', '{$keterangan}','{$pph}','{$ppn}','{$tanggal}','{$nip}'";
    $query .=")";
    //var_dump($query);exit();
    if($db->query($query)){
      $session->msg('s',"Detail Transaksi added ");
      redirect('transaksi_db_a.php?id='.$id_dp, false);
    } else {
      $session->msg('d',' Sorry failed to added!');
      redirect('transaksi_db_a.php?id='.$id_dp, false);
    }

  } else{
    $session->msg("d", $errors);
    redirect('transaksi_db_a.php?id='.$id_dp,false);
  }

}


$sales = find_all_global('detail_transaksi',$_GET['id'],'id_detail_pengajuan');
$dpn = find_all_global('detail_pengajuan',$_GET['id'],'id');
$pengajuan1 = find_all_global('pengajuan',$dpn[0]['id_pengajuan'],'id');

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
            <span><a href="nodin_bpp.php">All Nodin</a> / <a href="pengajuan_bpp.php?id=<?=$pengajuan1[0]['id_nodin']?>">All Pengajuan</a> /<a href="detail_pengajuan.php?id=<?=$dpn[0]['id_pengajuan']?>">All Detail Pengajuan</a> / <a href="transaksi_db_a.php?id=<?=$_GET['id']?>">Detail Transaksi</a></span>
          </strong>
          <div class="pull-right">
            <?php $user1=find_by_id('users',$_SESSION['user_id']);  if( $user1['user_level'] != '3'){?>

              <?php $user=find_by_id('users',$_SESSION['user_id']);  if( $user['user_level']== '6'){?>
                
              <!-- <a href="nodin_bpp.php?id=<?=$sales1[0]['id_nodin'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-chevron-left"></span></a> -->
              <a onclick="AddT(<?=$_GET['id'];?>)" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Add</a>
              <a onclick="return confirm('Yakin Hapus!!')" href="transaksi_db_a.php?id=<?=$_GET['id'];?>&status=h" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
              <a href="#" class="btn btn-success" id="import"  data-toggle="modal" data-target="#UploadCSV" data-id="<?=$_GET['id'];?>" >Import Data</a>
              <a href="uploads/data_excle/data_detail.csv" class="btn btn-success">Excel</a>
              <?php }else{ ?>
                <!-- <a href="pengajuan_verif.php?id=<?=$sales1[0]['id_nodin'];?>" class="btn btn-warning">Back</a> -->
              <?php } ?>

            <?php } ?>     
          </div>
        </div>
        <div class="panel-body" style="width:100%">
          <table id="tabel" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center" > Nama </th>
                <th class="text-center" > ID</th>
                <th class="text-center" > Nominal </th> 
                <th class="text-center" > PPH </th>
                <th class="text-center" > PPN </th> 
                <th class="text-center" > Tanggal Transaksi</th>           
                <th class="text-center" > Keterangan </th>
                <th class="text-center" > Kekurangan Verifikasi </th>
                <th class="text-center"> Actions </th>
             </tr>
            </thead>
           <tbody>

             <?php
              $tot=0;
              $tot1=0;
              $tot2=0;
             // var_dump($sales);
             foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo $sale['penerima']; ?></td>
               <td class="text-center"><?php echo $sale['id_penerima'];?></td>
               <td class="text-center"><?php echo rupiah($sale['nominal']); ?></td>
               <td class="text-center"><?php echo rupiah($sale['pph']); ?></td>
               <td class="text-center"><?php echo rupiah($sale['ppn']); ?></td>
               <td class="text-center"><?php echo $sale['tanggal_transaksi']; ?></td>
               <td class="text-center"><?php echo $sale['uraian'];  ?></td>
               <td class="text-center">
               <?php  if($user['user_level'] != 6 and $user['user_level'] != 3 and $user['user_level'] != 4 and $user['user_level'] != 5 and $user['user_level'] != 7){?>
                   <?php if($sale['keterangan_verifikasi']==''){ ?><a href="#" class="btn btn-primary" id="kekurangan"  data-toggle="modal" data-target="#PenolakanKPPN" data-id='<?=$sale['id'];?>' data-verifikasi='<?=$sale['keterangan_verifikasi'];?>'>Keterangan Verifikasi</a>
                   <?php }else{ ?><a href="#" class="btn btn-warning" id="kekurangan"  data-toggle="modal" data-target="#PenolakanKPPN" data-id='<?=$sale['id'];?>' data-verifikasi='<?=$sale['keterangan_verifikasi'];?>'><?=$sale['keterangan_verifikasi'];?></a><?php } ?>
               <?php  }else{ ?>
                <span class="label label-danger"><?=$sale['keterangan_verifikasi'];?></span>
               <?php } ?>
               </td>
               <td class="text-center">
               <?php if($user['user_level'] != 2 and $user['user_level'] != 3 and $user['user_level'] != 4 and $user['user_level'] != 5 and $user['user_level'] != 7){?>
                  <div class="btn-group">
                     <a onclick="EditT(<?=$sale['id'];?>)" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-pencil"></span>
                     </a>
                     <a onclick="return confirm('Yakin Hapus !');" href="transaksi_db_a.php?id=<?php echo (int)$sale['id'];?>&id_dp=<?=$sale['id_detail_pengajuan'];?>&status=del" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                     
                  </div>
                <?php }?>
               </td>
             </tr>

             <?php $tot+=$sale['nominal']; $tot1+=$sale['pph']; $tot2+=$sale['ppn']; endforeach;?>
           </tbody>
            <tr>
                <th class="text-center">Jumlah</th>
                <th class="text-center">  </th>
                <th class="text-center"> </th>
                <th class="text-center"> <?=rupiah($tot);?> </th> 
                <th class="text-center"> <?=rupiah($tot1);?> </th>
                <th class="text-center"> <?=rupiah($tot2);?> </th>
                <th class="text-center"> </th>
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
             </tr>
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
                <th class="text-center">Status Verifikasi Kasubbbag Verifiaksi  </th>
                <th class="text-center"> 
                      <?php $v=find_by_id('pengajuan',$_GET['id']);
                        if($v['verifikasi_kasubbag_v']==''){?>
                           <a href="detail_pengajuan.php?id=<?=$_GET['id']?>&s=kasubok" class="btn btn-success">Terima</a>
                        <?php }else{ ?>
                          <a href="detail_pengajuan.php?id=<?=$_GET['id']?>&s=kasubbatal" class="btn btn-danger">Batalkan</a>
                        <?php } ?>
                </th>
                <th class="text-center">  </th>
             </tr>
            <?php } ?>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>


     <!-- Modal Detail ADD Transaksi-->
     <div class="modal fade" id="Detail_Nodin" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:50vw">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Transkasi</h5>
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
     <div class="modal fade" id="EditT" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:50vw">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Transkasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="Body_et" style="width:100%;">
      
    </div>
    </div>
  </div>
</div>



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
        <input type="text" class="form-control" id="verifikasi" name="verifikasi" placeholder="verifikasi"> 
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

<!-- Modal import detail-->
<div class="modal fade" id="UploadCSV" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
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
        <input type="submit" class="btn btn-primary" name="Import_detail" value="Upload">
      </div>
      </form>
    </div>
  </div>
</div>