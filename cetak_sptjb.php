<?php
require_once('includes/load.php');
extract($_GET);

$q = "select * from `detail_transaksi` where `id_detail_pengajuan`=".$id; 
$result = $db->query($q);								
if($result){
	$hasil = find_by_id("detail_pengajuan",$id); 
    $user=find_by_id('users',$_SESSION['user_id']);
    $satker = find_all_global('satker',$user['id_satker'],'id');
	?>
<style type="text/css">
<!--
table td {padding-left:3px;}
.halman{
							page-break-after: always;
							 page-break-inside: avoid;
							 margin-top: 10px;
							 margin-bottom: 10px;
							 margin-left: 50px;
							 margin-right: 30px;

}
.style24 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style27 {padding-left:3px; font-weight: bold;}
-->
</style>

<div class="halman" align=center>
<form id="formulir_create">
<input type="hidden" name="mak" value="" />

<table width="755" border="0">
  <tr>
    <td height="23" colspan="5" class="style24"><div align="center"><strong>SURAT PERNYATAAN TANGGUNG JAWAB BELANJA</strong></div></td>
  </tr>
  <tr>
    <td colspan="5" class="style24"><div align="center"><strong>Nomor :      
      <label>
      <?php print $hasil['no_sptjb']; ?>
      </label> 
    /SPP-
    <label>
    <?=$d['lsgu']?>
    </label>
    <?=$setNoPrefikSPTJB?></strong></div></td>
  </tr>
  <tr>
    <td width="23" class="style24">&nbsp;</td>
    <td width="158" class="style24">&nbsp;</td>
    <td width="547" class="style24">&nbsp;</td>
    <td width="2" class="style24">&nbsp;</td>
    <td width="3" class="style24">&nbsp;</td>
  </tr>
  <tr>
    <td class="style24"><div align="right">1</div></td>
    <td class="style24">&nbsp;Kode Satuan Kerja</td>
    <td class="style24">:<?=$satker[0]['kode_satker']?></td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
  </tr>
  <tr>
    <td class="style24"><div align="right">2</div></td>
    <td class="style24">Nama Satuan Kerja</td>
    <td class="style24">:
      <?=$satker[0]['keterangan']?></td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
  </tr>
  <tr>
    <td class="style24"><div align="right">3</div></td>
    <td class="style24">Tanggal / No. SP DIPA </td>
    <td class="style24">:<label>
      <?=$satker[0]['DIPA']?>
    </label></td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
  </tr>
  <tr>
    <td class="style24"><div align="right">4</div></td>
    <td class="style24">Klasifikasi Anggaran</td>
    <td class="style24">:<?php $r=find_by_id('akun',$hasil['id_akun']); echo $r['mak']?></td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
  </tr>
  <tr>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
    <td class="style24"><?php echo $r['keterangan']?></td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="style24"><br />
    Yang bertanda tangan di bawah ini atas nama Kuasa Pengguna Anggaran Satuan Kerja Badan Penelitian dan Pengembangan SDM menyatakan bahwa saya bertanggung jawab secara formal dan material dan kebenaran perhitungan pemungutan pajak atas segala pembayaran tagihan yang telah kami perintahkan dalam SPM ini dengan perincian sebagai berikut :<br />
    <br /></td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
  </tr>
</table>

<table  height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="24" rowspan="2" class="style24"><div align="center" class="style27">No</div></td>
    <td width="55" rowspan="2" class="style24"><div align="center" class="style27">Akun</div></td>
	 <td width="128" rowspan="2" class="style24"><div align="center" class="style27">Penerima</div></td>
    <td width="190" rowspan="2" class="style24"><div align="center" class="style27">Uraian</div></td>
    <td colspan="2" class="style24"><div align="center">BUKTI</div></td>
    <td width="61" rowspan="2" class="style24"><div align="center" class="style27">Jumlah</div></td>
    <td colspan="2" class="style24"><div align="center" class="style27">Pajak yang di pungut </div></td>
    </tr>
  <tr>
    <td width="65" class="style24"><div align="center" class="style27">Tanggal</div></td>
    <td width="67" class="style24"><div align="center" class="style27">Nomor</div></td>
    <td width="62" class="style24"><div align="center" class="style27">PPN</div></td>
    <td width="59" class="style24"><div align="center" class="style27">PPH</div></td>
  </tr>
   <?php 
	$jml=0;
    $pph=0;
    $ppn=0;
			$qj= "select * from `detail_transaksi` where `id_detail_pengajuan`='".$id."'";
            $result = $db->query($qj); 
            foreach ($result as $sale):
                
               
            ?>		
					
					  <tr>
						<td class="style24"><div align="center" ><?php echo count_id() ?></div></td>
						<td class="style24"><div align="center" ><?php $r=find_by_id('akun',$hasil['id_akun']); echo $r['mak'] ?></div></td>
						 <td class="style24">&nbsp;<?php echo $sale['penerima']?></td>
						
						<td class="style24"><?php echo $sale['uraian'] ?></td>
						<td class="style24">&nbsp;<?=$sale['tanggal_transaksi']?></td>
						<td class="style24">&nbsp;<?=$sale['id_penerima']?></td>
						<td class="style24" >     <div style="padding-right:5px;" align="right">
							<?=rupiah($sale['nominal'])?>
						  </div></td>
						<td class="style24" ><div align="right" style="padding-right:5px;" ><?php echo rupiah($sale['ppn'])?></div></td>
						<td class="style24" > <div align="right" style="padding-right:5px;" ><?php echo rupiah($sale['pph'])?></div></td>
					  </tr>
					
                <?php $jml+=$sale['nominal']; 
                        $pph+=$sale['pph'];
                        $ppn+=$sale['ppn'];
                        endforeach;
                        
                ?>
  
  
  
  <tr>
    <td class="style24">&nbsp;</td>
	<td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
    <td class="style24">TOTAL</td>
    <td class="style24"> <div align="right" style="padding-right:5px;" >      <?=rupiah($jml)?>   </div>   </td>
    <td class="style24"> <div align="right" style="padding-right:5px;" >      <?=rupiah($ppn)?>   </div>   </td>
    <td class="style24"> <div align="right" style="padding-right:5px;" >     <?=rupiah($pph)?>   </div>   </td>
  </tr>
</table> 
<table width="754" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" class="style24"><p>Bukti-bukti pengeluaran anggaran dan asli setoran pajak (SSP/BPN) tersebut diatas disimpan oleh Pengguna Anggaran/Kuasa Pengguna Anggaran  <br />
      untuk kelengkapan aparat  pengawasan fungsional.administrasi dan pemeriksaan.<br />
    Demikian Surat Pernyataan ini dibuat dengan sebenarnya.</p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td width="29" class="style24">&nbsp;</td>
    <td width="171" class="style24">&nbsp;<br /> 
      <?php $pengajuan = find_by_id('pengajuan',$hasil['id_pengajuan']); 
        if($pengajuan['id_jenis_pengajuan'] == 6){ 
        $nodin = find_by_id('nodin',$pengajuan['id_nodin']);
        if($nodin['id_satker'] == 1 OR $nodin['id_satker'] == 2 OR $nodin['id_satker'] == 3 OR $nodin['id_satker'] == 4 OR $nodin['id_satker'] == 14){ print "Bendahara Pengeluaran";}else{print "Bendahara Pengeluaran Pembantu";}}else{}?> </td>
    <td width="295" class="style24">&nbsp;</td>
    <td width="259" class="style24">&nbsp;Jakarta,    
      <label>
     <?=date_format(date_create($d['tanggal']),'d-m-Y')?>
      </label>
      <br />
    <?=$satker[0]['jabatan_pimpinan']?></td>
  </tr>
  <tr>
    <td class="style24">&nbsp;</td>
    <td class="style24"><br />

<?php if($pengajuan['id_jenis_pengajuan'] == 6 ){ 
  //var_dump($satker); 
    require_once('phpqrcode/qrlib.php');
    $nama1 = "Disahkan Oleh :".$satker[0]['bpp']." NIP.".$satker[0]['nip_bpp'];
    $folder = "qrcode/";
    $qual = "H";
    $nm_file1= "qr".$satker[0]['nip_bpp'].".png";
    $ukuran = 2;
    $padding = 0;
  QRCODE :: png($nama1,$folder.$nm_file1,$qual,$ukuran,$padding); 
     $satker[0]['bpp']; ?><br />
    <img src="qrcode/<?=$nm_file1;?>" alt="">
<?php if($pengajuan['id_jenis_pengajuan'] == 6)  "NIP.".$satker[0]['nip_bpp'];  ?>
</td>
    <td class="style24">&nbsp;</td>
    <td class="style24"><br />
<?php
$nama = "Disahkan Oleh :".$satker[0]['ppk']." NIP.".$satker[0]['nip_ppk'];
$folder = "qrcode/";
$qual = "H";
$nm_file= "qr".$satker[0]['nip_ppk'].".png";
$ukuran = 2;
$padding = 0;
QRCODE :: png($nama,$folder.$nm_file,$qual,$ukuran,$padding); 
?>
<?php
  }else{ 
?>
    </td>
    <td class="style24">&nbsp;</td>
    <td class="style24"><br />

<?php  
    require_once('phpqrcode/qrlib.php');
    $nama = "Disahkan Oleh :".$satker[0]['ppk']." NIP.".$satker[0]['nip_ppk'];
    $folder = "qrcode/";
    $qual = "H";
    $nm_file= "qr".$satker[0]['nip_ppk'].".png";
    $ukuran = 2;
    $padding = 0;
  QRCODE :: png($nama,$folder.$nm_file,$qual,$ukuran,$padding); 
  }
?>
<img src="qrcode/<?=$nm_file;?>" alt=""> 
<?php $satker[0]['ppk']?><br />
 <?php "NIP.".$satker[0]['nip_ppk']?></td>
  </tr>
  <tr>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
  </tr>
  <tr>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
    <td class="style24">&nbsp;</td>
  </tr>
</table>
</form>
</div>

<script language="javascript">window.print();</script>
<?php } ?>