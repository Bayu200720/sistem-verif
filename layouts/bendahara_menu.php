<ul class="sidebar-nav">
  <li>
    <a href="home.php">
      <i class="glyphicon glyphicon-home"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Pengajuan</span>
       <?php 
              $user=find_by_id('users',$_SESSION['user_id']);
                   $pj= find_count_statusVerif_tahun_keuangan('status_sp2d',0,$user['tahun']); 
                    if($pj[0]['jml'] > 0){
                      echo '<span class="badge">'.$pj[0]['jml'].'</span>';
                      }
            ?>
      </a>
      <ul class="nav submenu">
         <li><a href="ben.php">Manage Pengajuan</a> </li>
     </ul>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Pencairan</span>
      </a>
      <ul class="nav submenu">
         <li><a href="pencairan.php">Manage Bendahara</a> </li>
     </ul>
     <ul class="nav submenu">
         <li><a href="pencairan_non_ben.php">Manage Non Ben</a> </li>
     </ul>
     <ul class="nav submenu">
         <li><a href="cetakP.php">Cetak Pencairan</a> </li>
     </ul>
  </li>
  <li>
    <a href="BKU.php" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>BKU</span>
      </a>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>BKU PUM</span>
      </a>
      <ul class="nav submenu">
         <li><a href="bpp_pencatatan.php">Pencatatan GU</a> </li>
         <li><a href="bpp_pencatatan_tup.php">Pencatatan TUP</a> </li>
         <!-- <li><a href="bpp_sptjb.php">SPTJB</a> </li> -->
     </ul>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Revolving</span>
      </a>
      <ul class="nav submenu">
         <li><a href="nodin_bpp.php">Manage Pengajuan</a> </li>
     </ul>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Pengajuan UP PUM</span>
      </a>
      <ul class="nav submenu">
         <li><a href="pengajuan_pum_ben.php">Manage Pengajuan</a> </li>
     </ul>
  </li> 
  <li>
    <a href="Pertanggungjawaban.php" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Dokuemn PJ</span>
      
            <?php 
              $user=find_by_id('users',$_SESSION['user_id']); 
              $pj= find_count_statusVerif_tahun('upload_pertanggungjawaban','',$user['id_satker'],$user['tahun']); 
                    if($pj[0]['jml'] > 0){
                      echo '<span class="badge">'.$pj[0]['jml'].'</span>';
                      }
            ?>
      </a> 
  </li>
</ul>
