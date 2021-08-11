<?php
  require_once(__DIR__.'/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." ORDER BY id DESC");
   }
}

//find pengajuan yg status pengajuan 1
function find_pengajuanok()
{
  global $db;
  return find_by_sql("SELECT p.id as id,p.SPM as SPM,p.status_verifikasi as status_verifikasi,p.status_kppn as status_kppn,p.status_spm as status_spm,p.status_sp2d as status_sp2d,p.upload as upload,p.id_nodin as id_nodin, p.sp2d as sp2d,p.created_at as created_at,p.verifikasi_kasubbag_v as verifikasi_kasubbag_v,p.id_jenis_pengajuan as id_jenis_pengajuan,p.penolakan_kppn as penolakan_kppn,p.file_spm as file_spm,p.file_sp2d as file_sp2d,p.upload_adk as upload_adk,p.upload_pertanggungjawaban as upload_pertanggungjawaban, p.status_pengambilan_uang as status_pengambilan_uang  FROM `pengajuan` p,nodin n WHERE p.id_nodin = n.id and n.status_pengajuan=1 ORDER BY p.id DESC");
    
   
}

function find_nodin_j_pengajuan($tahun,$id_satker)
{
  global $db;
  return find_by_sql("SELECT p.status_pj as status_pj,p.upload_pertanggungjawaban as upload_pertanggungjawaban,p.upload_kekurangan as upload_kekurangan,p.SPM as SPM,p.id as id,p.id_jenis_pengajuan as id_jenis_pengajuan,n.id_satker as id_satker FROM `pengajuan` p,nodin n WHERE p.id_nodin = n.id and n.status_pengajuan=1 and n.tahun='{$tahun}' and id_satker='{$id_satker}' ORDER BY p.id DESC");
   
}
function find_nodin_j_pengajuan_kv($tahun)
{
  global $db;
  return find_by_sql("SELECT p.status_pj as status_pj,p.upload_pertanggungjawaban as upload_pertanggungjawaban,p.upload_kekurangan as upload_kekurangan,p.SPM as SPM,p.id as id,p.id_jenis_pengajuan as id_jenis_pengajuan,n.id_satker as id_satker FROM `pengajuan` p,nodin n WHERE p.id_nodin = n.id and n.status_pengajuan=1 and n.tahun='{$tahun}' ORDER BY p.id DESC");
   
}

function find_nodin_j_pengajuan_spm($spm)
{
  global $db;
  return find_by_sql("SELECT p.upload, p.file_spm, p.file_sp2d, p.upload_kekurangan, p.upload_pertanggungjawaban,p.upload_adk,p.upload_adk_spm FROM `pengajuan` p,nodin n WHERE p.id_nodin = n.id and n.status_pengajuan=1 and p.SPM='{$spm}' ORDER BY p.id DESC");
   
}

function find_allSPM_satker($id_satker,$tahun)
{
  global $db;
  return find_by_sql("SELECT * FROM `nodin`n,pengajuan p,detail_pengajuan dp WHERE p.id_nodin = n.id and n.id_satker ='{$id_satker}' and dp.id_pengajuan=p.id and n.tahun='{$tahun}' ORDER BY n.id DESC");
   
}

function find_count_statusVerif_tahun($status,$isi,$id_satker,$tahun)
{
  global $db;
  return find_by_sql("SELECT count(*) as jml from nodin n,pengajuan p where n.id = p.id_nodin and p.{$status} = '{$isi}' and n.id_satker ='{$id_satker}' and n.tahun='{$tahun}'");
   
}
function find_count_statusVerif_tahun_keuangan($status,$isi,$tahun)
{
  global $db;
  return find_by_sql("SELECT count(*) as jml from nodin n,pengajuan p where n.id = p.id_nodin and p.{$status} = '{$isi}' and n.tahun='{$tahun}'");
   
}

