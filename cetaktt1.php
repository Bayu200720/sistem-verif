<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(5);
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
   #left{
   	text-align: left;
   }	

</style>
</head>

<body>
  <br>
	
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><strong>REKAP PENGAJUAN & PENCAIRAN DANA</strong></p>
<p align="center"> </p>
<table width="100%" cellpadding="0" cellspacing="0" >
  

  <?php $satker = find_all('satker');
     foreach ($satker as $s):?>

<?php $pengajuan= find_ss($s['id'],$_GET['id']); 
     
    //var_dump($satker);exit();
    if($pengajuan[0]['id'] == NULL){
        continue;
    }
echo $s['keterangan'];
?>


  <tr>
    <td colspan="3" valign="top"><table width="99%" border="1" align="left" cellpadding="0" cellspacing="0">
  <tr id="center">
    <td width="48" valign="bottom"><strong> No</strong>.</td>
    <td width="96" valign="bottom"><strong> SPM</strong></td>
    <td width="162" valign="bottom"><strong> Nominal</strong></td>
    <td width="130" valign="bottom"><strong> Tanda Tangan</strong></td>
  </tr>

  <?php $no=0; $jml=0; foreach ($pengajuan as $p):?>

  <tr >
    <td id="center" width="48" valign="bottom"><?php $no+=1;echo $no;?></td>
    <td id="center" width="96" valign="bottom"><?=$p['spm'];?></td>
    <td id="center" width="162" valign="bottom"><?php echo rupiah($p['nominal']); ?></td>
    <td id="left" width="130" valign="bottom"> <?php $satker =find_by_id('satker',$p['id_satker']); echo $satker['bpp']; ?> </td>
  </tr>
  <?php $jml+=$p['nominal']; endforeach;?>
  <tr id="center">
    <td width="48" valign="bottom"><strong> &nbsp;</strong></td>
    <td width="96" valign="bottom"><strong> Jumlah&nbsp; </strong></td>
    <td width="281" valign="bottom"><strong> <?=rupiah($jml);?></strong></td>
    <td width="130" valign="bottom"><strong> &nbsp;</strong></td>
  </tr>
</table><?php endforeach;?></td>
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
    <td valign="top">&nbsp;<strong>Jumlah Total = <?php $htot=sumStatus($_GET['id']); echo rupiah($htot['jum']); ?></strong></td>
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
        <td width="329" valign="top" class="style24"><p><br>
          </p>
          <p><br>
            <br>
            <br>
            <strong>
            <table border="1" cellspacing="0.5" >
                <tr>
                     <td> Jabatan</td>
                     <td> Paraf</td>
                </tr>
                <tr>
                     <td> Kepala Bagian Keuangan </td>
                     <td> </td>
                </tr>
                
            </table>
            
          </td>
        <td width="188" valign="top" class="style24"></td>
        <td width="330" valign="top" class="style24"><?php echo date('d-M-Y');?><br><p>Kuasa Pengguna Anggaran <br>
           </p>
            <p> <br>
              <br>
              <br>
            <strong>Dra. Haryati M.I.Kom <br>
            </strong>NIP. 196305021989032003</p>
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
  <br><br><br>
  
</body>
</html>
<script language="javascript">window.print();</script>