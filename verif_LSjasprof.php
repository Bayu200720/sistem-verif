<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);
    //echo $_GET['id'];exit();
   $nodin = find_all_global('nodin',$_GET['id'],'id');//var_dump($nodin);exit();
   $satker = find_all_global('satker',$nodin[0]['id_satker'],'id');//var_dump($nodin);exit();
   $pengajuan = find_all_global('pengajuan',$_GET['v'],'id');//var_dump($pengajuan);exit();
   $verifikasi = find_all_global('verifikasi',$pengajuan[0]['id'],'id_pengajuan');//var_dump($verifikasi);exit();
 //var_dump($verifikasi);

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
    <td width="50%"><table width="96%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td colspan="3"><div align="center" class="style28">VERIFIKASI PENGAJUAN PERJALANAN DINAS</div></td>
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
         <?=$satker[0]['keterangan'];?>
        </span></td>
      </tr>
      <tr>
        <td><span class="style28">Pejabat Pembuat Komitmen </span></td>
        <td><span class="style28">:</span></td>
        <td><span class="style28">&nbsp;
            <?=$satker[0]['ppk']?>
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
        <td><?=$nodin[0]['tanggal'];?></td>
      </tr>
      <tr>
        <td><span class="style28">Jenis Pengajuan</span></td>
        <td>:</td>
        <td><?php $jenis=find_all_global('jenis',$nodin[0]['id_jenis'],'id'); echo $jenis[0]['keterangan']?><span class="style28">

</span></td>
      </tr>
      <tr>
        <td><span class="style28">Nilai Pengajuan</span></td>
        <td>:</td>
        <td><?php $nominal = nominalSPM($pengajuan[0]['id']);echo rupiah($nominal[0]['nom']);  ?><span style="padding-right:10px;"><span class="style28">
        <span style="padding-right:10px;"><span style="padding-right:10px;"><span style="padding-right:10px;">
        <span style="padding-right:10px;"><span style="padding-right:10px;"><span style="padding-right:10px;"><span style="padding-right:10px;">
        </span></span></span></span> </span></span> </span> </span></span></td>
      </tr>
    </table>
      <br /></td>
    <td width="50%"><table width="95%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td colspan="3"><div align="center" class="style28">VERIFIKASI PERTANGGUNGJAWABAN PERJALANAN DINAS</div></td>
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
    <td valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="8%"><div align="center" class="style28">No</div></td>
        <td width="51%"><div align="center" class="style28">KELENGKAPAN DOKUMEN PENGAJUAN</div></td>
        <td width="13%"><div align="center" class="style28">Ceklist</div></td>
        <td width="28%"><div align="center" class="style28">KETERANGAN  </div></td>
      </tr>

      <tr>
        <td class="style28"><div align="center"><span class="style28">&nbsp;
          1 </span></div></td>
        <td class="style28"><span class="style28">&nbsp;Ketersediaan Dana pada RKA-KL</span></td>
        <td><center><span class="style28"><?php if($verifikasi[0]['rkakl']==1){echo "V";}?></span></center></td>
        <td><center><span class="style28"><?php if($verifikasi[0]['rkakl']==1){echo "Lengkap";}?></span></center></td>
      </tr>

	<tr>
        <td class="style28"><div align="center"><span class="style28">2</span></div></td>
        <td class="style28"><span class="style28">Kesesuaian Kode Anggaran</span></td>
        <td><center><span class="style28"><?php if($verifikasi[0]['kode_anggaran']==1){echo "V";}?></span></center></td>
        <td><center><span class="style28"><?php if($verifikasi[0]['kode_anggaran']==1){echo "Lengkap";}?></span></center></td>
      </tr>
	<tr>
	  <td class="style28"><div align="center">3</div></td>
	  <td class="style28"> Nota Dinas pengajuan</td>
    <td><center><span class="style28"><?php if($verifikasi[0]['nd_pengajuan']==1){echo "V";}?></span></center></td>
    <td><center><span class="style28"><?php if($verifikasi[0]['nd_pengajuan']==1){echo "Lengkap";}?></span></center></td>
	  </tr>
	<tr>
	  <td class="style28"><div align="center">4</div></td>
	  <td class="style28"> SPP aplikasi</td>
	  <td><center><span class="style28"><?php if($verifikasi[0]['spp']==1){echo "V";}?></span></center></td>
    <td><center><span class="style28"><?php if($verifikasi[0]['spp']==1){echo "Lengkap";}?></span></center></td>
	  </tr>
	<tr>
	  <td class="style28"><div align="center">5</div></td>
	  <td class="style28"> SPTB</td>
	  <td><center><span class="style28"><?php if($verifikasi[0]['sptb']==1){echo "V";}?></span></center></td>
    <td><center><span class="style28"><?php if($verifikasi[0]['sptb']==1){echo "Lengkap";}?></span></center></td>
	  </tr>
	<tr>
	  <td class="style28"><div align="center">6</div></td>
	  <td class="style28"> Daftar Nominatif</td>
	  <td><center><span class="style28"><?php if($verifikasi[0]['daftar_nominatif']==1){echo "V";}?></span></center></td>
    <td><center><span class="style28"><?php if($verifikasi[0]['daftar_nominatif']==1){echo "Lengkap";}?></span></center></td>
	  </tr>
	<tr>
	  <td class="style28"><div align="center">7</div></td>
	  <td class="style28"> SK</td>
	  <td><center><span class="style28"><?php if($verifikasi[0]['sk']==1){echo "V";}?></span></center></td>
    <td><center><span class="style28"><?php if($verifikasi[0]['sk']==1){echo "Lengkap";}?></span></center></td>
	  </tr>
	<tr>
	  <td class="style28"><div align="center">8</div></td>
	  <td class="style28">SSP</td>
	  <td><center><span class="style28"><?php if($verifikasi[0]['ssp']==1){echo "V";}?></span></center></td>
    <td><center><span class="style28"><?php if($verifikasi[0]['ssp']==1){echo "Lengkap";}?></span></center></td>
	  </tr>
	  
  
    </table>