function find_nodin_j_pengajuan_count($tahun,$id_satker)
{
  global $db;
  return find_by_sql("SELECT count(*) as status FROM `pengajuan` p,nodin n WHERE p.id_nodin = n.id and n.status_pengajuan=1 and n.tahun='{$tahun}' and id_satker='{$id_satker}' and status_pj < 0 ORDER BY p.id DESC");
   
}

function find_status_custome_count($tahun,$key)
{
  global $db;
  return find_by_sql("SELECT count(*) as status FROM `pengajuan` p,nodin n WHERE p.id_nodin = n.id and n.status_pengajuan=1 and n.tahun='{$tahun}' and p.{$key} = 0 ");   
}


function find_nodin_j_pengajuan_j_dt_count($tahun,$id_satker,$id_nodin)
{
  global $db;
  return find_by_sql("SELECT count(*) as status FROM `pengajuan` p,nodin n,detail_pengajuan dp WHERE p.id_nodin = n.id and p.id = dp.id_pengajuan and n.tahun='{$tahun}' and n.id_satker='{$id_satker}' and n.id = '{$id_nodin}'  ORDER BY p.id DESC");
   
}
function find_nodin_j_pengajuan_pum_j_dt_count($tahun,$id_satker,$id_nodin)
{
  global $db;
  return find_by_sql("SELECT count(*) as status FROM `pengajuan_pum` p,detail_pengajuan_pum dp WHERE p.id = dp.id_pengajuan_pum and p.tahun='{$tahun}' and p.id_satker='{$id_satker}' and p.id = '{$id_nodin}'  ORDER BY p.id DESC");
   
}
function find_cair_j_kcair($spm)
{
  global $db;
  return find_by_sql("SELECT * FROM `pencairan` p,k_cair k WHERE p.status = k.id and p.spm='{$spm}'");
   
}

function update_status_jp($hari,$spm)
{
  global $db;
  return find_by_sql("UPDATE pengajuan SET status_pj = '{$hari}' WHERE SPM ='{$spm}'");
   
}


//find pengajuan yg status pengajuan 1
function find_pengajuanok_tgl($tgl1,$tgl2)
{
  global $db;
  return find_by_sql("SELECT p.id as id,p.SPM as SPM,p.status_verifikasi as status_verifikasi,p.status_kppn as status_kppn,p.status_spm as status_spm,p.status_sp2d as status_sp2d,p.upload as upload,p.id_nodin as id_nodin, p.sp2d as sp2d,p.created_at as created_at,p.verifikasi_kasubbag_v as verifikasi_kasubbag_v,p.id_jenis_pengajuan as id_jenis_pengajuan,p.penolakan_kppn as penolakan_kppn,p.file_spm as file_spm,p.file_sp2d as file_sp2d,p.upload_adk as upload_adk,p.upload_pertanggungjawaban as upload_pertanggungjawaban, p.status_pengambilan_uang as status_pengambilan_uang  FROM `pengajuan` p,nodin n WHERE p.id_nodin = n.id and n.status_pengajuan=1 and n.tanggal between '".$tgl1."' and '".$tgl2."' ORDER BY p.id DESC");
    // $sql = $db->query("SELECT * FROM `pengajuan` p,nodin n WHERE p.id_nodin = n.id and n.status_pengajuan=1 ORDER BY p.id DESC");
    //       if($result = $db->fetch_assoc($sql))
    //         return $result;
    //       else
    //         return null;
   
}
/*--------------------------------------------------------------*/
/* Function for find all database table pengajuan dan detail pengajuan
/*--------------------------------------------------------------*/
function find_pengajuan($id) {
  global $db;
    return find_by_sql("SELECT * FROM `pengajuan` p,detail_pengajuan d WHERE p.id=d.id_pengajuan and p.`id` IN ($id)");
}
/*--------------------------------------------------------------*/
/* Function for find all database table rows by table id_satker
/*--------------------------------------------------------------*/
function find_all_by_satker($table,$id) {
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE id_satker='{$db->escape($id)}'");
  }
}
/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all_by_id($table,$id) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE id_user='{$db->escape($id)}'");
   }
}
/*--------------------------------------------------------------*/
/* Function for find all database table global
/*--------------------------------------------------------------*/
function find_all_global($table,$id,$key) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE {$db->escape($key)} ='{$db->escape($id)}' ORDER BY id DESC");
   }
}
function find_all_global_pencairan($table,$id,$id2) {
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE status ='{$db->escape($id)}' AND id_jenis_bendahara ='{$db->escape($id2)}' ORDER BY id DESC");
  }
}
function find_count_global($table,$id,$key) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT count(*) as jml FROM ".$db->escape($table)." WHERE {$db->escape($key)} ='{$db->escape($id)}' ORDER BY id DESC");
   }
}
function find_all_global_satker($table,$id,$key,$satker) {
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE {$db->escape($key)} ='{$db->escape($id)}' and id_satker = '{$satker}' ORDER BY id DESC");
  }
}
function find_all_global_op($table,$id,$key,$op) {
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE {$db->escape($key)} {$op}'{$db->escape($id)}' ORDER BY id DESC");
  }
}
function find_all_global_ls($table,$id,$id2,$key) {
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE {$db->escape($key)} !={$db->escape($id)} AND {$db->escape($key)} !={$db->escape($id2)} ORDER BY id DESC");
  }
}

