<?php $user = current_user(); ?>
<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title><?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Sistem Informasi Verifikasi";?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
    <!-- Datatable -->
    <link rel="stylesheet" href="libs/css/dataTable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="libs/css/dataTable/responsive.bootstrap4.min.css">
    <!-- <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css" rel="stylesheet"> -->
      
        <style>
    body {
      /* background: url('uploads/users/undraw_Scrum_board_re_wk7v.png'); */
       background-color:powderblue;
        
		background-size:cover;
        background-attachment: fixed;
        background-repeat: no-repeat;
		background-position: top right;      
    }
        </style>
    
  </head>
  <body>
  <?php  if ($session->isUserLoggedIn(true)): ?>
    <header id="header">
      <div class="logo pull-left"> SI MONITORING PENGAJUAN </div>
      <div class="header-content">
      <div class="header-date pull-left">
        <strong><?php date_default_timezone_set('Asia/Jakarta'); echo tanggal_indo(date("Y-m-d"),true);?></strong>
      </div>
      <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
              <img src="uploads/users/kominfo.jpg" alt="user-image" class="img-circle img-inline">
              <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                  <a href="profile.php?id=<?php echo (int)$user['id'];?>">
                      <i class="glyphicon glyphicon-user"></i>
                      Profile
                  </a>
              </li>
             <li>
                 <a href="edit_account.php" title="edit account">
                     <i class="glyphicon glyphicon-cog"></i>
                     Settings
                 </a>
             </li>
             <li class="last">
                 <a href="logout.php">
                     <i class="glyphicon glyphicon-off"></i>
                     Logout
                 </a>
             </li>
           </ul>
          </li>
        </ul>
      </div>
     </div>
    </header>
    <div id="sidebar-wrapper" class="sidebar">
      <!-- main navigation for sidebar -->
      <ul>
        <li>
          <a href="javascript:" id="menu-toggle">
            <i id="hide-sidebar" class="glyphicon glyphicon-chevron-left"></i>
            <i id="show-sidebar" class="glyphicon glyphicon-chevron-right"></i>
            <span>Menu</span>
            </a>
        </li>
      </ul>
      <?php if($user['user_level'] === '1'): ?>
        <!-- admin menu -->
        <?php include_once('admin_menu.php');?>

      <?php elseif($user['user_level'] === '2' or $user['user_level']== '7'): ?>
        <!-- Special user -->
        <?php include_once('special_menu.php');?>

      <?php elseif($user['user_level'] === '3'): ?>
        <!-- User menu -->
        <?php include_once('spm_menu.php');?>
      <?php elseif($user['user_level'] === '4'): ?>
         <?php include_once('kppn_menu.php');?>

      <?php elseif($user['user_level'] === '5'): ?>
         <?php include_once('bendahara_menu.php');?>
      <?php elseif($user['user_level'] === '6'): ?>
         <?php include_once('bpp_menu.php');?>
      <?php elseif($user['user_level'] === '8'): ?>
         <?php include_once('pimpinan.php');?>
      <?php endif;?>

   </div>
<?php endif;?>

<div id="app-page" class="page">
  <div class="container-fluid">
