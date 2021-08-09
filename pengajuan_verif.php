<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $user = find_by_id('users',$_SESSION['user_id']);
 
   if($user['user_level'] == 2){ //echo "ok 3";exit();
   page_require_level(3); 
   }else if($user['user_level'] == 7 ){ //echo "7";exit();
     page_require_level(7); 
   }else{ //echo "3";exit();
     page_require_level(3); 
   }


?>
<?php
$sales = find_pengajuanok();

if(isset($_POST['cari'])){
  $sql = "select * from nodin where tanggal between '".$_POST['tgl1']."' and '".$_POST['tgl2']."'";
  $sales= find_pengajuanok_tgl($_POST['tgl1'],$_POST['tgl2']);
 }
//var_dump($sales);exit();
//print_r($sales);exit();//find_all('pengajuan');
$id = find_all_global('pengajuan',$_GET['id'],'id_nodin');
$idi= $_GET['id'];
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
              <form action="pengajuan_verif.php" method="POST" >
          
                    <input type="date"  name="tgl1">
              
                    <input type="date"   name="tgl2"> 
              
                    <input type="submit" class="btn btn-primary" name="cari" value="Cari">
                
              </form>
          </div>
        </div>
        <div class="panel-body">
          <table id="tabel" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" > SPM </th>
                <th class="text-center" > Jenis Pengajuan</th>
                <th class="text-center" > Satker </th>
                <th class="text-center" > Tanggal </th>
                <th class="text-center" > Nominal Pengajuan </th>
                <th class="text-center" > Status </th>
                <th class="text-center" > Validasi Kasubbag </th>
                <th class="text-center" > Lembar Verif </th>
                <th class="text-center" > Waktu </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php $tot=0; foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center" >
                <?php echo remove_junk($sale['SPM']); ?>
                
              </td>
              <td class="text-center"><?php $nodin=find_by_id('nodin',$sale['id_nodin']);$jenis=find_by_id('jenis',$nodin['id_jenis']); echo $jenis['keterangan']?> </td>
              <td class="text-center" ><?php $nodin=find_by_id('nodin',$sale['id_nodin']);$satker=find_by_id('satker',$nodin['id_satker']); echo $satker['keterangan']?></td>
              <td class="text-center"><?php $nodin= find_by_id('nodin',$sale['id_nodin']);echo $nodin['tanggal']; ?></td>
              <td class="text-center" ><?php $tp=find_NominalPengajuan($sale['id']);echo rupiah($tp['jum']);?></td>
              <td class="text-center" >
                	<?php if($sale['status_verifikasi'] == 0){
                           echo "<span class='glyphicon glyphicon-remove-circle btn-danger'></span>Belom Terverifikasi ";
                      }else{
                          echo "<span class='glyphicon glyphicon-ok-circle btn-success'></span>Terverifikasi ";
                      }	             		
                	?>
              </td>
              
              <td class="text-center" >
                	<?php if($sale['verifikasi_kasubbag_v'] == ''){
                           echo "<span class='glyphicon glyphicon-remove-circle btn-danger'></span>Belom Tervalidasi ";
                      }else{
                          echo "<span class='glyphicon glyphicon-ok-circle btn-success'></span>Tervalidasi ";
                      }	             		
                	?>
              </td>
              <td class="text-center" >
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
           
           ?>" class="btn btn-warning" style="margin: 20px;" target="_BLANK">Form Verif</a>
       <?php } ?> 
              <a href="histori.php?id=<?=$sale['id']?>" class="btn btn-primary">Histori</a>
           <?php 
              $user=find_by_id('users',$_SESSION['user_id']); 
            
				$hsl = find_count_global('histori',$sale['id'],'id_pengajuan'); 
                    if($hsl[0]['jml'] > 0){
                      echo '<span class="badge">'.$hsl[0]['jml'].'</span>';
                      }
            ?>
              </td>
              <td class="text-center"><?php echo $sale['created_at']?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="detail_dokumen_ses.php?id=<?=$sale['id']?>" class="btn btn-success btn-xs" title="Detail status Pengajuan" data-toggle="tooltip" > <span class="glyphicon glyphicon-folder-open"></span></a>
                     <a href="detail_pengajuan.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-primary btn-xs"  title="Detail Pengajuan" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-eye-open"></span>
                     </a>
            
                  </div>
               </td>
             </tr>
             <?php $tot+=$tp['jum']; endforeach;?>
           </tbody>
           <tfoot>
           <tr>
                <th class="text-center" >#</th>
                <th class="text-center" >  </th>
                <th class="text-center" >  </th>
                <th class="text-center" >  </th>
                <th class="text-center" >  </th>
                <th class="text-center" >  <?=rupiah($tot);?> </th>
                <th class="text-center" > </th>
                <th class="text-center" > </th>
                <th class="text-center" > </th>
                <th class="text-center" > </th>
                <th class="text-center" > </th>
             </tr>
             <tfoot>
         </table>
        </div>
      </div>
    </div>
  </div>




<?php include_once('layouts/footer.php'); ?>
