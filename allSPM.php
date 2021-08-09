<?php
$page_title = 'ALL SPM';
require_once('includes/load.php');
  // Checkin What level user has permission to view this page
page_require_level(6);
?>
<?php
$user=find_by_id('users',$_SESSION['user_id']);
$satker = find_all_global('satker',$user['id_satker'],'id');

$sales = find_allSPM_satker($user['id_satker'],$user['tahun']);
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
          <span>All SPM</span>
        </strong>
        <div class="pull-right">
        </div>
      </div>
      <div class="panel-body" style="width:100%">
        <table id="tabel" class="table table-bordered table-striped" style="width:100%;">
          <thead>
            <tr>
              <th class="text-center" >#</th>
              <th class="text-center"> Nomor Nodin</th>
              <th class="text-center"> SPM</th>
              <th class="text-center"> Nominal </th>
              <th class="text-center"> PPh </th>             
              <th class="text-center"> PPn </th>
              <th class="text-center"> Status </th>
            </tr>
          </thead>
          <tbody>
           <?php $total=0;$pph=0;$ppn=0;
                  foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo $sale['no_nodin']; ?></td>
               <td class="text-center"><?php echo $sale['SPM']; ?></td>
               <td class="text-center"><?php echo rupiah($sale['nominal']);  ?></td>  
               <td class="text-center"><?php echo rupiah($sale['pph']); ?></td>
               <td class="text-center"><?php echo rupiah($sale['ppn']); ?></td>
               <td class="text-center">
                    <?php if($sale['status_sp2d'] != 0){
                        echo '<span class="glyphicon glyphicon-ok-sign">Cair</span>';
                    }else{
                        echo '<span class="glyphicon glyphicon-remove-sign">Belom Cair</span>';
                    }
                    
                    ?>
               
               </td>
           </tr>
         <?php  
                $total+=$sale['nominal'];$pph+=$sale['pph'];$ppn+=$sale['ppn'];
                endforeach;?>
       </tbody>
       <tfoot>
            <th class="text-center" >#</th>
              <th class="text-center" > Nomor Nodin</th>
              <th class="text-center" > SPM</th>
              <th class="text-center" ><?php echo rupiah($total);?> </th>
              <th class="text-center"><?php echo rupiah($pph);?> </th>             
              <th class="text-center" > <?php echo rupiah($ppn);?> </th>
              <th class="text-center" > Status</th>
            </tr>
        </tfoot>
     </table>
   </div>
 </div>
</div>
</div>

<?php include_once('layouts/footer.php'); ?>
