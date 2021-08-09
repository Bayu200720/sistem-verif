<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$verif = find_by_filed('verifikasi',$_GET['id'],'id_pengajuan');

$id_pengajuan = $_GET['id'];
$update ="UPDATE `pengajuan` SET `status_verifikasi`=".$_SESSION['user_id']." WHERE `pengajuan`.`id` =".$id_pengajuan;
   // echo $update; exit();
    $db->query($update);
if($verif == NULL){
  
    $query = "INSERT INTO verifikasi (`id_pengajuan`) VALUES (".$id_pengajuan.")";
    
    if($db->query($query)){
      $session->msg('s',"Siap di Verifikasi ");
      redirect('v_pengadaankurang50.php?id='.$id_pengajuan, false);
    } else {
      $session->msg('d',' Sorry failed to added!');
      redirect('v_pengadaankurang50.php?id='.$id_pengajuan, false);
    }
}

$id = find_by_filed('pengajuan',$_GET['id'],'id');
$id_nodin= $id['id_nodin'];
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
            <span>Verifikasi Pengadaan Kurang dari 50 Juta</span>
          </strong>
          <div class="pull-right">
            <a href="pengajuan_verif.php?id=<?=$id_nodin;?>" class="btn btn-primary">Back</a>
          </div>
          <div class="pull-right">
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Kelengkapan Dokumen Pengajuan</th>
                <th class="text-center" style="width: 15%;"> Status Verifikasi </th> 
             </tr>
            </thead>
           <tbody>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Ketersediaan Dana pada RKA-KL</td>
                <td class="text-center">
                <?php if($verif['rkakl'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=brkakl" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=rkakl" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Kesesuaian Kode Anggaran</td>
                <td class="text-center">
                <?php if($verif['kode_anggaran'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=bkode_anggaran" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=kode_anggaran" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Nota Dinas pengajuan</td>
                <td class="text-center">
                <?php if($verif['nd_pengajuan'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=bnd_pengajuan" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=nd_pengajuan" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>SPP Aplikasi</td>
                <td class="text-center">
                <?php if($verif['spp'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=bspp" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=spp" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>SPTB</td>
                <td class="text-center">
                <?php if($verif['sptb'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=bsptb" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=sptb" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Kwitansi</td>
                <td class="text-center">
                <?php if($verif['kwitansi'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=kwitansi&p=batal" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=kwitansi&p=update" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Faktur Pajak/Dokumen Pajak</td>
                <td class="text-center">
                <?php if($verif['faktur_pajak'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=faktur_pajak&p=batal" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=faktur_pajak&p=update" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>FC NPWP</td>
                <td class="text-center">
                <?php if($verif['npwp'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=npwp&p=batal" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=npwp&p=update" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>FC Nomor Rekening</td>
                <td class="text-center">
                <?php if($verif['no_rek'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=no_rek&p=batal" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=no_rek&p=update" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>

             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Alamat lengkap dan kode pos penyedia</td>
                <td class="text-center">
                <?php if($verif['alamat_lengkap_penyedia'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=alamat_lengkap_penyedia&p=batal" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=alamat_lengkap_penyedia&p=update" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>

             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Status Dokumen</td>
                <td class="text-center">
                <?php if($verif['status_pengajuan'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=bstatus_pengajuan" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=status_pengajuan" class="btn btn-success">Terima</a>
                <?php } ?>
                </td>      
             </tr>
           </tbody>
         </table>

         <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Kelengkapan Dokumen Pertanggungjawaban</th>
                <th class="text-center" style="width: 15%;"> Status Verifikasi </th> 
             </tr>
            </thead>
           <tbody>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>SP2D</td>
                <td class="text-center">
                  <?php if($verif['sp2d'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=bsp2d" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=sp2d" class="btn btn-success">Proses</a>
                  <?php } ?>
                </td>      
             </tr>
             
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
