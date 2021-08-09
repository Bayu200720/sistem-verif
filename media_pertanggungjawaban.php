<?php
  $page_title = 'Dokumen';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(6);
?>

<?php include_once('layouts/header.php'); ?>
  <div class="row">
    <div class="col-md-6">
      <?php echo display_msg($msg); ?>
      <div id="alert-file-error" class="alert alert-danger alert-dismissible" role="alert" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span id="alert-messages"></span>
      </div>
    </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <span class="glyphicon glyphicon-camera"></span>
        <span>Dokumen</span>
        <div class="pull-right">
          <form id="form_upload_progress" class="form-inline" action="process/media_pertanggungjawaban.php?id=<?=$_GET['id'];?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-btn">
                <input type="file" name="file_upload" id="file_upload" multiple="multiple" class="btn btn-primary btn-file"/>
              </span>
              <input type="hidden" name="id" value="<?=$_GET['id'];?>">
              <button type="submit" name="submit" class="btn btn-default">Upload</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