function find_all_global_tahun($table,$id,$key,$tahun) {
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE {$db->escape($key)} ='{$db->escape($id)}' AND tahun ='{$tahun}' ORDER BY id DESC");
  }
}

function find_all_global_tahun_pum($table,$tahun) {
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE tahun ='{$tahun}' AND id_jenis =1 and (id_satker = 1 OR id_satker = 2 OR id_satker = 3 OR id_satker = 4 OR id_satker = 14 ) ORDER BY id DESC");
  }
}

function find_all_group_by_satker($table,$key,$tahun) {
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT sum(nominal) as nominal , id_satker FROM ".$db->escape($table)." WHERE YEAR(tanggal) = '{$db->escape($tahun)}'  GROUP BY {$db->escape($key)}");
  }
}

/*--------------------------------------------------------------*/
/* Function for find all database table global
/*--------------------------------------------------------------*/
function find_filed_tabel($database,$tb) {
  global $db;
  if(tableExists($tb))
  {
    return find_by_sql("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='{$database}' AND TABLE_NAME='{$tb}'");
  }
}

//mengambil spm yang belom di sp2d kan berdasarkan satker
function find_tt($id) {
  global $db;
 
    return find_by_sql("SELECT * FROM `nodin` n,pengajuan p, detail_pengajuan dp WHERE n.id=p.id_nodin and p.id=dp.id_pengajuan and n.id_satker ={$id} and p.status_sp2d=0 and p.status_kppn!=0");

}

function find_ss($id_satker,$id_status) {
  global $db;
return find_by_sql("SELECT p.nominal as nominal,p.spm as spm,p.id_satker as id_satker,k.id as id FROM `pencairan` p,k_cair k WHERE p.status=k.id and p.status={$id_status} and p.id_satker={$id_satker}");

}

//gabungan tabel pengajuan, nodin,dan detail pengajuan
function find_n_p_dp($id) {
  global $db;
 
    return find_by_sql("SELECT n.p_pengajuan as pegawai,sum(dp.nominal) as nominal,p.SPM as spm,n.tanggal as tgl,a.mak as akun FROM `nodin` n,pengajuan p,detail_pengajuan dp,akun a WHERE a.id=dp.id_akun and n.id=p.id_nodin and p.id=dp.id_pengajuan and n.id = {$id} group by p.SPM");

}

//ambil jumlah nominal SPM
function nominalSPM($id) {
  global $db;
    return find_by_sql("SELECT sum(dp.nominal) as nom from pengajuan p,detail_pengajuan dp where p.id=dp.id_pengajuan and p.id={$id} group by id_pengajuan");

}



