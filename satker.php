<?php
  $page_title = 'All satker';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sales = find_all('satker');

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
            <span>All satker</span>
          </strong>
          <div class="pull-right">
            <a href="add_satker.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus">Add</a>
          </div>
        </div>
        <div class="panel-body" width="100%">
          <table id="tabel" class="table table-bordered table-striped" width="100%">
            <thead>
              <tr>
                <th class="text-center" >#</th>
                <th class="text-center" > Keterangan</th>
                <th class="text-center" > Action </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>    
               <td class="text-center"><?php echo $sale['keterangan']; ?></td>              
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_satker.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-pencil"></span>
                     </a>
                     <a onclick="return confirm('Yakin Hapus?')" href="delete_satker.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
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
<?php include_once('layouts/footer.php'); ?>
