<?php
  $page_title = 'All BKU';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $user = find_by_id('users',$_SESSION['user_id']);
   if($user['user_level'] == 2){ //echo "ok 3";exit();
   page_require_level(3); 
   }else if($user['user_level'] == 5 ){ //echo "7";exit();
     page_require_level(5); 
   }else{ //echo "3";exit();
     page_require_level(3); 
   }
?>
<?php

$sales = find_all_group_by_satker('pencairan','id_satker',2021);

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
            <span>All BKU</span>
          </strong>
          <div class="pull-right">
        
          </div>
        </div>
        <div class="panel-body"  style="width: 100%;">
          <table id="tabel" class="table table-bordered table-striped" style="width: 100%;">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center" > Satker </th>
                <th class="text-center" > Pencairan </th>
                <th class="text-center" > Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php $tot=0; foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center" >
                    <?php $satker=find_by_id('satker',$sale['id_satker']); echo $satker['keterangan']?>
              </td>

              <td class="text-center" >
                <?php echo rupiah($sale['nominal'])?>
              </td>
    
              <td class="text-center">
                  <div class="btn-group">
                     
                     <a href="detail_BKU.php?id=<?php echo (int)$sale['id_satker'];?>" class="btn btn-primary btn-xs"  title="Detail BKU" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-eye-open"></span>
                     </a>
            
                  </div>
               </td>
             </tr>
             <?php $tot+=$sale['nominal']; endforeach;?>
           </tbody>
           <tr>
                <th class="text-center">#</th>
                <th class="text-center" > </th>
                <th class="text-center" > <?=rupiah($tot);?> </th>
                <th class="text-center">  </th> 

             </tr>
         </table>
        </div>
      </div>
    </div>
  </div>



<?php include_once('layouts/footer.php'); ?>
