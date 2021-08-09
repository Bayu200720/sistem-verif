<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $user = find_by_id('users',$_SESSION['user_id']);
  if($user['user_level'] == 2){ //echo "ok 3";exit();
  page_require_level(2); 
  }else if($user['user_level'] == 7 ){ //echo "7";exit();
    page_require_level(7); 
  }else{ //echo "3";exit();
    page_require_level(2); 
  }
?>
<?php
$verif = find_by_filed('verifikasi',$_GET['id'],'id_pengajuan');
//var_dump($verif);exit();
$id_pengajuan = $_GET['id'];
//$update ="UPDATE `pengajuan` SET `jenis_v` = 'v_pd_ln',`status_verifikasi`=".$_SESSION['user_id']." WHERE `pengajuan`.`id` =".$id_pengajuan;
$update ="UPDATE `pengajuan` SET `status_verifikasi`=".$_SESSION['user_id']." WHERE `pengajuan`.`id` =".$id_pengajuan;
//    echo $update; exit();
    $db->query($update);
if($verif == NULL){
  
    $query = "INSERT INTO verifikasi (`id_pengajuan`) VALUES (".$id_pengajuan.")";
    
    if($db->query($query)){
      $session->msg('s',"Siap di Verifikasi ");
      redirect('v_pd_ln.php?id='.$id_pengajuan, false);
    } else {
      $session->msg('d',' Sorry failed to added!');
      redirect('v_pd_ln.php?id='.$id_pengajuan, false);
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
            <span>Verifikasi Perjalanan Dinas Luar Negeri</span>
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
               <td>Daftar Nominatif</td>
                <td class="text-center">
                <?php if($verif['daftar_nominatif'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=bdaftar_nominatif" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=daftar_nominatif" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Surat Tugas</td>
                <td class="text-center">
                <?php if($verif['st'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=bst" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=st" class="btn btn-success">Proses</a>
                <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>SP Setneg</td>
                <td class="text-center">
                <?php if($verif['sp_setneg'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=bsp_setneg" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&key=sp_setneg" class="btn btn-success">Proses</a>
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

             <?php $user = find_by_id('users',$_SESSION['user_id']); if($user['user_level']== 7){?>
             
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Validasi Kasubbag Verifikasi</td>
                <td class="text-center">
                <?php $pengaju=find_by_id('pengajuan',$verif['id_pengajuan']);  if($pengaju['verifikasi_kasubbag_v'] == 1){?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&p=bv_kasubbag" class="btn btn-danger">Batal</a>
                <?php }else{ ?>
                  <a href="proses_v.php?id=<?=$verif['id']?>&p=v_kasubbag" class="btn btn-success">Validasi</a>
                <?php } ?>
                </td>      
             </tr>
                <?php } ?>


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
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Rincian Biaya Perjalanan Dinas</td>
                <td class="text-center">
                 <?php if($verif['rincian'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=brincian" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=rincian" class="btn btn-success">Proses</a>
                  <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Daftar Pengeluaran Rill</td>
                <td class="text-center">
                 <?php if($verif['pengeluaran_rill'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=bpengeluaran_rill" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=pengeluaran_rill" class="btn btn-success">Proses</a>
                  <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Tanda Tiba</td>
                <td class="text-center">
                 <?php if($verif['tanda_tiba'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=btanda_tiba" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=tanda_tiba" class="btn btn-success">Proses</a>
                  <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Tiket Pesawat/tiket kereta</td>
                <td class="text-center">
                <?php if($verif['tiket_pesawat'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=btiket_pesawat" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=tiket_pesawat" class="btn btn-success">Proses</a>
                  <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>boardingpass/ tiket kereta</td>
                <td class="text-center">
                <?php if($verif['boardingpass'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=bboardingpass" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=boardingpass" class="btn btn-success">Proses</a>
                  <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>SPD ttd PPK</td>
                <td class="text-center">
                <?php if($verif['spd'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=bspd" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=spd" class="btn btn-success">Proses</a>
                  <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Invoice Hotel</td>
                <td class="text-center">
                <?php if($verif['invoice_hotel'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=binvoice_hotel" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=invoice_hotel" class="btn btn-success">Proses</a>
                  <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Visa dan  Pasport di cap	</td>
                <td class="text-center">
                <?php if($verif['visa_paspor'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=bvisa_paspor" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=visa_paspor" class="btn btn-success">Proses</a>
                  <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Laporan Pelaksanan Tugas</td>
                <td class="text-center">
                <?php if($verif['lapgas'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=blapgas" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=lapgas" class="btn btn-success">Proses</a>
                  <?php } ?>
                </td>      
             </tr>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td>Undangan(Jika Ada)</td>
                <td class="text-center">
                <?php if($verif['undangan'] == 1){?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=bundangan" class="btn btn-danger">Batal</a>
                  <?php }else{ ?>
                    <a href="proses_v.php?id=<?=$verif['id']?>&key=undangan" class="btn btn-success">Proses</a>
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