<br>

      <table width="379" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td width="111" rowspan="2">Status dokumen </td>
          <td width="88">Terima</td>
          <td width="172"><center><?php if($verifikasi[0]['status_pengajuan']==1){echo "V";}?></center></td>
        </tr>
        <tr>
          <td>Tolak</td>
          <td>&nbsp;<center><?php if($verifikasi[0]['status_pengajuan']==0){echo "V";}?></center></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="33%" valign="top"><p align="center" class="style28">Penyerah Dokumen <br />
      Tgl
      <br />
      PPK/BPP/ WBPP / PUM</p>
      <p align="center" class="style28"><br />
        <br />
        <img width="100px" height="100px" src="uploads/users/<?php echo $satker[0]['ttd'];?>.png" alt="">
      </p>
      <p align="center" class="style28">(____________________)</p>      </td>
    <td width="33%" valign="top"><p align="center" class="style28">Mengetahui,<br />
      Tgl<br />
      Kasubag Verifikasi</p>
      <p align="center" class="style28"><br />
      <?php if($pengajuan[0]['verifikasi_kasubbag_v']==1){?>  
           <img width="100px" height="100px" src="uploads/users/hendri.png" alt="">
      <?php } ?>
        <br />
      </p>
      <p align="center" class="style28">(____________________)</p>      </td>
    <td width="34%" valign="top"><p align="center" class="style28">Telah Diverifikasi,<br />
      Tgl:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Pukul :<br />
    Verifikator Keuangan</p>
      <p align="center" class="style28"><br />
        <br />
        <?php if($verifikasi[0]['status_pengajuan']==1){?>
        <?php $user= find_by_id('users',$pengajuan[0]['status_verifikasi']);?>
        <img width="100px" height="100px" src="uploads/users/<?=$user['ttd']?>.png" alt="">
      <?php } ?>
        <br>
        (___________________)</p>
      </td>
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

      <tr>
        <td class="style28"><div align="center">&nbsp;
          1 </div></td>
        <td class="style28">SP2D</td>
        <td><center><span class="style28"><?php if($verifikasi[0]['sp2d']==1){echo "V";}?></span></center></td>
        <td><center><span class="style28"><?php if($verifikasi[0]['sp2d']==1){echo "Lengkap";}?></span></center></td>
      </tr>

      <tr>
        <td class="style28"><div align="center">2</div></td>
        <td class="style28"> Tanda Terima Penerima Honor </td>
        <td><center><span class="style28"><?php if($verifikasi[0]['tanda_terima_honor']==1){echo "V";}?></span></center></td>
        <td><center><span class="style28"><?php if($verifikasi[0]['tanda_terima_honor']==1){echo "Lengkap";}?></span></center></td>
      </tr>
      <tr>
        <td class="style28"><div align="center">3</div></td>
        <td class="style28">SK Honor  disesuaikan dengan narsum hadir bagi jasa profesi</td>
        <td><center><span class="style28"><?php if($verifikasi[0]['sk_honor']==1){echo "V";}?></span></center></td>
         <td><center><span class="style28"><?php if($verifikasi[0]['sk_honor']==1){echo "Lengkap";}?></span></center></td>
      </tr>
      <tr>
        <td class="style28"><div align="center">4</div></td>
        <td class="style28">SKTJM KPA</td>
        <td><center><span class="style28"><?php if($verifikasi[0]['sktjm_kpa']==1){echo "V";}?></span></center></td>
         <td><center><span class="style28"><?php if($verifikasi[0]['sktjm_kpa']==1){echo "Lengkap";}?></span></center></td>
      </tr>
      <tr>
        <td class="style28"><div align="center">5</div></td>
        <td class="style28">Jadwal Kegiatan/Acara</td>
        <td><center><span class="style28"><?php if($verifikasi[0]['jadwal_kegiatan']==1){echo "V";}?></span></center></td>
         <td><center><span class="style28"><?php if($verifikasi[0]['jadwal_kegiatan']==1){echo "Lengkap";}?></span></center></td>
      </tr>
      <tr>
        <td class="style28"><div align="center">6</div></td>
        <td class="style28">Absensi Narsum dan Peserta</td>
        <td><center><span class="style28"><?php if($verifikasi[0]['absensi']==1){echo "V";}?></span></center></td>
         <td><center><span class="style28"><?php if($verifikasi[0]['absensi']==1){echo "Lengkap";}?></span></center></td>
      </tr>
      <tr>
        <td class="style28"><div align="center">7</div></td>
        <td class="style28">Materi untuk Paparan Narsum</td>
        <td><center><span class="style28"><?php if($verifikasi[0]['materi_narsum']==1){echo "V";}?></span></center></td>
         <td><center><span class="style28"><?php if($verifikasi[0]['materi_narsum']==1){echo "Lengkap";}?></span></center></td>
      </tr>
      <tr>
        <td class="style28"><div align="center"></div></td>
        <td class="style28"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="style28"><div align="center"></div></td>
        <td class="style28"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="style28"><div align="center"></div></td>
        <td class="style28"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="style28"><div align="center"></div></td>
        <td class="style28"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
     
      

    </table>
      <br />
      <br />
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
</table>

</div>

<script language="javascript">window.print();</script>
