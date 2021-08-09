<?php
$page_title = 'Sales Report';
$results = '';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  // page_require_level(3);
?>
<?php
  // if(isset($_POST['submit'])){
  //   $req_dates = array('start-date','end-date');
  //   validate_fields($req_dates);

  //   if(empty($errors)):
  //     $start_date   = remove_junk($db->escape($_POST['start-date']));
  //     $end_date     = remove_junk($db->escape($_POST['end-date']));
  //     $results      = find_sale_by_dates($start_date,$end_date);
  //   else:
  //     $session->msg("d", $errors);
  //     redirect('sales_report.php', false);
  //   endif;

  // } else {
  //   $session->msg("d", "Select dates");
  //   redirect('sales_report.php', false);
  // }
  $results = find_all_global('detail_pengajuan',$_GET['id'],'id_pengajuan');
  $spm = find_all_global('pengajuan',$_GET['id'],'id');

?>
<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Default Page Title</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body>
  <?php if($results): ?>
    <div class="page-break">
       <div class="sale-head pull-right">
           <h1>Tanda Terima</h1>
           <strong><?php if(isset($start_date)){ echo $start_date;}?> To <?php if(isset($end_date)){echo $end_date;}?> </strong>
       </div>
      <table class="table table-border">
        <thead>
          <tr>
              <th>No</th>
              <th>SPM</th>
              <th>SPTJB</th>
              <th>Akun</th>
              <th>Nominal</th>
              <th>PPH</th>
              <th>PPN</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($results as $result): ?>
           <tr>
              <td class=""><?php echo count_id();?></td>
              <td class="desc">
                <h6><?php echo remove_junk($spm[0]['SPM']);?></h6>
              </td>
              <td class="text-right"><?php echo remove_junk($result['no_sptjb']);?></td>
              <td class="text-right"><?php echo remove_junk($result['akun']);?></td>
              <td class="text-right"><?php echo remove_junk($result['nominal']);?></td>
              <td class="text-right"><?php echo remove_junk($result['pph']);?></td>
              <td class="text-right"><?php echo remove_junk($result['ppn']);?></td>
          </tr>
          </tr>
        <?php endforeach; ?>
            <tr>
              <th>No</th>
              <th>SPM</th>
              <th>SPTJB</th>
              <th>Akun</th>
              <th>Nominal</th>
              <th>PPH</th>
              <th>PPN</th>
            </tr>
        </tbody>
      </table>
    </div>
  <?php
    else:
        $session->msg("d", "Sorry no sales has been found. ");
        redirect('sales_report.php', false);
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
