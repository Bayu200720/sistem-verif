<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
    <!-- Datatable -->
    <link rel="stylesheet" href="libs/css/dataTable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="libs/css/dataTable/responsive.bootstrap4.min.css">
<?php


$sales = find_all_global('pengajuan',$_GET['id'],'id_nodin');
$id = find_all_global('pengajuan',$_GET['id'],'id_nodin');
$pengajuan = find_by_id('pengajuan',(int)$_GET['id']);
$idi= $_GET['id'];



?>
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
            <!-- <a href="#" class="btn btn-primary" onclick="addPengajuan()">Add pengajuan</a> -->
          </div>
        </div>
        <div class="panel-body" style="width:100%">
          <table id="tabeledit" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center"> SPM </th>
                <th class="text-center"> Jenis Pengajuan </th>
                <th class="text-center"> Status Verifikasi </th> 
                <th class="text-center"> Status SPM </th>
                <th class="text-center">Berkas SPM</th>             
                <th class="text-center"> Status KPPN </th> 
                <th class="text-center"> Status SP2D </th>
                <th class="text-center"> Status Pengambilan Uang </th>
                <th class="text-center"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['SPM']); ?></td>
               <td><?php $jenis = find_by_id('jenis_pengajuan',$sale['id_jenis_pengajuan']); echo $jenis['keterangan']?></td>
               <td class="text-center"><?php if($sale['status_verifikasi']==0){?><span class="label label-danger">Belom di Proses</span><?php }else{?>
             <span class="label label-success">Sudah di Proses oleh <?php $user = find_by_id('users',(int)$sale['status_verifikasi']);echo $user['name'];?></span><?php } ?>
            <?php $verif = find_all_global('verifikasi',$sale['id'],'id_pengajuan');if($verif[0]['id_pengajuan']!=NULL){?>
               <a href="<?php 
                  if($sale['id_jenis_pengajuan']==1){
                    echo "verif_LSsppd.php?id=".$sale['id_nodin']."&v=".$sale['id'];
                  }else if($sale['id_jenis_pengajuan']==2){
                    echo "verif_sppdLn.php?id=".$sale['id_nodin']."&v=".$sale['id'];
                  }else if($sale['id_jenis_pengajuan']==3){
                    echo "verif_LSHonor.php?id=".$sale['id_nodin']."&v=".$sale['id'];
                  }else if($sale['id_jenis_pengajuan']==4){
                    echo "verif_LSjasprof.php?id=".$sale['id_nodin']."&v=".$sale['id'];
                  }else if($sale['id_jenis_pengajuan']==5){
                    echo "verif_LSkur50.php?id=".$sale['id_nodin']."&v=".$sale['id'];
                  }else{
                    echo "verif_GU.php?id=".$sale['id_nodin']."&v=".$sale['id'];
            
                  }
                
                ?>" class="btn btn-warning">Kekurangan</a>
            <?php } ?>
            </td>
            
            <td class="text-center"><?php if($sale['status_spm']==0){?><span class="label label-danger">Belom di Proses</span><?php }else{?>
             <span class="label label-success">Sudah di Proses oleh <?php $user = find_by_id('users',(int)$sale['status_spm']);echo $user['name'];?></span><?php } ?>
            </td>
            <td class="text-center">
               
            </td>

            <td class="text-center">
            <?php if($sale['penolakan_kppn']!=''){?><span class="label label-danger">Penolakan KPPN perbaiakan= <?=$sale['penolakan_kppn'];?></span><?php }else{ ?>
               
               <?php } ?>
               <?php if($sale['status_kppn']==0){?><span class="label label-danger">Belom di Proses</span><?php }else{?>
                <span class="label label-success">Sudah di Proses oleh <?php $user = find_by_id('users',(int)$sale['status_kppn']);echo $user['name'];?></span><?php } ?>
            </td>

            <td class="text-center"><?php if($sale['status_sp2d']==0){?><span class="label label-danger">Belom Cair</span><?php }else{?>
             <span class="label label-success">Sudah Cair [<?php $user = find_by_id('users',(int)$sale['status_sp2d']);echo $user['name'];?>]</span><?php } ?>
            </td>
            <td class="text-center">
                <?php if($sale['status_pengambilan_uang']==0){?><span class="label label-danger">Belom di Ambil</span><?php }else{?>
                 <span class="label label-success">Sudah Diambil <?php $user = find_by_id('users',(int)$sale['status_sp2d']);?></span><?php } ?>
            </td>

               <td class="text-center">
                  <div class="btn-group">
                    
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





  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="libs/js/functions.js"></script>
  

   <!-- Datatable -->
   <script src="libs/js/dataTable/jquery.dataTables.min.js"></script>
  <script src="libs/js/dataTable/dataTables.bootstrap4.min.js"></script>
  <script src="libs/js/dataTable/dataTables.responsive.min.js"></script>
  <script src="libs/js/dataTable/responsive.bootstrap4.min.js"></script>

<script>


$(document).ready(function() {
      dataTable();
    });

    function dataTable(){
      $('#tabeledit').DataTable({
        responsive:true
      });
    }
</script>