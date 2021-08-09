<?php
$page_title = 'Report';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $myid=implode(',',$_POST['id']);
  $id=$myid; 
  $results= find_Pengajuan($id);
  // var_dump($results);
  //  exit();
 // $results = find_all_global('detail_pengajuan',$_GET['id'],'id_pengajuan');
 // $spm = find_all_global('pengajuan',$_GET['id'],'id');
  $user = find_all_global('users',$_SESSION['user_id'],'id');
?>

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

</style>
</head>

<body>
  <br>
	
<img src="uploads/users/kopses1.jpg" hight="100%" width="100%">
<p align="center"><strong>TANDA TERIMA PENGAJUAN SPM</strong></p>
<table width="100%" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="173" valign="top"> Kode Satker </td>
    <td width="24" valign="top"> : </td>
    <td width="743" valign="top"> 664297</td>
  </tr>
  <tr>
    <td width="173" valign="top">Nama Satker</td>
    <td width="24" valign="top"> : </td>
    <td width="743" valign="top"> <?php $u = find_all_global('satker',$results[0]['id_satker'],'id'); echo $u[0]['keterangan'];?> </td>
  </tr>
  <tr>
    <td width="173" valign="top">Tangal Pengajuan Dokumen </td>
    <td width="24" valign="top"> : </td>
    <td width="743" valign="top"> <?=$results[0]['tanggal'];?> </td>
  </tr>
  
  <tr>
    <td colspan="3" valign="top"><hr></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="99%" border="1" align="left" cellpadding="0" cellspacing="0">
  <tr id="center">
    <td width="48" valign="bottom"><strong> No</strong>.</td>
    <td width="96" valign="bottom"><strong> SPM</strong></td>
    <td width="281" valign="bottom"><strong> SPTJB</strong></td>
    <td width="162" valign="bottom"><strong> Akun</strong></td>
    <td width="162" valign="bottom"><strong> Nominal</strong></td>
    <td width="130" valign="bottom"><strong> PPH</strong></td>
    <td width="162" valign="bottom"><strong> PPN</strong></td>
  </tr>
   <?php $tn=0;$tppn=0;$tpph=0;?>
  <?php foreach($results as $result): ?>
  <tr id="center">
    <td width="48" valign="bottom"><?php echo count_id(); ?></td>
    <td width="96" valign="bottom" ><?php print $result['SPM'];?></td>
    <td width="281" valign="bottom" ><?php print $result['no_sptjb'];?> </td>
    <td width="162" valign="bottom" ><?php print $result['akun'];?></td>
    <td width="130" valign="bottom" > <?php print rupiah($result['nominal']);?> </td>
    <td width="130" valign="bottom" > <?php print rupiah($result['pph']);?> </td>
    <td width="130" valign="bottom" > <?php print rupiah($result['ppn']);?> </td>
  </tr>
    <?php $tn+=$result['nominal'];$tpph+=$result['pph'];$tppn+=$result['ppn'];
    
    ?>
  <?php endforeach; ?>
  <tr id="center">
    <td width="48" valign="bottom"><strong> &nbsp;</strong></td>
    <td width="96" valign="bottom"><strong> &nbsp; </strong></td>
    <td width="281" valign="bottom" ><strong> Jumlah</strong></td>
    <td width="162" valign="bottom" ><strong></strong></td>
    <td width="130" valign="bottom"><strong> <?=rupiah($tn);?></strong></td>
    <td width="130" valign="bottom"><strong><?=rupiah($tpph);?></strong></td>
    <td width="130" valign="bottom"><strong> <?=rupiah($tppn);?></strong></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"> </td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" class="style24">&nbsp;</td>
      </tr>
      <tr>
        <td width="14" class="style24">&nbsp; </td>
        <td width="329" valign="top" class="style24"><p>Petugas<br>
          Verifikasi</p>
          <p><br>
            <br>
            <br>
            <strong><?php echo $user[0]['name'];?><br>
            </strong>NIP. <?php echo $user[0]['nip'];?> </p>
          </td>
        <td width="188" valign="top" class="style24">&nbsp;</td>
        <td width="330" valign="top" class="style24"><p>Petugas <br>
          Satker </p>
            <p> <br>
              <br>
              <br>
            <strong><?php echo $result['p_pengajuan'];?> <br>
            </strong></p>
            <p>&nbsp; </p>
            <p>&nbsp; </p>
          <p>&nbsp; </p></td>
      </tr>
      <tr>
        <td class="style24">&nbsp;</td>
        <td class="style24"><strong> </strong></td>
        <td class="style24">&nbsp;</td>
        <td class="style24">&nbsp;</td>
      </tr>
      <tr>
        <td height="54" class="style24">&nbsp;</td>
        <td class="style24"></td>
        <td class="style24">&nbsp;</td>
        <td class="style24">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>

<script language="javascript">window.print();</script>