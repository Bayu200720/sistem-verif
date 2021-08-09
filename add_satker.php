<?php
  $page_title = 'Add satker';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('jenis');
  $satker = find_all('satker');
  $all_photo = find_all('media');
  $user = find_by_id('users',(int)$_SESSION['user_id']);
?>
<?php
 if(isset($_POST['add_satker'])){
   $req_fields = array('keterangan');
   validate_fields($req_fields);
   if(empty($errors)){
     $keterangan  = remove_junk($db->escape($_POST['keterangan']));
    
     $date    = make_date();
     $query  = "INSERT INTO satker(";
     $query .=" id,keterangan";
     $query .=") VALUES (";
     $query .=" '{}', '{$keterangan}'";
     $query .=")";
     if($db->query($query)){
       $session->msg('s',"satker added ");
       if($user['user_level']==2){
        redirect('satker.php', false);
       }else{
       redirect('satker.php', false);
       }
     } else {
       $session->msg('d',' Sorry failed to added!');
       if($user['user_level']==2){
        redirect('satker.php', false);
      }else{
         redirect('satker.php', false);
      }
     }

   } else{
     $session->msg("d", $errors);
     redirect('satker.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New satker</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="keterangan" placeholder="Nama Satker">
               </div>
              </div>

              <button type="submit" name="add_satker" class="btn btn-danger">Add satker</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
