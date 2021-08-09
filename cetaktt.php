<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(5);
?>

<?php //include_once('layouts/header.php'); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

<style type="text/css">
   #center{
   	text-align: center;
   }	
   #right{
   	text-align: right;
   }

</style>
</head>

<body>

<?php $satker = find_all('satker');
     foreach ($satker as $s):?>

<?php $pengajuan= find_ss($s['id'],$_GET['id']); 
    //($pengajuan);
    //var_dump($satker);exit();
    if($pengajuan[0]['id'] == NULL){
        continue;
    }
echo $s['keterangan'];
?>

<table border="1">
  <tr id="center">
    <td width="48" valign="bottom"><strong> No</strong>.</td>
    <td width="96" valign="bottom"><strong> SPM</strong></td>
    <td width="130" valign="bottom"><strong> Nominal Final</strong></td>
    <td width="130" valign="bottom"><strong> Tanda Tangan</strong></td>
  </tr>
  <?php $no=0; $jml=0; foreach ($pengajuan as $p):?>
  <tr >
    <td id="center" width="48" valign="bottom"><strong> <?php $no+=1;echo $no;?></strong>.</td>
    <td id="center" width="96" valign="bottom"><strong> <?=$p['spm'];?></strong></td>
    <td id="center" width="130" valign="bottom"><strong><?php echo rupiah($p['nominal']); ?></strong></td>
    <td width="130"  valign="bottom" style="text: right;"><strong id="left"><?php $satker =find_by_id('satker',$p['id_satker']); echo $satker['bpp']; ?></strong></td>
  </tr>
  <?php $jml+=$p['nominal']; endforeach;?>
  <tr id="center">
    <td width="48" valign="bottom"><strong> &nbsp;</strong></td>
    <td width="96" valign="bottom"><strong> &nbsp;Jumlah </strong></td>
    <td width="281" valign="bottom" ><strong><?=rupiah($jml);?> </strong></td>
    <td width="130" valign="bottom"><strong> &nbsp;</strong></td>
  </tr>
</table>

<?php endforeach;?>


</table>
</body>
</html>
