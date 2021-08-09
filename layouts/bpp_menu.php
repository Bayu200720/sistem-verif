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
         <li><a href="nodin_bpp.php">Manage Pengajuan</a> </li>
     </ul>
  </li>
  <li>
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
  <?php
  $user = find_by_id('users',$_SESSION['user_id']); 
    if($user['id_satker'] == 1 ||$user['id_satker'] == 2 || $user['id_satker'] == 3 || $user['id_satker'] == 4 ||$user['id_satker'] == 14){

  ?>
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
       <span>Pengajuan UP</span>
      </a>
      <ul class="nav submenu">
         <li><a href="pengajuan_UP.php">Pengajuan UP</a> </li>
     </ul>
  </li>
  <?php 
    }else{
  ?>
  <li>
    <a href="bku_bpp.php" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>BKU</span>
      </a> 
  </li>
  <?php } ?>
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