/*--------------------------------------------------------------*/
/* Function for find all database tabledetaip pengajuan by id pengajuan
/*--------------------------------------------------------------*/
function find_detail($id) {
  global $db;
    return find_by_sql("SELECT * FROM detail_pengajuan WHERE id_pengajuan = '{$id}'");
}

function find_sum_sptjb($id) {
  global $db;
    return find_by_sql("SELECT sum(nominal) as nominal FROM detail_pengajuan WHERE id_pencairan = '{$id}'");
}

function find_detail_pum($id) {
  global $db;
    return find_by_sql("SELECT * FROM detail_pengajuan WHERE id_pencairan = '{$id}'");
}

function find_sptjb_pum() {
  global $db;
    return find_by_sql("SELECT dp.no_sptjb as no_sptjb,dp.id_akun as id_akun,dp.nominal as nominal,dp.pph as pph,dp.ppn as ppn,dp.tanggal_dp as tanggal_dp,dp.keterangan as keterangan,dp.id as id,dp.file_pj as file_pj,p.id_satker as id_satker,p.spm as spm FROM detail_pengajuan dp, pencairan p WHERE dp.id_pencairan = p.id and dp.id_pengajuan = 0");
}
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

function sumStatus($id)
{
  global $db;
  $id = (int)$id;
          $sql = $db->query("SELECT sum(nominal) as jum  FROM pencairan WHERE status='{$db->escape($id)}' ");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
    
}

function find_DESC($table)
{
  global $db;
    if(tableExists($table)){
      $sql = $db->query("SELECT * FROM {$db->escape($table)} ORDER BY id DESC LIMIT 1");
      if($result = $db->fetch_assoc($sql))
        return $result;
      else
        return null;
    }
}

function find_Tpengajuan($id)
{
  global $db;
  $id = (int)$id;
    
    $sql = $db->query("SELECT SPM,tanggal,id_akun,id_satker,sum(nominal)-(sum(ppn)+sum(pph)) as jum FROM `detail_pengajuan` dp,pengajuan p,nodin n WHERE p.id=dp.id_pengajuan and id_pengajuan= {$id} and n.id = p.id_nodin");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
   
}

function find_NominalPengajuan($id)
{
  global $db;
  $id = (int)$id;
    
    $sql = $db->query("SELECT SPM,tanggal,id_akun,id_satker,sum(nominal) as jum FROM `detail_pengajuan` dp,pengajuan p,nodin n WHERE p.id=dp.id_pengajuan and id_pengajuan= {$id} and n.id = p.id_nodin");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
   
}







//find filed yg ditentukan satu record
function find_by_filed($table,$id,$filed)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE {$db->escape($filed)}='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

function count_by_id_pengajuan($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table)." WHERE id_pengajuan=".$id;
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}

