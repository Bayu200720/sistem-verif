<?php
  $page_title = 'All Pengajuan';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(6);

   $nodin = find_all_global('nodin',$_GET['id'],'id');//var_dump($nodin[0]['id_satker']);exit();
   $satker = find_all_global('satker',$nodin[0]['id_satker'],'id');//echo $nodin[0]['id_satker'];var_dump($satker);exit();
   $pengajuan = find_all_global('pengajuan',$_GET['v'],'id');
   $verifikasi = find_all_global('verifikasi',$pengajuan[0]['id'],'id_pengajuan');
   $detail_pengajuan = find_all_global('detail_pengajuan',$pengajuan[0]['id'],'id_pengajuan');//var_dump($detail_pengajuan);exit();
 
?>
<style type="text/css">

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

</style>

<div class="halman" align=center> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td colspan="3"><div align="center" class="style28">VERIFIKASI PERTANGGUNGJAWABAN UP</div></td>
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
        <td><span class="style28">&nbsp;<?=$satker[0]['keterangan'];?>
         
        </span></td>
      </tr>
      <tr>
        <td><span class="style28">Pejabat Pembuat Komitmen </span></td>
        <td><span class="style28">:</span></td>
        <td><span class="style28">&nbsp;<?=$satker[0]['ppk'];?>
          
        </span></td>
      </tr>
      <tr>
        <td><span class="style28">Nomor Nota Dinas </span></td>
        <td><span class="style28">:</span></td>
        <td><span class="style28"><?=$nodin[0]['no_nodin'];?></span></td>
      </tr>
      <tr>
        <td><span class="style28">Tanggal Nota Dinas</span></td>
        <td><span class="style28">:</span></td>
        <td><span class="style28"><?=date('d-m-yy')?></span></td>
      </tr>
    </table>
      <br />
</td>
    </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td width="6%"><div align="center" class="style28">No</div></td>
        <td width="45%"><div align="center" class="style28">KELENGKAPAN DOKUMEN PENGAJUAN</div></td>
        <td width="10%"><div align="center" class="style28">Nilai SPTB</div></td>
        <td width="7%"><div align="center" class="style28">Ceklist</div></td>
        <td width="32%"><div align="center" class="style28">KETERANGAN KEKURANGAN DOKUMEN</div></td>
      </tr>

    <?php  $no=0; $jum=0; foreach ($detail_pengajuan as $sp): //var_dump($sp);?>
      <tr>
        <td><center><span class="style28">&nbsp;
          <?=$no+=1?>
        </span></center></td>
        <td><span class="style28">&nbsp;
          <?=$sp['no_sptjb']?>
          -
          <?php $akun=find_by_id('akun',$sp['id_akun']); echo $akun['mak'];?>
        </span></td>
        <td style="padding-right:10px;" align="right"><span class="style28">&nbsp;
        <?=rupiah($sp['nominal']);?>
        </span></td>
        <td><span class="style28"></span></td>
        <td><span class="style28"><?=$sp['keterangan_verifikasi']?></span></td>
      </tr>
      <?php $jum+=$sp['nominal']; endforeach;?>
	<tr>
        <td><span class="style28"></span></td>
        <td><span class="style28"></span></td>
        <td style="padding-right:10px;" align="right"><span class="style28"><strong>
          <?=rupiah($jum);?>
        </strong></span></td>
        <td><span class="style28"></span></td>
        <td><span class="style28"></span></td>
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
      </table>      <p><br />
    
	    </p>
      <table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="33%" valign="top"><p align="center" class="style28">Penyerah Dokumen <br />
      Tgl
      <br />
      PPK/BPP/ WBPP / PUM</p>
      <p align="center" class="style28"><br />
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
      </p>
      <p align="center" class="style28">(____________________)</p>      </td>
    <td width="34%" valign="top"><p align="center" class="style28">Telah Diverifikasi,<br />
      Tgl:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Pukul :<br />
    Verifikator Keuangan</p>
      <p align="center" class="style28"><br />
      <?php if($verifikasi[0]['status_pengajuan']==1){?>
        <?php $user= find_by_id('users',$pengajuan[0]['status_verifikasi']);?>
        <img width="100px" height="100px" src="uploads/users/<?=$user['ttd']?>.png" alt="">
      <?php } ?>
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
  </tr>
</table>

</div>

<script language="javascript">window.print();</script>
