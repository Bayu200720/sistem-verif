<?php
  $page_title = 'All Detail Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   // Checkin What level user has permission to view this page
   $user = find_by_id('users',$_SESSION['user_id']);
  // var_dump($user['user_level']);
    if($user['user_level'] == 2){ //echo "ok 3";exit();
    page_require_level(3); 
    }else if($user['user_level'] == 7 ){ //echo "7";exit();
      page_require_level(7); 
    }else if($user['user_level'] == 6){ //echo "3";exit();
      page_require_level(6); 
    }else{
      page_require_level(3);
    }  

    
  ?>

<?php include_once('layouts/header.php'); ?>
<div id="content">
    <div id="dialog"></div>
            <div class="card-header">
                <h2 style="margin-left: 40%;" class="card-title">Daftar Monitoring Verifikasi <?=$tahun;?></h2>
            </div>
            <div class="btn-group" style="margin-left: 93%; margin-bottom: 5px">
                           
            </div>
                
            </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>Uraian</th>
                  <th>File</th> 
                  <th>Aksi</th>
                </tr>
                </thead> 
                <tbody>
                <tr>
                      <td>1</td>
                      <td>adas</td>
                      <td>asdasd</td>
                      <td>asdasdadasda </td>
                      <td> sdasd</td>

                </tr>
                <tr>
                      <td>2</td>
                      <td>Bayu</td>
                      <td>asdasd</td>
                      <td>asdasdadasda </td>
                      <td> sdasd</td>

                </tr>
                </tbody>

                <tfoot>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>Uraian</th>
                  <th>MAK</th>
                  <th>Aksi</th>

                </tr>
                </tfoot>
              </table>
 <?php include_once('layouts/footer.php'); ?>

<!-- jQuery -->
<script src="libs/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="libs/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="libs/js/jquery.dataTables.js"></script>
<script src="libs/js/dataTables.bootstrap4.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</div>

