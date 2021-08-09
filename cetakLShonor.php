<?php
extract($_GET);
extract($_POST);
global $varQ,$idppk;


	  $q = mysql_query("select * from `setting` where `id`='$idppk'");

	  $d = mysql_fetch_array($q);

	  $setTahun = $d['tahun'];

	  $setNoMulai = $d['no_mulai'];

	  $setNoPrefik = $d['prefik_nomor'];
	  $setppk_nip = $d['ppk_nip'];
	   $setppk = $d['ppk'];
	   
	   $setBendahara_nip= $d['bendahara_nip'];
	    $setBendahara= $d['bendahara'];
	  $setingan = $d ;
	 
	 
	  
function JumlahSPTJB($data,$jenis,$numerik){
$total = 0 ;
$ppn = 0;
$pph = 0;
	if($data['jenis']=="sppd"){
		$qSppd = mysql_query("select * from `rincian` where `id_sptjb` = '".$data['id']."' ");
		for($i=1;$i<=mysql_num_rows($qSppd);$i++){
			$dSppd = mysql_fetch_array($qSppd);
			$total += $dSppd['total'] ; 
			$ppn += $dSppd['ppn'] ; 
			$pph += $dSppd['pph'] ;
			
		}
	}else if($data['jenis']=="kwitansi") {
		$qSppd = mysql_query("select * from `kegiatan_rincian` where `id_sptjb` = '".$data['id']."' ");
		for($i=1;$i<=mysql_num_rows($qSppd);$i++){
			$dSppd = mysql_fetch_array($qSppd);
			$total += $dSppd['jumlah'] ; 
			$ppn += $dSppd['ppn'] ; 
			$pph += $dSppd['pph'] ;
			
		}
	}else{
		$qSppd = mysql_query("select * from `honor_rincian` where `id_sptjb` = '".$data['id']."' ");
		for($i=1;$i<=mysql_num_rows($qSppd);$i++){
			$dSppd = mysql_fetch_array($qSppd);
			$total += $dSppd['jumlah'] ; 
			$ppn += $dSppd['ppn'] ; 
			$pph += $dSppd['pph'] ;
			
		}
	}
	if($numerik) return $$jenis ;
	else return number_format($$jenis,0,',','.');
}

	  
$q = mysql_query("select * from `mak` where `tahun`='$setTahun'");
for($i=1;$i<=mysql_num_rows($q);$i++){
	$d = mysql_fetch_array($q);
	$dMak[$d['kode']]=$d['keterangan'];
}

$q = mysql_query("select * from `pegawai`");
for($i=1;$i<=mysql_num_rows($q);$i++){
	$d = mysql_fetch_array($q);
	$dUser[$d['id']]=$d;
}
	  

$sppJumlah = 0;

$q = mysql_query("select * from `sptjb` where `spp`='".$varQ[5]."' order by `id` ");
$d = mysql_fetch_array($q);
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
.style28 {font-size: 12px}
-->
</style>

<div class="halman" align=center> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%"><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td colspan="3"><div align="center" class="style28">VERIFIKASI PENGAJUAN HONOR/JASA PROFESI</div></td>
        </tr>
      <tr>
        <td colspan="3"><div align="center" class="style28">BADAN PENELITIAN DAN PENGEMBANGAN SDM</div>
          <span class="style28"><br />
          <br />
          </span></td>
        </tr>
      <tr>
        <td width="18%"><span class="style28"></span></td>
        <td width="2%"><span class="style28"></span></td>
        <td width="80%"><span class="style28"></span></td>
      </tr>
      <tr>
        <td><span class="style28">Satuan Kerja </span></td>
        <td><span class="style28">:</span></td>
        <td><span class="style28">&nbsp;
           <?=$setingan['satker']?>,<?=$setingan['instansi']?>
        </span></td>
      </tr>
      <tr>
        <td><span class="style28">Pejabat Pembuat Komitmen </span></td>
        <td><span class="style28">:</span></td>
        <td><span class="style28">&nbsp;
          <?=$setingan['ppk']?>
        </span></td>
      </tr>
      <tr>
        <td><span class="style28">Nomor Nota Dinas </span></td>
        <td><span class="style28">:</span></td>
        <td><span class="style28"></span></td>
      </tr>
      <tr>
        <td><span class="style28">Tanggal Nota Dinas</span></td>
        <td><span class="style28">:</span></td>
        <td><span class="style28"></span></td>
      </tr>
      <tr>
        <td><span class="style28">Jenis Pengajuan</span></td>
        <td>:</td>
        <td><span class="style28"><?=$d['nomor']?>
