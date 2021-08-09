<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  include "phpqrcode/qrlib.php";
  // Checkin What level user has permission to view this page
  if($user['user_level'] == 3){ 
    page_require_level(3);
  }else if($user['user_level'] == 8){
    page_require_level(8);
  }else if($user['user_level'] == 6){
    page_require_level(6);
  } 
?>
<?php
$nodin = find_all_global('nodin',$_GET['id'],'id');
$satker = find_all_global('satker',$nodin[0]['id_satker'],'id');

$pengajuan= find_n_p_dp($nodin[0]['id']);

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

</style>
</head>

<body>
  <br>
	
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><strong>NOTA DINAS </strong></p>
<p align="center"> No. : &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<?=$nodin[0]['no_nodin']?> /<?=$satker[0]['prefik']?>/KU.01.05/<?php echo $today = date('m' ); ?>/<?=date('Y');?> </p>
<table width="100%" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="173" valign="top"> Kepada Yth </td>
    <td width="24" valign="top"> : </td>
    <td width="743" valign="top"> Kuasa Pengguna Anggaran Badan Litbang SDM</td>
  </tr>
  <tr>
    <td width="173" valign="top">Dari</td>
    <td width="24" valign="top"> : </td>
    <td width="743" valign="top"> Pejabat Pembuat Komitmen Sekretariat Badan Litbang SDM </td>
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
    <td colspan="3" valign="top">Dalam rangka pelaksanaan kegiatan Sekretariat Badan Litbang SDM, bersama ini di sampaikan pengajuan SPP LS sebagai berikut : </td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="99%" border="1" align="left" cellpadding="0" cellspacing="0">
  <tr id="center">
    <td width="48" valign="bottom"><strong> No</strong>.</td>
    <td width="96" valign="bottom"><strong> SPM</strong></td>
    <td width="281" valign="bottom"><strong> MAK</strong></td>
    <td width="162" valign="bottom"><strong> Nominal</strong></td>
    <td width="130" valign="bottom"><strong> Tanggal</strong></td>
  </tr>
  <?php $no=0; $jml=0; foreach ($pengajuan as $p):?>
  <tr id="center">
    <td width="48" valign="bottom"><strong> <?php $no+=1;echo $no;?></strong>.</td>
    <td width="96" valign="bottom"><strong> <?=$p['spm'];?></strong></td>
    <td width="281" valign="bottom"><strong><?=$p['akun'];?></strong></td>
    <td width="162" valign="bottom"><strong><?=rupiah($p['nominal']);?></strong></td>
    <td width="130" valign="bottom"><strong> <?=$p['tgl'];?></strong></td>
  </tr>
  <?php $jml+=$p['nominal'];  endforeach;?>
  <tr id="center">
    <td width="48" valign="bottom"><strong> &nbsp;</strong></td>
    <td width="96" valign="bottom"><strong> &nbsp; </strong></td>
    <td width="281" valign="bottom" 
    ><strong> Jumlah</strong></td>
    <td width="162" valign="bottom" 
    ><strong> <?=rupiah($jml);?></strong></td>
    <td width="130" valign="bottom"><strong> &nbsp;</strong></td>
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
        <td width="329" valign="top" class="style24">
          <p><br>
            <br>
            <br>
            
          </td>
        <td width="188" valign="top" class="style24">&nbsp;</td>
        <td width="330" valign="top" class="style24"><p>Pejabat Pembuat Komitmen <br>
        Sekretariat Badan Litbang SDM </p>
            <p> <br>
              <br>
              <?php
              ini_set('date.timezone', 'Asia/Jakarta');
             // echo 'Indonesian Timezone: ' . date('d-m-Y H:i:s');
                  $nama = "Disahkan Oleh :".$satker[0]['ppk']." NIP.".$satker[0]['nip_ppk'];
                  $folder = "qrcode/";
                  $qual = "H";
                  $nm_file= "qr".$satker[0]['nip_ppk'].".png";
                  $ukuran = 4;
                  $padding = 0;
                QRCODE :: png($nama,$folder.$nm_file,$qual,$ukuran,$padding); 
                
                if($nodin[0]['approvel_atasan']== 1 ){
                ?>
                
                <img src="qrcode/<?=$nm_file;?>" alt="">
                <?php } ?>
              <br>
            
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
  <table border="1" cellspacing="0.5" >
    <tr>
      <td> FR.02&nbsp;Ed.01&nbsp;Rev.00</td>
      
    </tr>
  </table>
</body>
</html>

<script language="javascript">window.print();</script>