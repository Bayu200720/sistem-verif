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
              if($user['user_level']==2){ 
                   $pj= find_count_statusVerif_tahun_keuangan('status_verifikasi',0,$user['tahun']); 
              }else if($user['user_level']==7){
                   $pj= find_count_statusVerif_tahun_keuangan('verifikasi_kasubbag_v','',$user['tahun']);
              }
                    if($pj[0]['jml'] > 0){
                      echo '<span class="badge">'.$pj[0]['jml'].'</span>';
                      }
            ?>

      </a>
      <ul class="nav submenu">
         <li><a href="pengajuan_verif.php">Manage Pengajuan</a> </li>
     </ul>
  </li>
  <li>
    <a href="edit_account.php" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Setting</span>
      </a>
      
  </li>
  <li>
    <a href="pj_bpp.php" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-list"></i>
       <span>Dokumen PJ</span>
      </a>
      
  </li>
</ul>
