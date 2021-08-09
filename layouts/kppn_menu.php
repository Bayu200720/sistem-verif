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
                   $pj= find_count_statusVerif_tahun_keuangan('status_kppn',0,$user['tahun']); 
                    if($pj[0]['jml'] > 0){
                      echo '<span class="badge">'.$pj[0]['jml'].'</span>';
                      }
            ?>
      </a>
      <ul class="nav submenu">
         <li><a href="kppn.php">Manage Pengajuan</a> </li>
        
     </ul>
  </li>
</ul>
