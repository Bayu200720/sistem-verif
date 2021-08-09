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

if($_GET['status'] == 'g'){
  $spm = $_GET['spm'];
  $tahun = $_GET['tahun'];
  $id_pengajuan = $_GET['id'];

    $url = file_get_contents("https://skim.kominfo.go.id/CI3_api/api/Sptjb?id=$spm&tahun=$tahun");
    $sales1 = json_decode($url, true);
  
    //$sales1[0][0]=$sales1[0][0];
    //$sales1[0]=$sales1[0][1];
    //var_dump($sales1);

    for($i=0;$i<count($sales1);$i++){

   
    

      $akun= find_all_global('akun',$sales1[$i][0]['mak'],'mak');
      //var_dump($sales1);
      $id_akun= $akun[0]['id'];
      //$keterangan= $akun[0]['keterangan'];

      $no= $sales1[$i][0]['no']."/".$sales1[0][0]['lsgu'];
      $nominal = $sales1[$i][0]['total'];
      $pph = $sales1[$i][0]['pph'];
      $ppn = $sales1[$i][0]['ppn'];
      $id_sptjb_api = $sales1[$i][0]['id'];

     // echo $sales1[$i][0]['id'];

      $query= "INSERT INTO `detail_pengajuan` (`id`, `no_sptjb`, `nominal`, `id_akun`, `keterangan`, `id_pengajuan`, `pph`, `ppn`, `keterangan_verifikasi`, `id_sptjb_api`) VALUES (NULL, '{$no}', '{$nominal}', '{$id_akun}', '', '{$id_pengajuan}', '{$pph}', '{$ppn}', '', '{$id_sptjb_api }');";
     //echo $query;
      $hasil=$db->query($query);
    }
   // exit();
      if($hasil){
        $session->msg('s',"Generate Success ");
        if($user['user_level']==2){
        redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
        }else{
        redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
        }
      } else {
        $session->msg('d',' Sorry failed to added!');
        if($user['user_level']==2){
        redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
      }else{
        redirect('detail_pengajuan.php?id='.$id_pengajuan, false);
      }
      }
    
}
//$sales = find_detail($_GET['id']);
//$sales1 = find_all_global('pengajuan',$_GET['id'],'id');

//$url = file_get_contents('https://skim.kominfo.go.id/api_siak/index.php?id=40008');
$spm = $_GET['spm'];
$tahun = $_GET['tahun'];
$url = file_get_contents("https://skim.kominfo.go.id/CI3_api/api/Sptjb?id=$spm&tahun=$tahun");
//echo "https://skim.kominfo.go.id/CI3_api/api/Sptjb?id=$spm&tahun=$tahun";exit();
$sales = json_decode($url, true);
//var_dump($sales); exit();


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
            <span>Detail Transaksi</span>
          </strong>
          <div class="pull-right">
            <?php $user1=find_by_id('users',$_SESSION['user_id']);  if( $user1['user_level'] != '3'){?>

              
              <?php $user=find_by_id('users',$_SESSION['user_id']);  if( $user['user_level']== '6'){?>
                <a href="transaksi.php?id=<?=$_GET['id'];?>&status=g&tahun=<?=$tahun?>&spm=<?=$spm?>" class="btn btn-primary">Generate</a>
              <a href="nodin_bpp.php?id=<?=$sales1[0]['id_nodin'];?>" class="btn btn-warning">Back</a>
              <a href="#" class="btn btn-success" id="import"  data-toggle="modal" data-target="#UploadCSV" data-id="<?=$_GET['id'];?>" >Import Data</a>
              <a href="excle.php" class="btn btn-success">Excle</a>
              <?php }else{ ?>
                <!-- <a href="pengajuan_verif.php?id=<?=$sales1[0]['id_nodin'];?>" class="btn btn-warning">Back</a> -->
              <?php } ?>

            <?php } ?>     
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 15%;"> NO SPTJB </th>
                <th class="text-center" style="width: 15%;"> Akun</th>
                <th class="text-center" style="width: 15%;"> Nominal </th> 
                <th class="text-center" style="width: 15%;"> PPH </th>
                <th class="text-center" style="width: 15%;"> PPN </th>         
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
               <td class="text-center"><?php echo $sale[0]['no']; ?>/<?php echo $sale[0]['lsgu']; ?></td>
               <td class="text-center"><?php echo $sale[0]['mak'];?></td>
               <td class="text-center"><?php echo rupiah($sale[0]['total']); ?></td>
               <td class="text-center"><?php echo rupiah($sale[0]['pph']); ?></td>
               <td class="text-center"><?php echo rupiah($sale[0]['ppn']); ?></td>
               <td class="text-center"><?php echo $sale[0]['keterangan'];  ?></td>
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
                     <a href="transaksi_detail.php?id=<?php echo (int)$sale[0]['id'];?>&id_pengajuan=<?=$_GET['id']?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     
                  </div>
                <?php }?>
               </td>
             </tr>

             <?php $tot+=$sale[0]['total']; $tot1+=$sale[0]['pph']; $tot2+=$sale[0]['ppn']; endforeach;?>
           </tbody>
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

<!-- Modal Upload-->
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