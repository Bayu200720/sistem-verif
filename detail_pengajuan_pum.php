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
$sales = find_detail_pum($_GET['id']);
$sales1 = find_all_global('pengajuan',$_GET['id'],'id');

if($_GET['status']=='bj'){
    $dp = find_by_id('detail_pengajuan',$_GET['id']);
        $query  = "UPDATE detail_pengajuan SET ";
        $query .= "file_pj='' ";
        $query .= "WHERE id='{$_GET['id']}'";
        $result = $db->query($query);
        $session->msg('s',' Berhasil di Batalkan');
    if($user['user_level']==5){
        redirect('detail_pengajuan_pum.php?id='.$dp['id_pencairan']);
    }else{
        redirect('detail_pengajuan_pum.php?id='.$dp['id_pencairan'], false);
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
              <span> <a href="pengajuan_verif.php">All Pengajuan</a> / All Detail Pengajuan</span>
          <?php } ?>
          </strong>
          <div class="pull-right">
            <?php $user1=find_by_id('users',$_SESSION['user_id']);  if( $user1['user_level'] != '3'){?>

              
              <?php $user=find_by_id('users',$_SESSION['user_id']);  if( $user['user_level']== '6' or $user['user_level']== '5'){?>
                <a href="add_detail_pengajuan_pum.php?id=<?=$_GET['id'];?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Add</a>
              
              <!--<a href="#" class="btn btn-success" id="import"  data-toggle="modal" data-target="#UploadCSV" data-id="<?=$_GET['id'];?>" ><span class="glyphicon glyphicon-upload"></span> <img src="uploads/users/excel.png" height="20"/></a>
              
              <a href="uploads/data_excle/data.csv" class="btn btn-success" target="_blank"><img src="uploads/users/excel.png" height="20"/></a><!-- <a href="excle.php" class="btn btn-success">Excle</a> 
              <a onclick="return confirm('Yakin Hapus!!!')" href="detail_pengajuan.php?id=<?=$_GET['id'];?>&status=h" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>-->
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
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 15%;"> NO SPTJB </th>
                <th class="text-center" style="width: 15%;"> Akun</th>
                <th class="text-center" style="width: 15%;"> Nominal </th> 
                <th class="text-center" style="width: 15%;"> PPH </th>
                <th class="text-center" style="width: 15%;"> PPN </th>
                <th class="text-center" style="width: 15%;"> Tanggal </th>               
                <th class="text-center" style="width: 15%;"> Keterangan </th>
                <th class="text-center" style="width: 15%;"> Kekurangan Verifikasi </th>
                <th class="text-center" style="width: 15%;">Upload PJ </th>
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
               <?php  if($sale['file_pj']==''){?><a href="media_pum.php?id=<?=$sale['id']?>" class="btn btn-primary">Upload</a><?php }else{?>
                             <a href="uploads/sptjb_pum/<?=$sale['file_pj']?>" class="btn btn-success" target="_blank">Preview</a>
                            <a href="detail_pengajuan_pum.php?id=<?=$sale['id']?>&status=bj" class="btn btn-danger">Batal</a>
                        <?php } ?>
               </td>
               <td class="text-center">
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
                <th class="text-center">
                
                </th>
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