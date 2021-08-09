<?php
$page_title = 'Report';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  // page_require_level(3);
  $spm = find_all_global('pengajuan',$_GET['id'],'id_nodin');
  //var_dump($spm);
  $results = find_all_global('detail_pengajuan',$spm[0]['id'],'id_pengajuan');
  
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
	
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><strong>TANDA TERIMA </strong></p>
<table width="100%" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="173" valign="top"> Kepada Yth </td>
    <td width="24" valign="top"> : </td>
    <td width="743" valign="top"> Kuasa Pengguna Anggaran Badan Litbang SDM</td>
  </tr>
  <tr>
    <td width="173" valign="top">Dari</td>
    <td width="24" valign="top"> : </td>
    <td width="743" valign="top"> Pejabat Pembuat Komitmen Puslitbang Aptika IKP </td>
  </tr>
  <tr>
    <td width="173" valign="top">Lampiran </td>
    <td width="24" valign="top"> : </td>
    <td width="743" valign="top"> 1 (satu) berkas </td>
  </tr>
  <tr>
    <td width="173" valign="top"> Perihal </td>
    <td width="24" valign="top"> : </td>
    <td width="743" valign="top"> Usulan SPP- LS </td>
  </tr>
  <tr>
    <td width="173" valign="top"> Tanggal </td>
    <td width="24" valign="top"> : </td>
    <td width="743" valign="top"><?php echo $today = date('j-m-y' ); ?> </td>
  </tr>
  <tr>
    <td width="173" valign="top"> Sifat </td>
    <td width="24" valign="top"> :</td>
    <td width="743" valign="top"> Segera </td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><hr></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">Dalam rangka pelaksanaan kegiatan Puslitbang Aptika dan IKP, bersama ini di sampaikan pengajuan SPP LS sebagai berikut : </td>
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
    <td width="96" valign="bottom" ><?php print $spm[0]['SPM'];?></td>
    <td width="281" valign="bottom" ><?php print $result['no_sptjb'];?> </td>
    <td width="162" valign="bottom" ><?php print $result['akun'];?></td>
    <td width="130" valign="bottom" > <?php print $result['nominal'];?> </td>
    <td width="130" valign="bottom" > <?php print $result['pph'];?> </td>
    <td width="130" valign="bottom" > <?php print $result['ppn'];?> </td>
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
    <td colspan="3" valign="top">Demikian disampaikan, atas perhatian dan kerjasamanya diucapkan terimakasih </td>
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
        <td width="329" valign="top" class="style24"><p>Mengetahui<br>
          Verifikator</p>
          <p><br>
            <br>
            <br>
            <strong><?php echo $user[0]['name'];?><br>
            </strong>NIP. <?php echo $user[0]['nip'];?> </p>
          </td>
        <td width="188" valign="top" class="style24">&nbsp;</td>
        <td width="330" valign="top" class="style24"><p>Pegawai <br>
          yang Melakukan Pengajuan </p>
            <p> <br>
              <br>
              <br>
            <strong><?php echo $spm[0]['p_pengajuan'];?> <br>
            </strong></p>
            <p>&nbsp; </p>
            <p>&nbsp; </p>
          <p>&nbsp; </p></td>
      </tr>
      <tr>
        <td class="style24">&nbsp;</td>
        <td class="style24"><strong>Tembusan Yth: </strong></td>
        <td class="style24">&nbsp;</td>
        <td class="style24">&nbsp;</td>
      </tr>
      <tr>
        <td height="54" class="style24">&nbsp;</td>
        <td class="style24">Kepala Bagian Keuangan Badan Litbang SDM </td>
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

<script language="javascript">window.print();alert('ok');</script>