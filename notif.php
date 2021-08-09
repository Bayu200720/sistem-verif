<html>
<head>
<style>
div.background {
    background: url(uploads/users/undraw_Notify_re_65on.png) no-repeat;
    background-position : top right;
    border: 2px solid black;
  	max-width: 100%;
    height: auto;

}

  

div.transbox {
    margin: 30px;
     margin-button: 30px;
    background-color: #ffffff;
    border: 1px solid black;
    opacity: 0.6;
    filter: alpha(opacity=60); /* For IE8 and earlier */
}

div.transbox p {
    margin: 5%;
    font-weight: bold;
    color: #000000;
}
</style>
</head>
<body>
  <?php   require_once('includes/load.php');
  		$user= find_by_id('users',$_SESSION['user_id']);
  ?>

<div class="background">
  <div class="transbox">
    <p></p>
  <div class="container">
      <div class="row-mt-4">
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <img src="uploads/users/undraw_accept_terms_4in8.png" alt="...">
            <div class="caption">
              <h3>SPM yang Belom di Verifikasi</h3>
              <?php $result = find_status_custome_count($user['tahun'],'status_verifikasi'); ?>
              <h1><?php echo $result[0]['status'];?> SPM </h1>
              <p><a href="pengajuan_verif.php" class="btn btn-primary" role="button">Verifikasi</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    	 <p></p>

  </div>
</div>

</body>
</html>