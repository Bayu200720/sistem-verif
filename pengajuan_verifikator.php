<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   //page_require_level(3);
?>
<?php
$sales = find_all_global('nodin',1,'status_pengajuan');

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
            <span>All Pengajuan</span>
          </strong>
          <div class="pull-right">
            <!--<a href="add_pengajuan.php" class="btn btn-primary">Add pengajuan</a>-->  
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 50px;">CheckBox</th>
                <th class="text-center" style="width: 15%;"> Tanggal</th>
                <th class="text-center" style="width: 15%;"> Jenis </th>
                <th class="text-center" style="width: 15%;"> Pegawai yang Mengajukan </th>
                <th class="text-center" style="width: 15%;"> Status </th>
                <th class="text-center" style="width: 15%;"> Tanda Terima </th>  
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
              <td class="text-center"><?php echo count_id();?></td>
              <form action="cetak.php" method="POST">
              <td class="text-center"><input type="checkbox" name="id[]" value="<?php echo $sale['id'];?>"></td>
               <td class="text-center"><?php echo $sale['tanggal']; ?></td>
               <td class="text-center"><?php $jenis = find_by_id('jenis',$sale['id_jenis']); echo $jenis['keterangan'];  ?></td>
               <td class="text-center"><?php  echo $sale['p_pengajuan'];  ?></td>
            <td class="text-center">
                <?php 
                
                  $pengaju = find_all_global('pengajuan',$sale['id'],'id_nodin');
                  //var_dump($pengaju);exit();
                  if($pengaju[0]['status_verifikasi']!=0 and $pengaju[0]['verifikasi_kasubbag_v']==1){
                    echo '<span class="label label-success">Telah di Verifiaksi</span>';
                  }else{
                    echo '<span class="label label-danger">Belom di Verifiaksi</span>';
                  }
                  ?>

            </td>
            <td class="text-center">
             <a href="cetakTandaTerima.php?id=<?=$sale['id']?>" class="btn btn-primary">Cetak</a>
            </td>
            
            
               <td class="text-center">
                  <div class="btn-group">
                    <!-- <a href="edit_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>-->
                     <a href="pengajuan_v.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail Pengajuan" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                    <!-- <a onclick="return confirm('Yakin Hapus?')" href="delete_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>-->
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
         <input type="submit" name="submit" value="cetak multiple" class="btn btn-primary">
         </form>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
