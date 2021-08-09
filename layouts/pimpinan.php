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
      </a>
      <ul class="nav submenu">
         <li><a href="nodin_pimpinan.php">Manage Pengajuan</a> </li>
     </ul>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Pengajuan UP</span>
      </a>
      <ul class="nav submenu">
         <li><a href="nodin_pimpinan_pum.php">Manage Pengajuan UP</a> </li>
     </ul>
  </li>
  <?php if($_SESSION['user_id'] == 38){ ?>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Pengajuan LS PUM</span>
      </a>
      <ul class="nav submenu">
         <li><a href="nodin_pimpinan_ls.php">Manage Pengajuan LS</a> </li>
     </ul>
  </li>
  <?php } ?>
  <!-- <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>MAK</span>
      </a>
      <ul class="nav submenu">
         <li><a href="mak.php">Manage MAK</a> </li>
     </ul>
  </li>

  <li>
    <a href="setting.php" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Setting</span>
      </a> 
  </li>
  <li>
    <a href="bku_bpp.php" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>BKU</span>
      </a> 
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
  </li> -->
</ul>
