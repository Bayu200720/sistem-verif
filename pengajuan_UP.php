<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);
?>
<?php
$user=find_by_id('users',$_SESSION['user_id']);
$satker = find_all_global('satker',$user['id_satker'],'id');
$sales = find_all_global_tahun('pengajuan_pum',$user['id_satker'],'id_satker',$satker[0]['tahun']);
$pengajuan = find_nodin_j_pengajuan_count($satker[0]['tahun'],$user['id_satker']);


?>
<?php


 if(isset($_POST['submit_nodin'])){
   $req_fields = array('id_jenis','tanggal','id_satker');
   validate_fields($req_fields);
   if(empty($errors)){
     $id_jenis   = remove_junk($db->escape($_POST['id_jenis']));
     $tanggal   = remove_junk($db->escape($_POST['tanggal']));
     $id_satker = remove_junk($db->escape($_POST['id_satker']));
     $no_nodin = remove_junk($db->escape($_POST['no_nodin']));
     $tahun = $satker[0]['tahun'];
     $query  = "INSERT INTO pengajuan_pum (";
     $query .=" tanggal,jenis_pengajuan,id_satker,no,tahun";
     $query .=") VALUES (";
     $query .=" '{$tanggal}','{$id_jenis}','{$id_satker}','{$no_nodin}','{$tahun}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"pengajuan added ");
       if($user['user_level']==2){
        redirect('pengajuan_UP.php', false);
       }else{
       redirect('pengajuan_UP.php', false);
       }
     } else {
       $session->msg('d',' Sorry failed to added!');
       if($user['user_level']==2){
        redirect('pengajuan_UP.php', false);
      }else{
         redirect('pengajuan_UP.php', false);
      }
     }

   } else{
     $session->msg("d", $errors);
     redirect('pengajuan_UP.php',false);
   }

 }

 



 if(isset($_POST['update_nodin'])){
  $req_fields = array('id_jenis','tanggal','tahun','id');
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id']));
    $id_jenis   = remove_junk($db->escape($_POST['id_jenis']));
    $tanggal   = remove_junk($db->escape($_POST['tanggal']));
    $id_satker = remove_junk($db->escape($_POST['id_satker']));
    $tahun = remove_junk($db->escape($_POST['tahun']));
    $no_nodin = remove_junk($db->escape($_POST['no_nodin']));
    $user_id   = remove_junk($db->escape($_SESSION['user_id']));
    $date    = make_date();
    $query  = "UPDATE pengajuan_pum SET ";
    $query .=" tanggal= '{$tanggal}',jenis_pengajuan='{$id_jenis}',tahun='{$tahun}',no='{$no_nodin}'";
    $query .=" WHERE id='{$id}'";
    //var_dump($query);exit();
 
    if($db->query($query)){
      $session->msg('s',"Nodin Updated ");
      if($user['user_level']==2){
       redirect('pengajuan_UP.php', false);
      }else{
      redirect('pengajuan_UP.php', false);
      }
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      if($user['user_level']==2){
       redirect('pengajuan_UP.php', false);
     }else{
        redirect('pengajuan_UP.php', false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('pengajuan_UP.php',false);
  }

}


if($_GET['p']=='update'){

    $id   = remove_junk($db->escape($_GET['id']));
  
    $query  = "UPDATE nodin SET ";
    $query .=" status_pengajuan= 1";
    $query .=" WHERE id='{$id}'";
  //echo $query;exit();
  	
    if($db->query($query)){
      $session->msg('s',"Telah di ajukan ke bagian keuangan ");
     // ini_set( 'display_errors', 1 );   
   // error_reporting( E_ALL );    
    // $from = $user['email'];    
    // $to = "bayukominfo20@gmail.com";    
    // $subject = "Pengajuan SPM ".$satker[0]['keterangan'];    
    // $message = "pengajuan SPM";   
    // $headers = "From:" . $from;    
    // mail($to,$subject,$message, $headers);    
    // echo "Pesan email sudah terkirim.";
      if($user['user_level']==2){
       redirect('nodin_bpp.php', false);
      }else{
      redirect('nodin_bpp.php', false);
      }
    } else {
      $session->msg('d',' Sorry failed to Pengajuan!');
      if($user['user_level']==2){
       redirect('nodin_bpp.php', false);
     }else{
        redirect('nodin_bpp.php', false);
     }
    }

}

if($_GET['p']=='update_approval'){

  $id   = remove_junk($db->escape($_GET['id']));

  $query  = "UPDATE pengajuan_pum SET ";
  $query .=" 	status= 2";
  $query .=" WHERE id='{$id}'";
  
  if($db->query($query)){
    $session->msg('s',"Telah di ajukan ke bagian keuangan ");

  // $from = $user['email'];    
  // $to = "bayukominfo20@gmail.com";    
  // $subject = "Pengajuan SPM ".$satker[0]['keterangan'];    
  // $message = "pengajuan SPM";   
  // $headers = "From:" . $from;    
  // mail($to,$subject,$message, $headers);    
  // echo "Pesan email sudah terkirim.";
    if($user['user_level']==2){
     redirect('pengajuan_UP.php', false);
    }else{
    redirect('pengajuan_UP.php', false);
    }
  } else {
    $session->msg('d',' Sorry failed to Pengajuan!');
    if($user['user_level']==2){
     redirect('pengajuan_UP.php', false);
   }else{
      redirect('pengajuan_UP.php', false);
   }
  }

}

if($_GET['p']=='batal'){

  $id   = remove_junk($db->escape($_GET['id']));

  $query  = "UPDATE nodin SET ";
  $query .=" status_pengajuan= 0";
  $query .=" WHERE id='{$id}'";
//echo $query;exit();
  if($db->query($query)){
    $session->msg('s',"Telah di berhasil di batalkan  ");
    if($user['user_level']==2){
     redirect('nodin_bpp.php', false);
    }else{
    redirect('nodin_bpp.php', false);
    }
  } else {
    $session->msg('d',' Sorry failed to Pengajuan!');
    if($user['user_level']==2){
     redirect('nodin_bpp.php', false);
   }else{
      redirect('nodin_bpp.php', false);
   }
  }

}

 ?>

<?php

if($_GET['status']=='delete_nodin'){
  $d_sale = find_by_id('pengajuan_pum',(int)$_GET['id']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$d_sale){
    $session->msg("d","Missing nodin id.");
      if($user['user_level']==2){
              redirect('pengajuan_UP.php', false);
          }else{
    redirect('pengajuan_UP.php');
        }
  }
?>
<?php
  $delete_id = delete_by_id('pengajuan_pum',(int)$d_sale['id']);
  if($delete_id){
      $session->msg("s","nodin deleted.");
      if($user['user_level']==2){
              redirect('pengajuan_UP.php', false);
          }else{
      redirect('pengajuan_UP.php');
        }
  } else {
      $session->msg("d","nodin deletion failed.");
          if($user['user_level']==2){
              redirect('pengajuan_UP.php', false);
          }else{
      redirect('pengajuan_UP.php');
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
            <span><a href="nodin_bpp.php">All Pengajuan</a></span>
          </strong>
          <div class="pull-right">
          <a href="pengajuan_UP.php" class="btn btn-primary" id="nodin"></span>ALL Pengajuan</a>
            <?php if($pengajuan[0]['status'] == 0){?>
        		  <a href="#" onclick="showT('DT_p')" class="btn btn-primary" id="nodin"><span class="glyphicon glyphicon-plus"></span>ADD</a>
            <?php }else{ ?>
                  <span class="btn btn-danger glyphicon glyphicon-warning-sign">upload pertanggungjawaban terlebih dahulu</span>
            <?php } ?>
          </div>
        </div>
        <div class="panel-body" style="width:100%"> 
          <table id="tabel" class="table table-primary table-bordered table-striped table-dark table-hover " style="width:100%">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center" > Tanggal</th>
                <th class="text-center" > Jenis </th>
                <th class="text-center" >Nomor Nodin </th>
                <th class="text-center"> Cetak Nodin </th>
                <th class="text-center"> Status Pengajuan </th> 
                <th class="text-center"> Status Pencairan </th>               
                <th class="text-center"> Actions </th>
             </tr>
            </thead>
           <tbody >
             <?php foreach ($sales as $sale):?>
             <tr >
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo $sale['tanggal']; ?></td>
               <td class="text-center"><?php echo $sale['jenis_pengajuan'];  ?></td>
               <td class="text-center"><?php echo $sale['no']; ?></td>

                <td class="text-center">
                <a href="cetakNP.php?id=<?=$sale['id']?>" class="btn btn-primary" target="_BLANK"><span class="glyphicon glyphicon-print"></span></a>
                </td>
                <td class="text-center">

                <?php if($sale['status'] == 1){
                                $pengajuan = find_all_global('pengajuan',$sale['id'],'id_nodin'); 
                        ?>
                        <a class="btn btn-success" disabled>Sudah Diapprovel</a>
                      <?php }else if($sale['status'] == 2){?>
                        <a href="pengajuan_UP.php?id=<?=$sale['id']?>&key=ajukan&p=update_approval" class="btn btn-warning" disabled>Menunggu Approval</a>
                      <?php }else{ $sp1= find_nodin_j_pengajuan_pum_j_dt_count($satker[0]['tahun'],$user['id_satker'],$sale['id']); ?>
                        <a onclick="return confirm('Apakah Anda Yakin ingin mengajuan Approval?')" href="pengajuan_UP.php?id=<?=$sale['id']?>&key=ajukan&p=update_approval" class="btn btn-primary" <?php if($sp1[0]['status'] == 0){ echo 'disabled';}?>>Ajukan Approval</a>
                  <?php } ?>

                      <?php $sp= find_nodin_j_pengajuan_pum_j_dt_count($satker[0]['tahun'],$user['id_satker'],$sale['id']); 
							if($sp[0]['status'] == 0){ 
 							 echo "<span class='btn btn-danger'>isi detail transaksi dulu</span>";}else{?>
                      
                  <?php }?>
                
                </td>
                <td class="text-center">
                  <?php if($sale['status_pencairan']== 1){?>
                        <span class="btn btn-success" disabled>Diproses</span>
                   <?php }else{ ?>
                         <span class="btn btn-danger" disabled>Belom di proses</span>
                   <?php } ?>
                </td>
                <td class="text-center">
                      <div class="btn-group">
                      
                        <?php if($sale['status'] != 1){ ?>
                        
                        <a href="#" title="Edit" <?php $nodin = find_by_id('pengajuan_pum',$sale['id']);?> class="btn btn-warning btn-xs" id="editnodin" data-toggle="modal"  title="Edit nodin"
                        data-target="#UpdateNodinPengajuan" data-id='<?=$nodin['id'] ?>' data-tanggal='<?=$nodin['tanggal'];?>' data-jenis_pengajuan='<?=$nodin['jenis_pengajuan'];?>' data-no_nodin='<?=$nodin['no'];?>' data-tahun='<?=$nodin['tahun'];?>'>
                        <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <?php $pengj = count_by_id_nodin('pengajuan',$sale['id']); if($pengj['total'] < 1 ){ ?>  
                        <a onclick="return confirm('Yakin Hapus?')" href="pengajuan_UP.php?id=<?php echo (int)$sale['id'];?>&status=delete_nodin" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                        <?php } ?>

                        <?php } ?>
                        <a href="detail_pengajuan_nodin_pum.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail nodin" data-toggle="tooltip">
                          <span class="glyphicon glyphicon-eye-open"></span>
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




     <!-- Modal Detail Pengajuan-->
<div class="modal fade" id="Detail_Nodin" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="width:90vw">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Nodin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="Body_dp" style="width:100%;">
      
    </div>
    </div>
  </div>
</div>


  
       <!-- Modal input nodin-->
  <div class="modal fade" id="DT_p" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengajuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="detail_p.php?status=ada" method="POST">
      <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">SPM</label>
              <input type="text" class="form-control" id="spm" name="spm" placeholder="SPM">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Pengajuan</label>
                      <select class="form-control" id="jenis" name="id_jenis_pengajuan">
                            <option value="">Pilih Jenis Pengajuan</option>
        
                                    <option value="GU">
                                    <option value="TUP">
                             
                      </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" onclick="simpan_dp()" name="add_pengajuan" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>






   <!-- Modal input nodin-->
<div class="modal fade" id="NodinPengajuan" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Nodin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="pengajuan_UP.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Tanggal</label>
        <input type="date" class="form-control" id="nodin" name="tanggal" placeholder="tanggal" required> 
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Nomor Nodin</label>
        <input type="text" class="form-control" id="no_nodinn" name="no_nodin" placeholder="Nomor Nodin">
        <input type="hidden" class="form-control" value="<?php $users=find_by_id('users',$_SESSION['user_id']);echo $users['id_satker'] ;?>" name="id_satker" >
       </div>
       
       <div class="form-group">
        <label for="exampleInputEmail1">Jenis Pengajuan</label>
                <select class="form-control" name="id_jenis" required>
                      <option value="">Pilih Jenis Pengajuan</option>
                      <option value="GU">GU</option>
                      <option value="TUP">TUP</option>
                </select>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit_nodin" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>



 <!-- Modal Edit nodin-->
 <div class="modal fade" id="UpdateNodinPengajuan" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Nodin Pengajuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal" required>
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Nomor Nodin</label>
        <input type="text" class="form-control" id="no_nodin" name="no_nodin" placeholder="Nomor Nodin" required>
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Tahun</label>
        <input type="text" class="form-control" id="tahunN" name="tahun" placeholder="Tahun" required>
        <input type="hidden" class="form-control" id="id" name="id" >
        <input type="hidden" class="form-control" id="id_user" value="<?php $users=find_by_id('users',$_SESSION['user_id']);echo $users['id_satker'] ;?>" name="id_satker" >
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Jenis Pengajuan</label>
                <select class="form-control" name="id_jenis" required>
                      <option id="jenis_pengajuan" value="">Pilih Jenis Pengajuan</option>           
                      <option value="TUP">TUP</option>
                      <option value="GU">GU</option>
                </select>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update_nodin" value="Update">
      </div>
      </form>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
