<?php
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
 $c_satker     = count_by_id('satker');
 $c_SPM       = count_by_id('pengajuan');
 $c_sptjb          = count_by_id('detail_pengajuan');
 $c_user          = count_by_id('users');
 $products_sold   = find_higest_saleing_product();
 $recent_products = find_recent_product_added();
 $recent_sales    = find_recent_sale_added()
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
  <div class="row">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_user['total']; ?> </h2>
          <p class="text-muted">Users</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-list"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_SPM['total']; ?> </h2>
          <p class="text-muted">SPM</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-shopping-cart"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_satker['total']; ?> </h2>
          <p class="text-muted">Satker</p>
        </div>
       </div>
    </div>
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
          <i class="glyphicon glyphicon-usd"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_sptjb['total']; ?></h2>
          <p class="text-muted">SPTJB</p>
        </div>
       </div>
    </div>
</div>
  <div class="row">
   <div class="col-md-12">
      <div class="panel">
        <div class="jumbotron text-center">
          

        </div>
      </div>
   </div>
  </div>
  <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Total Pengajuan Setiap Sub Satker</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th>No</th>
             <th>Nama Satker</th>
             <th>Total SPM</th>
           <tr>
          </thead>
          <tbody>
            <?php $tot2=0; foreach ($products_sold as  $product_sold): ?>
              <tr>
                <td><?php echo count_id();?></td>
                <td><?php echo remove_junk(first_character($product_sold['keterangan'])); ?></td>
                <td><?php echo (int)$product_sold['total_spm']; ?></td>
                
              </tr>
            <?php $tot2+=$product_sold['total_spm'];  endforeach; ?>
            <tr>
               <td class="text-center"></td>
               <td class="text-center">Jumlah</td>
               <td><?php echo rupiah(remove_junk(first_character($tot2))); ?></td>
           </tr>

          <tbody>
         </table>
       </div>
     </div>
   </div>
   <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Realisasi Setiap Sub Satker</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           <th class="text-center" style="width: 50px;">#</th>
           <th>Satker</th>
           <th>Total Penyerapan</th>
         </tr>
       </thead>
       <tbody>
         <?php $n1=0;$tot1=0; foreach ($recent_products as  $recent_sale): $n1+=1; ?>
         <tr>
           <td class="text-center"><?php echo $n1;?></td>
           <td><?php echo remove_junk(ucfirst($recent_sale['keterangan'])); ?></td>
           <td>Rp. <?php echo rupiah(remove_junk(first_character($recent_sale['total']))); ?></td>
        </tr>

       <?php $tot1+=$recent_sale['total'];  endforeach; ?>
          <tr>
           <td class="text-center"></td>
           <td class="text-center">Jumlah</td>
           <td>Rp. <?php echo rupiah(remove_junk(first_character($tot1))); ?></td>
          </tr>
       </tbody>
     </table>
    </div>
   </div>
  </div>

  <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>SPM Sub Satker yang Belom di Proses</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           <th class="text-center" style="width: 50px;">#</th>
           <th>Satker</th>
           <th>Total SPM</th>
         </tr>
       </thead>
       <tbody>
         <?php $n=0;$tot=0; foreach ($recent_sales  as  $r): $n+=1;?>
         <tr>
           <td class="text-center"><?php echo $n;?></td>
           <td><?php echo remove_junk(ucfirst($r['keterangan'])); ?></td>
           <td><?php echo rupiah(remove_junk(first_character($r['jumlah_SPM']))); ?></td>
        </tr>
        
       <?php $tot+=$r['jumlah_SPM'];  endforeach; ?>
         <tr>
           <td class="text-center"></td>
           <td class="text-center">Jumlah</td>
           <td><?php echo rupiah(remove_junk(first_character($tot))); ?></td>
        </tr>
       </tbody>
     </table>
    </div>
   </div>
  </div>
 </div>
</div>
 </div>
  <div class="row">

  </div>



<?php include_once('layouts/footer.php'); ?>
