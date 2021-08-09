<?php
  $page_title = 'All Detail Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);
?>
<?php
$sales = find_detail($_GET['id']);
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
            <span>All Detail Pengajuan</span>
          </strong>
          <div class="pull-right">
           
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
               <td class="text-center"><?php $akun=find_all_by_id('akun',$sale['id_akun']); echo $akun['mak'] ; ?></td>
               <td class="text-center"><?php echo rupiah($sale['nominal']); ?></td>
               <td class="text-center"><?php echo rupiah($sale['pph']); ?></td>
               <td class="text-center"><?php echo rupiah($sale['ppn']); ?></td>
               <td class="text-center"><?php echo $sale['keterangan'];  ?></td>
             </tr>

             <?php $tot+=$sale['nominal']; $tot1+=$sale['pph']; $tot2+=$sale['ppn']; endforeach;?>
           </tbody>
            <tr>
                <th >Jumlah</th>
                <th >  </th>
                <th > </th>
                <th > <?=rupiah($tot);?> </th> 
                <th > <?=rupiah($tot1);?> </th>
                <th > <?=rupiah($tot2);?> </th>
                <th >  </th>
               
             </tr>
         </table>
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