/
<?=$d['lsgu']?>
-
<?=$d['mak']?>
</span></td>
      </tr>
      <tr>
        <td><span class="style28">Nilai Pengajuan</span></td>
        <td>:</td>
        <td><span style="padding-right:10px;"><span class="style28">
          <?=JumlahSPTJB($d,'total')?>
        </span></span></td>
      </tr>
    </table>
      <br /></td>
    <td width="50%"><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td colspan="3"><div align="center" class="style28">VERIFIKASI PERTANGGUNGJAWABAN HONOR/JASA PROFESI</div></td>
      </tr>
      <tr>
        <td colspan="3"><div align="center" class="style28">BADAN PENELITIAN DAN PENGEMBANGAN SDM</div>
            <span class="style28"><br />
            <br />
          </span></td>
      </tr>
      <tr>
        <td width="18%">&nbsp;</td>
        <td width="2%">&nbsp;</td>
        <td width="80%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="8%"><div align="center" class="style28">No</div></td>
        <td width="51%"><div align="center" class="style28">KELENGKAPAN DOKUMEN PENGAJUAN</div></td>
        <td width="13%"><div align="center" class="style28">Ceklist</div></td>
        <td width="28%"><div align="center" class="style28">KETERANGAN  </div></td>
      </tr>
	  <?
	
	  	$d = mysql_fetch_array($q);
	  ?>
      <tr>
        <td class="style28"><div align="center"><span class="style28">&nbsp;
          1 </span></div></td>
        <td class="style28"><span class="style28">&nbsp;Ketersediaan Dana pada RKA-KL</span></td>
        <td><span class="style28"></span></td>
        <td><span class="style28"></span></td>
      </tr>
	  <? 
	  
	$sppJumlah += JumlahSPTJB($d,'total',true) ;
	
 ?>
	<tr>
        <td class="style28"><div align="center"><span class="style28">2</span></div></td>
        <td class="style28"><span class="style28">Kesesuaian Kode Anggaran</span></td>
        <td><span class="style28"></span></td>
        <td><span class="style28"></span></td>
      </tr>
	<tr>
	  <td class="style28"><div align="center">3</div></td>
	  <td class="style28"> Nota Dinas pengajuan</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td class="style28"><div align="center">4</div></td>
	  <td class="style28"> SPP aplikasi</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td class="style28"><div align="center">5</div></td>
	  <td class="style28"> SPTB</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td class="style28"><div align="center">6</div></td>
	  <td class="style28"> Daftar Nominatif</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td class="style28"><div align="center">7</div></td>
	  <td class="style28"> SK </td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td class="style28"><div align="center">8</div></td>
	  <td class="style28">SSP</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	  
  
    </table>
      <br>
      <table width="379" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td width="111" rowspan="2">Status dokumen </td>
          <td width="88">Terima</td>
          <td width="172">&nbsp;</td>
        </tr>
        <tr>
          <td>Tolak</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="33%" valign="top"><p align="center" class="style28">Penyerah Dokumen <br />
      Tgl
      <br />
      PPK/BPP/ WBPP / PUM</p>
      <p align="center" class="style28"><br />
        <br />
      </p>
      <p align="center" class="style28">(____________________)</p>      </td>
    <td width="33%" valign="top"><p align="center" class="style28">Mengetahui,<br />
      Tgl<br />
      Kasubag Verifikasi</p>
      <p align="center" class="style28"><br />
        <br />
      </p>
      <p align="center" class="style28">(____________________)</p>      </td>
    <td width="34%" valign="top"><p align="center" class="style28">Telah Diverifikasi,<br />
      Tgl:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Pukul :<br />
    Verifikator Keuangan</p>
      <p align="center" class="style28"><br />
        <br />
      </p>
      <p align="center" class="style28">(___________________)</p>      </td>
  </tr>
</table>
<br />

	<table border="1" cellpadding="0" cellspacing="0">
      <col width="94" />
      <col width="27" span="2" />
      <col width="19" />
      <tr height="16">
        <td height="16" width="94">Ver</td>
        <td width="27">SPM</td>
        <td width="27">SAS</td>
        <td width="19">Arsip</td>
      </tr>
      <tr height="16">
        <td height="16">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="8%"><div align="center" class="style28">No</div></td>
        <td width="51%"><div align="center" class="style28">KELENGKAPAN DOKUMEN PERTANGGUNGJAWABAN</div></td>
        <td width="13%"><div align="center" class="style28">Ceklist</div></td>
        <td width="28%"><div align="center" class="style28">KETERANGAN </div></td>
      </tr>
      <?
	
	  	$d = mysql_fetch_array($q);
	  ?>
      <tr>
        <td class="style28"><div align="center">&nbsp;
          1 </div></td>
        <td class="style28">Kuitansi Penerima honor atau jasprof</td>
        <td><span class="style28"></span></td>
        <td><span class="style28"></span></td>
      </tr>
      <? 
	  
	$sppJumlah += JumlahSPTJB($d,'total',true) ;
	
 ?>
    </table>
      <p><br />
        </p>
      <p><br />
      </p>
      <p><br>
        <br>
</p>
      <table width="100%" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="33%" valign="top"><p align="center" class="style28">Penyerah Dokumen <br />
            Tgl <br />
            PPK/BPP/ WBPP / PUM</p>
              <p align="center" class="style28"><br />
                <br />
              </p>
            <p align="center" class="style28">(____________________)</p></td>
          <td width="33%" valign="top"><p align="center" class="style28">Mengetahui,<br />
            Tgl<br />
            Kasubag Verifikasi</p>
              <p align="center" class="style28"><br />
                <br />
              </p>
            <p align="center" class="style28">(____________________)</p></td>
          <td width="34%" valign="top"><p align="center" class="style28">Telah Diverifikasi,<br />
            Tgl:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Pukul :<br />
            Verifikator Keuangan</p>
              <p align="center" class="style28"><br />
                <br />
              </p>
            <p align="center" class="style28">(___________________)</p></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>

</div>

<script language="javascript">//window.print();</script>