function count_by_id_nodin($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table)." WHERE id_nodin=".$id;
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $query = "SELECT id,username,password,user_level FROM users WHERE username=? LIMIT 1";
    $username = $db->escape($username);
    $password = $db->escape($password);
    $query_prepare = $db->query($query);
    $query_prepare->bind_param("s", $username);
    $query_prepare->execute();
    $result = $query_prepare->get_result();
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }
  /*--------------------------------------------------------------*/
  /* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,u.id_satker, ";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }

  function find_sptb_tahun($tahun,$id_satker){
    global $db;
    $results = array();
    $sql = "SELECT * ";
    $sql .="FROM detail_pengajuan d ";
    $sql .=",pengajuan p ";
    $sql .=",nodin n ";
    $sql .="WHERE d.id_pengajuan = p.id and p.id_nodin = n.id and n.tahun ='{$tahun}' ";
    $sql .="and n.id_satker ='{$id_satker}' and (n.id_jenis=2 or n.id_jenis=6) and n.status_pengajuan=1";
    $result = find_by_sql($sql);
    return $result;
}

function find_pencairan_tahun($tahun,$id_satker,$panjar){
  global $db;
  $results = array();
  $sql = "SELECT * ";
  $sql .="FROM pencairan ";
  $sql .="WHERE YEAR(tanggal) ='{$tahun}' ";
  $sql .="and id_satker ='{$id_satker}' and spm like '%{$panjar}%'";
  $result = find_by_sql($sql);
  return $result;
}
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['user_level']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Please login...');
            redirect('index.php', false);
      //if Group status Deactive
     elseif($login_level['group_status'] === '0'):
           $session->msg('d','This level user has been band!');
           redirect('home.php',false);
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "Sorry! you dont have permission to view the page.");
            redirect('home.php', false);
        endif;

     }
   /*--------------------------------------------------------------*/
   /* Function for Finding all product name
   /* JOIN with categorie  and media database table
   /*--------------------------------------------------------------*/
  function join_product_table(){
     global $db;
     $sql  =" SELECT p.id,p.name,p.quantity,p.buy_price,p.sale_price,p.media_id,p.date,c.name";
    $sql  .=" AS categorie,m.file_name AS image";
    $sql  .=" FROM products p";
    $sql  .=" LEFT JOIN categories c ON c.id = p.categorie_id";
    $sql  .=" LEFT JOIN media m ON m.id = p.media_id";
    $sql  .=" ORDER BY p.id ASC";
    return find_by_sql($sql);

   }
  /*--------------------------------------------------------------*/
  /* Function for Finding all product name
  /* Request coming from ajax.php for auto suggest
  /*--------------------------------------------------------------*/

   function find_product_by_title($product_name){
     global $db;
     $p_name = remove_junk($db->escape($product_name));
     $sql = "SELECT name FROM products WHERE name like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

  /*--------------------------------------------------------------*/
  /* Function for Finding all product info by product title
  /* Request coming from ajax.php
  /*--------------------------------------------------------------*/
  function find_all_product_info_by_title($title){
    global $db;
    $sql  = "SELECT * FROM products ";
    $sql .= " WHERE name ='{$title}'";
    $sql .=" LIMIT 1";
    return find_by_sql($sql);
  }

  /*--------------------------------------------------------------*/
  /* Function for Update product quantity
  /*--------------------------------------------------------------*/
  function update_product_qty($qty,$p_id){
    global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;
    $sql = "UPDATE products SET quantity=quantity -'{$qty}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

  }
  /*--------------------------------------------------------------*/
  /* Function for Update product quantity
  /*--------------------------------------------------------------*/
  function update_product_qty_ok($p_id){
    global $db;
    //$qty = (int) $qty;
    $id  = (int)$p_id;
    $sBM ="SELECT sum(qty) as jum from product_in WHERE product_id=? GROUP BY product_id";
    $h=$db->query($sBM);
    $h->bind_param("i", $id);
    $h->execute();
    $h_result = $h->get_result();
    $j=$h_result->fetch_object();
    $jM =$j->jum;
    $sBK ="SELECT sum(qty) as jum from sales WHERE product_id=? GROUP BY product_id";
    $hk=$db->query($sBK);
    $hk->bind_param("i", $id);
    $hk->execute();
    $hk_result = $hk->get_result();
    $jk=$hk_result->fetch_object();
    $jlK =0;
    if($jk->jum != ''){
        $jlK =$jk->jum;
    }else{
      $jlK=0;
    }
    $stok = $jM-$jlK;
  // return $sBM.'='.$sBK.'='.$stok.'='. $jlK;
    $sql = "UPDATE products SET quantity= '{$stok}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

  }
  /*--------------------------------------------------------------*/
  /* Function for Display Recent product Added
  /*--------------------------------------------------------------*/
 function find_recent_product_added(){
   global $db;
   $sql   = " SELECT s.keterangan as keterangan,sum(nominal) as total FROM `nodin`n,pengajuan p,detail_pengajuan dp,satker s WHERE s.id=n.id_satker and p.id_nodin = n.id and dp.id_pengajuan=p.id and p.status_sp2d!=0 group by n.id_satker";
   return find_by_sql($sql);
 }

 function find_realisasi_bpp($id_satker,$tahun){
  global $db;
  $sql   = " SELECT s.keterangan as keterangan,sum(nominal) as total FROM `nodin`n,pengajuan p,detail_pengajuan dp,satker s WHERE s.id=n.id_satker and p.id_nodin = n.id and dp.id_pengajuan=p.id and p.status_sp2d!=0 and n.id_satker='{$id_satker}' and n.tahun='{$tahun}'";
  return find_by_sql($sql);
}
 /*--------------------------------------------------------------*/
 /* Function for Find Highest saleing Product
 /*--------------------------------------------------------------*/
 function find_higest_saleing_product(){
   global $db;
   $sql  = "SELECT s.keterangan as keterangan,count(*) as total_spm FROM `nodin`n,pengajuan p,satker s WHERE s.id=n.id_satker and p.id_nodin = n.id and p.status_sp2d!=0 group by n.id_satker";
   return $db->query($sql);
 }

 function spm_proses($id_satker){
  global $db;
  $sql  = "SELECT s.keterangan as keterangan, count(*) as total_spm FROM `nodin`n,pengajuan p,satker s WHERE s.id=n.id_satker and p.id_nodin = n.id and p.status_sp2d!=0 and n.id_satker='{$id_satker}'";
  return find_by_sql($sql);
}
function spm_blm_proses($id_satker){
  global $db;
  $sql  = "SELECT s.keterangan as keterangan, count(*) as total_spm FROM `nodin`n,pengajuan p,satker s WHERE s.id=n.id_satker and p.id_nodin = n.id and p.status_sp2d=0 and n.id_satker='{$id_satker}'";
  return find_by_sql($sql);
}
 /*--------------------------------------------------------------*/
 /* Function for find all sales
 /*--------------------------------------------------------------*/
 function find_all_sale(){
   global $db;
   $sql  = "SELECT s.id,s.qty,s.price,s.date,p.name";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN products p ON s.product_id = p.id";
   $sql .= " ORDER BY s.date DESC";
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Display Recent sale
 /*--------------------------------------------------------------*/
  /*--------------------------------------------------------------*/
 /* Function for find all Barang Masuk
 /*--------------------------------------------------------------*/
 function find_all_Bmasuk(){
   global $db;
   $sql  = "SELECT s.id,s.qty,s.date,p.name";
   $sql .= " FROM product_in s";
   $sql .= " LEFT JOIN products p ON s.product_id = p.id";
   $sql .= " ORDER BY s.date DESC";
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Display SPM yang belom cair
 /*--------------------------------------------------------------*/
function find_recent_sale_added(){
  global $db;
  $sql  = "SELECT s.keterangan as keterangan,count(*) as jumlah_SPM FROM `nodin`n,pengajuan p,satker s WHERE s.id=n.id_satker and p.id_nodin = n.id and p.status_sp2d=0 group by n.id_satker";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate sales report by two dates
/*--------------------------------------------------------------*/
function find_sale_by_dates($start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
  $sql  = "SELECT s.date, p.name,p.sale_price,p.buy_price,";
  $sql .= "COUNT(s.product_id) AS total_records,";
  $sql .= "SUM(s.qty) AS total_sales,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price,";
  $sql .= "SUM(p.buy_price * s.qty) AS total_buying_price ";
  $sql .= "FROM sales s ";
  $sql .= "LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE s.date BETWEEN '{$start_date}' AND '{$end_date}'";
  $sql .= " GROUP BY DATE(s.date),p.name";
  $sql .= " ORDER BY DATE(s.date) DESC";
  return $db->query($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report
/*--------------------------------------------------------------*/
function  dailySales($year,$month){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report
/*--------------------------------------------------------------*/
function  monthlySales($year){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN products p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%c' ),s.product_id";
  $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
  return find_by_sql($sql);
}

?>
