<?php
  $page_title = 'Edit Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
 $sale = find_by_id('product_in',(int)$_GET['id']);
  if(!$sale){
    $session->msg("d","Missing product id.");
    redirect('Bmasuk.php');
  }
?>
<?php $product = find_by_id('products',$sale['product_id']); ?>
<?php

  if(isset($_POST['update_sale'])){
    $req_fields = array('quantity', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$product['id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $date      = $db->escape($_POST['date']);

          $sql  = "UPDATE product_in SET";
          $sql .= " qty={$s_qty},date='{$date}'";
          $sql .= " WHERE id ='{$sale['id']}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                   //$h= update_product_qty_ok($p_id);
                      $session->msg('s',"Sale updated.");
                    redirect('edit_Bmasuk.php?id='.$sale['id'], false);
                  } else {
                    $session->msg('d',' Sorry failed to updated!');
                    redirect('Bmasuk.php', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('edit_Bmasuk.php?id='.(int)$sale['id'],false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
  <div class="panel">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>All Sales</span>
     </strong>
     <div class="pull-right">
       <a href="Bmasuk.php" class="btn btn-primary">Show all sales</a>
     </div>
    </div>
    <div class="panel-body">
       <table class="table table-bordered">
         <thead>
          <th> Product titles </th>
          <th> Qty </th>
          <th> Date</th>
          <th> Action</th>
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="edit_Bmasuk.php?id=<?php echo (int)$sale['id']; ?>">
                <td id="s_name">
                  <input type="text" class="form-control" id="sug_input" name="title" value="<?php echo remove_junk($product['name']); ?>" disabled>
                  <div id="result" class="list-group"></div>
                </td>
                <td id="s_qty">
                  <input type="text" class="form-control" name="quantity" value="<?php echo (int)$sale['qty']; ?>">
                </td>
                <td id="s_date">
                  <input type="date" class="form-control datepicker" name="date" data-date-format="" value="<?php echo remove_junk($sale['date']); ?>">
                </td>
                <td>
                  <button type="submit" name="update_sale" class="btn btn-primary">Update Barang masuk</button>
                </td>
              </form>
              </tr>
           </tbody>
       </table>

    </div>
  </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
