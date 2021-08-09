<?php
  $page_title = 'All Nodin';
  require_once('includes/load.php');
  $user=find_by_id('users',$_SESSION['user_id']);
  // Checkin What level user has permission to view this page

  if($user['user_level'] == 7 ){
         page_require_level(7);
  }else if($user['user_level'] == 2 ){
      page_require_level(2);
  }


  

if(isset($_POST['batal_cair'])){
  $req_fields = array('batal_cair');
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id']));
    
    $query  = "UPDATE pengajuan SET ";
    $query .=" status_pengambilan_uang= '0'";
    $query .=" WHERE id='{$id}'";
    if($db->query($query)){
      $session->msg('s',"Konfirmasi Updated ");
      if($user['user_level']==2){
       redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
      }else{
      redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
      }
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      if($user['user_level']==2){
       redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
     }else{
        redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('detail_dokumen_ses.php?id='.$_GET['id'],false);
  }

}



if(isset($_POST['cair'])){
  $req_fields = array('cair');
  validate_fields($req_fields);
  if(empty($errors)){
    $id   = remove_junk($db->escape($_POST['id']));
    $keterangan   = remove_junk($db->escape($_POST['keterangan']));
    $date    = make_date();
    $query  = "UPDATE pengajuan SET ";
    $query .=" status_pengambilan_uang= '1'";
    $query .=" WHERE id='{$id}'";
    if($db->query($query)){
      $session->msg('s',"Konfirmasi Updated ");
      if($user['user_level']==2){
       redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
      }else{
      redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
      }
    } else {
      $session->msg('d',' Sorry failed to Updated!');
      if($user['user_level']==2){
       redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
     }else{
        redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
     }
    }

  } else{
    $session->msg("d", $errors);
    redirect('detail_dokumen_ses.php?id='.$_GET['id'],false);
  }

}


  if(isset($_POST['update_penolakan'])){
    $req_fields = array('keterangan');
    validate_fields($req_fields);
    if(empty($errors)){
      $id   = remove_junk($db->escape($_POST['id']));
      $keterangan   = remove_junk($db->escape($_POST['keterangan']));
      $date    = make_date();
      $query  = "UPDATE pengajuan SET ";
      $query .=" penolakan_kppn= '{$keterangan}'";
      $query .=" WHERE id='{$_GET['id']}'";
      if($db->query($query)){
        $session->msg('s',"Keterangan penolakan KPPN Updated ");
        if($user['user_level']==2){
         redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
        }else{
        redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
        }
      } else {
        $session->msg('d',' Sorry failed to Updated!');
        if($user['user_level']==2){
         redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
       }else{
          redirect('detail_dokumen_ses.php?id='.$_GET['id'], false);
       }
      }
  
    } else{
      $session->msg("d", $errors);
      redirect('detail_dokumen_ses.php?id='.$_GET['id'],false);
    }
  
  }
  if(isset($_GET['s']) and $_GET['s'] == 'spm'){
    //var_dump($_GET); echo "ok";exit();
    if($_GET['s'] == 'spm'){
     
      $pengajuan = find_by_id('pengajuan',$_GET['id']);//var_dump($pengajuan);exit();
    $query  = "UPDATE pengajuan SET ";
          $query .= "file_spm=''";
          $query .= "WHERE id='{$pengajuan["id"]}'";
          $result = $db->query($query);
          $session->msg('s',' Berhasil di Batalkan');
          
        redirect('detail_dokumen_ses.php?id='.$pengajuan['id']);
    }else{
      $session->msg('d',' Gagal di batalkan!');
        redirect('detail_dokumen_ses.php'.$pengajuan['id'], false);
    }
  }

  if(isset($_GET['s']) and $_GET['s'] == 'adk_spm_batal'){
    //var_dump($_GET); echo "ok";exit();
    if($_GET['s'] == 'adk_spm_batal'){
     
      $pengajuan = find_by_id('pengajuan',$_GET['id']);//var_dump($pengajuan);exit();
    $query  = "UPDATE pengajuan SET ";
          $query .= "upload_adk_spm=''";
          $query .= "WHERE id='{$pengajuan["id"]}'";
          $result = $db->query($query);
          $session->msg('s',' Berhasil di Batalkan');
          
        redirect('detail_dokumen_ses.php?id='.$pengajuan['id']);
    }else{
      $session->msg('d',' Gagal di batalkan!');
        redirect('detail_dokumen_ses.php'.$pengajuan['id'], false);
    }
  }


  if(isset($_GET['s']) and $_GET['s'] == 'sp2d'){
   
    if($_GET['s'] == 'sp2d'){
      $pengajuan = find_by_id('pengajuan',$_GET['id']);//var_dump($pengajuan);exit();
    $query  = "UPDATE pengajuan SET ";
          $query .= "file_sp2d=''";
          $query .= "WHERE id='{$pengajuan["id"]}'";
          $result = $db->query($query);
          $session->msg('s',' Berhasil di Batalkan');
          
        redirect('detail_dokumen_ses.php?id='.$pengajuan['id']);
    }else{
      $session->msg('d',' Gagal di batalkan!');
        redirect('detail_dokumen_ses.php?id='.$pengajuan['id'], false);
    }
  }
  

  if(isset($_POST['upload'])) {
    $id = $_POST['id'];
     $pengajuan = find_by_id('pengajuan',$id);
  $photo = new Media();
  $photo->upload($_FILES['file_upload'],$pengajuan['SPM']);
   if($photo->process_sp2d($id)){
       $session->msg('s','dokumen has been uploaded.');
           if($user['user_level']==5){
          redirect('detail_dokumen_ses.php?id='.$pengajuan['id'], false);
       }else{
       redirect('detail_dokumen_ses.php?id='.$pengajuan['id']);
      }
   } else{
     $session->msg('d',join($photo->errors));
     if($user['user_level']==5){
          redirect('detail_dokumen_ses.php?id='.$pengajuan['id'], false);
       }else{
       redirect('detail_dokumen_ses.php?id='.$pengajuan['id']);
      }
   }
  }

  if(isset($_POST['update_sp2d'])){
    $req_fields = array('sp2d', 'id' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape($_POST['id']);
          $sp2d     = $db->escape($_POST['sp2d']);
          
          $sql  = "UPDATE pengajuan SET";
          $sql .= " sp2d='{$sp2d}'";
          $sql .= " WHERE id ='{$p_id}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                   //$h= update_product_qty_ok($p_id);
                      $session->msg('s',"SP2D updated.");
                    redirect("detail_dokumen_ses.php?id=". $p_id, false);
                  } else {
                    $session->msg('d',' Sorry failed to updated!');
                    redirect('detail_dokumen_ses.php', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('detail_dokumen_ses.php',false);
        }
  }
  
 
  
  if(isset($_POST['upload_spm'])) {
    $id = $_POST['id'];
     $pengajuan = find_by_id('pengajuan',$id);

  $photo = new Media();
  $photo->upload($_FILES['file_upload'],$pengajuan['SPM']);
   if($photo->process_spm($id)){
       $session->msg('s','dokumen has been uploaded.');
           if($user['user_level']==5){
          redirect('detail_dokumen_ses.php', false);
       }else{
       redirect('detail_dokumen_ses.php?id='.$pengajuan['id']);
      }
   } else{
     $session->msg('d',join($photo->errors));
     if($user['user_level']==5){
          redirect('detail_dokumen_ses.php?id='.$pengajuan['id'], false);
       }else{
       redirect('detail_dokumen_ses.php?id='.$pengajuan['id']);
      }
   }
  
  }

  if(isset($_POST['upload_adk_spm'])) {
    $id = $_POST['id'];
     $pengajuan = find_by_id('pengajuan',$id);

  $photo = new Media();
  $photo->upload($_FILES['file_upload'],$pengajuan['SPM']);
   if($photo->process_adk_spm($id)){
       $session->msg('s','dokumen has been uploaded.');
           if($user['user_level']==5){
          redirect('detail_dokumen_ses.php', false);
       }else{
       redirect('detail_dokumen_ses.php?id='.$pengajuan['id']);
      }
   } else{
     $session->msg('d',join($photo->errors));
     if($user['user_level']==5){
          redirect('detail_dokumen_ses.php?id='.$pengajuan['id'], false);
       }else{
       redirect('detail_dokumen_ses.php?id='.$pengajuan['id']);
      }
   }
  
  }
?>
<?php

$sales = find_all_global('pengajuan',$_GET['id'],'id');

for($i=0;$i<count($sales);$i++){
  $sale = $sales[$i]; 
}
//var_dump($sale); exit();
$idi= $_GET['id'];

if(isset($_GET['s']) and $_GET['s']==='hapus_adk'){
    $query  = "UPDATE pengajuan SET ";
    $query .= "upload_adk=''";
    $query .= "WHERE id='{$idi}'";
   // echo $query; exit();
    $result = $db->query($query);
    $session->msg('s',' Berhasil di Batalkan');
    if($user['user_level']==5){
  redirect('detail_dokumen.php?id='.$idi);
  }else{
  redirect('detail_dokumen.php?id='.$idi, false);
  }
}
?>



<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Detail Dokumen</span>
          </strong>
          <div class="pull-right">
            <?php   if($user['user_level'] == 2 or $user['user_level'] == 7 ){?>
                <a href="pengajuan_verif.php" class="btn btn-warning">Back</a>
            <?php }else if($user['user_level'] == 3){ ?>
                <a href="pengajuan_spm.php" class="btn btn-warning">Back</a>
            <?php } ?>
          </div>
        </div>
        <div class="panel-body" style="width:100%">
          <table class="table table-bordered table-striped" style="width:100%"> 
            <thead>
              <tr>
               
                <th class="text-center"> Upload Dokumen Pengajuan</th>
                <th class="text-center"> ADK SPP </th>
                <th class="text-center"> ADK SPM </th>
                <th class="text-center"> SPM yang Telah di Proses</th>
                <th class="text-center"> Dokumen SP2D</th>
                <th class="text-center"> SP2D</th>
                <th class="text-center"> Upload Dokumen Pertanggungjawaban</th>
             
             </tr>
            </thead>
           <tbody>
             <?php //foreach ($sales as $sale):?>
             <tr>
                   
                     <td class="text-center">
                        <?php if($sale['upload']==''){?><?php }else{?>
                             <a href="uploads/products/<?=$sale['upload']?>" class="btn btn-success" target="_blank">Preview</a>
                           
                        <?php } ?>
                    </td>

                    <td class="text-center"><?php if($sale['upload_adk']==''){?><?php }else{?>
                             <a href="uploads/adk/<?=$sale['upload_adk']?>" class="btn btn-success" target="_blank">Download</a>
                         <?php } ?>
                    </td>
                    <td class="text-center">
                        <?php if($user['user_level'] == 3){?>
                            <?php if($sale['file_spm']==''){?>
                            <a href="#" class="btn btn-primary" id="UploadSPM" data-toggle="modal" data-target="#uploadSPM" data-id='<?=$sale['id'];?>'>Upload File</a>     
                                <?php }else{ ?>
                                <a href="uploads/spm/<?=$sale['file_spm']?>" class="btn btn-success" target="_blank">Preview</a>
                                
                                <a href="detail_dokumen_ses.php?id=<?=$sale['id']?>&s=spm" class="btn btn-danger">Batal</a>
                                <?php } ?>
                        <?php }else{?>
                        
                            <?php if($sale['file_spm']!=''){?><a href="uploads/spm/<?=$sale['file_spm']?>" class="btn btn-success" target="_blank">Preview</a><?php } ?>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <?php if($user['user_level'] == 3){?>
                            <?php if($sale['upload_adk_spm']==''){?>
                            <a href="#" class="btn btn-primary" id="Upload_adkSPM" data-toggle="modal" data-target="#uploadAdkSPM" data-id='<?=$sale['id'];?>'>Upload File</a>     
                                <?php }else{ ?>
                                <a href="uploads/adk_spm/<?=$sale['upload_adk_spm']?>" class="btn btn-success" target="_blank">Preview</a>
                                
                                <a href="detail_dokumen_ses.php?id=<?=$sale['id']?>&s=adk_spm_batal" class="btn btn-danger">Batal</a>
                                <?php } ?>
                        <?php }else{?>
                        
                            <?php if($sale['upload_adk_spm']!=''){?><a href="uploads/adk_spm/<?=$sale['upload_adk_spm']?>" class="btn btn-success" target="_blank">Preview</a><?php } ?>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                          <?php if($user['user_level'] == 5 or $user['user_level'] == 4) { ?>
                            
                            <?php if($sale['file_sp2d']==''){?>
                                         <a href="#" class="btn btn-primary" id="UploadSP2D" data-toggle="modal" data-target="#uploadSP2D" data-id='<?=$sale['id'];?>'>Upload File</a>     
                                    <?php }else{ ?>
                                         <a href="uploads/sp2d/<?=$sale['file_sp2d']?>" class="btn btn-success" target="_blank">Preview</a>
                                         <a href="detail_dokumen_ses.php?id=<?=$sale['id']?>&s=sp2d" class="btn btn-danger">Batal</a>
                                    <?php } ?>
                                    
                            <?php }else{ ?>

                                    <?php if($sale['file_sp2d']!=''){?><a href="uploads/sp2d/<?=$sale['file_sp2d']?>" class="btn btn-success" target="_blank">Preview</a><?php } ?>
                            <?php } ?>
                    </td>
                    <td class="text-center">
                         <?php if($user['user_level'] == 6){
                            echo $sale['sp2d'];
                         }else{?>
                            <?php if($sale['sp2d'] == ''){?><a href="#" class="btn btn-primary" id="editsp2d" data-toggle="modal" data-target="#exampleModal" data-id='<?=$sale['id'];?>'>Input SP2D</a><?php }else{?>
                            <a href="#" class="btn btn-warning" id="editsp2d" data-toggle="modal" data-target="#exampleModal" data-id='<?=$sale['id'];?>' data-sp2d='<?=$sale['sp2d'];?>'><?=$sale['sp2d'];?></a> <?php } ?>
                        <?php } ?>
                    </td>

                    <td class="text-center"><?php if($sale['upload_pertanggungjawaban']==''){?><?php }else{?>
                             <a href="uploads/pertanggungjawaban/<?=$sale['upload_pertanggungjawaban']?>" class="btn btn-success" target="_blank">Preview</a>
                               
                             <?php } ?>
                    </td>

              
             </tr>


             <?php //endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
    
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        
        <div class="panel-body" style="width:100%">
          <table id="tabel" class="table table-bordered table-striped" style="width:100%">
            <thead>
              <tr>  
               <th class="text-center"> Status Verifikasi </th> 
                <th class="text-center"> Status SPM </th> 
                <th class="text-center"> Keterangan Penolakan KPPN </th> 
                <th class="text-center"> Status KPPN </th>   
                <th class="text-center"> Status SP2D </th>
                <th class="text-center"> Status Pengambilan Uang </th>  
             </tr>
            </thead>
           <tbody>
             <tr>
                   
                <td class="text-center">
                    <?php if($sale['status_verifikasi']=='0'){?>
                        
                      <a class="btn btn-success" href="<?php $jenis= find_by_id('jenis_pengajuan',$sale['id_jenis_pengajuan']); echo $jenis['link']?>.php?id=<?php echo $sale['id']?>&v=insert"><?=$jenis['keterangan']?></a>
                      
                    <?php }else{
                        
                        $v = find_by_filed('verifikasi',$sale['id'],'id_pengajuan');  
                        if($v['status_pengajuan']==1){
                        ?>
                        <span class="label label-success">Terverifikasi verifikator</span><br>
                        <?php }else{ ?>
                        <span class="label label-danger">Ditolak verifikator</span><br>
                        <?php } ?>
                        <br>

                        <?php $p = find_by_filed('pengajuan',$sale['id'],'id');  
                        if($p['verifikasi_kasubbag_v']==1){   ?>
                        <span class="label label-success">Terverifikasi Kasubbag verifikator</span>
                        <?php }else if($p['verifikasi_kasubbag_v']==2){ ?>
                        <span class="label label-danger">Ditolak Kasubbag verifikator</span>
                        <?php }else{ ?>
                          <span class="label label-warning"> Kasubbag belom verifikasi</span>
                        <?php } ?>
                        <?php  $user = find_by_id('users',$_SESSION['user_id']); if($user['user_level'] == 2  or $user['user_level'] == 7){  ?>
                                <a href="<?php $jenis= find_by_id('jenis_pengajuan',$sale['id_jenis_pengajuan']); echo $jenis['link'];?>.php?id=<?=$sale['id']?>" class="btn btn-success">Edit</a>
                                    <br>
                              
                                  <a href="batal_verifikasi.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal
                                [<?php $user = find_by_id('users',(int)$sale['status_verifikasi']);echo $user['name'];?>]
                                </a>
                    
                    <?php }} ?>
                    
                </td>
                <td class="text-center">

                    <?php  $user = find_by_id('users',$_SESSION['user_id']); if($sale['status_spm']==0 and $user['user_level'] == 3 and $sale['verifikasi_kasubbag_v'] == 1){?>
                              <a href="update_spm.php?id=<?=$sale['id']?>" class="btn btn-success">Proses</a>         
                    <?php }else if($sale['status_spm'] != 0 and $user['user_level'] == 3){ ?>          
                              <a href="batal_spm.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal</a>
                      <?php }else if($sale['status_spm']==0 and $user['status_verifikasi'] == 0 ){?>
                                <span class="label label-danger">Belom di Proses</span>
                      <?php }else{  ?>
                        <span class="label label-success">Sudah di Proses oleh <?php $user = find_by_id('users',(int)$sale['status_spm']);echo $user['name'];?></span>
                      <?php } ?>   
                </td>
                <td class="text-center"><?//=$sale['penolakan_kppn'];var_dump($sale); ?>
                      <?php $user = find_by_id('users',$_SESSION['user_id']);  
                          if($sale['status_spm'] == 0 ){ ?>
                              <span class="label label-danger">Belom di proses</span>
                      <?php }else if($user['user_level'] == 4 and $sale['penolakan_kppn'] == '' ){ ?>
                              <a href="#" class="btn btn-warning" id="penolakan"  data-toggle="modal" data-target="#PenolakanKPPN" data-id='<?=$sale['id'];?>' data-keterangan='<?=$sale['penolakan_kppn'];?>'>Input Kekurangan</a>
                      <?php }else if($user['user_level'] == 4 and $sale['penolakan_kppn'] != '' ){ ?>
                              <a href="#" class="btn btn-warning" id="penolakan"  data-toggle="modal" data-target="#PenolakanKPPN" data-id='<?=$sale['id'];?>' data-keterangan='<?=$sale['penolakan_kppn'];?>'><?=$sale['penolakan_kppn'];?></a>
                      <?php }else{ ?>
                              <span class="label label-success">SPM sudah di proses= <?=$sale['penolakan_kppn'];?></span>
                        <?php } ?>
                </td>
                <td class="text-center">
                      <?php $user = find_by_id('users',$_SESSION['user_id']);  
                          if($sale['status_spm'] == 0  ){ ?>
                              <span class="label label-danger">Belom di proses oleh verifikator</span>
                      <?php }else if($user['user_level'] == 4 and $sale['status_kppn'] == 0 ){ ?>
                              <a href="update_kppn.php?id=<?=$sale['id']?>" class="btn btn-success">Proses</a> 
                        <?php }else if($user['user_level'] == 4 and $sale['status_kppn'] != 0 ){ ?>
                            <a href="batal_kppn.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal</a>
                        <?php }else if($sale['status_kppn'] != 0){ ?>
                            <span class="label label-success">Diterima KPPN</span><br>
                        <?php }else if($sale['status_kppn'] == 0){ ?>
                          <span class="label label-danger">Belom di proses petugas KPPN</span><br>
                        <?php }?> 
                  </td>

                <td class="text-center">
                
                      <?php $user = find_by_id('users',$_SESSION['user_id']);  
                      if($sale['status_kppn']==0){ ?>
                        <span class="label label-danger">belom di validasi oleh petugas pengirim SPM ke KPPN</span>
                      <?php }else if($sale['status_sp2d']==0 and ($user['user_level']== 5 or $user['user_level']== 4)){ ?>
                            <a href="update_sp2d.php?id=<?=$sale['id']?>" class="btn btn-success">Proses</a>  
                      <?php }else if($sale['status_sp2d']!=0 and ($user['user_level']== 5 or $user['user_level']== 4)){ ?>
                            <a href="batal_sp2d.php?id=<?=$sale['id']?>" class="btn btn-danger">Batal</a>
                      <?php }else if($sale['status_sp2d']!=0 and $user['user_level']!= 5){  ?>
                            <span class="label label-success">Sudah di Cairkan</span> 
                      <?php } ?>
                </td>
                <td class="text-center">
                    <?php $user = find_by_id('users',$_SESSION['user_id']);  
                      if($sale['status_sp2d']==0){ ?>
                        <span class="label label-danger">SP2D belom di Proses</span>
                      <?php }else if($sale['status_pengambilan_uang']==0 and $user['user_level']== 5){ ?>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?=$sale['id']?>">
                            <button name="cair" value="cair" class="btn btn-success">Konfirmasi</button>
                        </form>  
                      <?php }else if($sale['status_pengambilan_uang']!=0 and $user['user_level']== 5){ ?>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?=$sale['id']?>">
                            <button name="batal_cair" value="batal_cair" class="btn btn-danger">Batal</button>
                        </form>
                      <?php }else if($sale['status_sp2d']!=0 and $user['user_level']!= 5){  ?>
                            <span class="label label-success">Sudah di Ambil</span> 
                      <?php } ?>
                </td>            
             </tr>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>

   <!-- Modal input nodin-->
<div class="modal fade" id="NodinPengajuan" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Nodin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="nodin_bpp.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Tanggal</label>
        <input type="date" class="form-control" id="nodin" name="tanggal" placeholder="tanggal">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Nomor Nodin</label>
        <input type="text" class="form-control" id="no_nodinn" name="no_nodin" placeholder="Nomor Nodin">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Pegawai Pengajuan</label>
        <input type="text" class="form-control" id="nodin" name="p_pengajuan" placeholder="Pegawai Pengajuan">
        <input type="hidden" class="form-control" id="id" value="<?php $users=find_by_id('users',$_SESSION['user_id']);echo $users['id_satker'] ;?>" name="id_satker" >
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Jenis Pengajuan</label>
                <select class="form-control" name="id_jenis">
                      <option value="">Pilih Jenis Pengajuan</option>
                      <?php $jenis = find_all('jenis');?>
                    <?php  foreach ($jenis as $j): ?>
                      <option value="<?php echo (int)$j['id'] ?>">
                        <?php echo $j['keterangan'] ?></option>
                    <?php endforeach; ?>
                </select>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submit_nodin" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>






       <!-- Modal Upload berkas SPM-->
 <div class="modal fade" id="uploadSPM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload SPM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Upload File</label>
        <input type="file" class="form-control" id="sp2d" name="file_upload" placeholder="SP2D">
        <input type="hidden" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="upload_spm" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>

      <!-- Modal Upload berkas SPM-->
      <div class="modal fade" id="uploadAdkSPM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload ADK SPM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Upload File</label>
        <input type="file" class="form-control" id="sp2d" name="file_upload" placeholder="SP2D">
        <input type="hidden" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="upload_adk_spm" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>




     <!-- Modal input sp2d-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SP2D</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Masukkan Kode SP2D</label>
        <input type="text" class="form-control" id="sp2d" name="sp2d" placeholder="SP2D">
        <input type="hidden" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update_sp2d" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>



  <!-- Modal edit sp2d-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit SP2D</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Edit Kode SP2D</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="sp2d" placeholder="SP2D">
        <input type="text" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update1_sp2d" value="Update">
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal edit sp2d-->
<div class="modal fade" id="exampleModalOK" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Coba SP2D</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Edit Kode SP2D</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="sp2d" placeholder="SP2D">
        <input type="text" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update1_sp2d" value="Update">
      </div>
      </form>
    </div>
  </div>
</div>

 <!-- Modal Edit nodin-->
 <div class="modal fade" id="UpdateNodinPengajuan" tabindex="-1" role="dialog" aria-labelledby="nodin" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Nodin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="nodin_bpp.php" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Nomor Nodin</label>
        <input type="text" class="form-control" id="no_nodin" name="no_nodin" placeholder="Nomor Nodin">
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Pegawai Pengajuan</label>
        <input type="text" class="form-control" id="pp" name="p_pengajuan" placeholder="Pegawai Pengajuan">
        <input type="hidden" class="form-control" id="id" name="id" >
        <input type="hidden" class="form-control" id="id_user" value="<?php $users=find_by_id('users',$_SESSION['user_id']);echo $users['id_satker'] ;?>" name="id_satker" >
       </div>
       <div class="form-group">
        <label for="exampleInputEmail1">Jenis Pengajuan</label>
                <select class="form-control" name="id_jenis">
                      <option value="">Pilih Jenis Pengajuan</option>
                      <?php $jenis = find_all('jenis');?>
                    <?php  foreach ($jenis as $j): ?>
                      <option value="<?php echo (int)$j['id'] ?>">
                        <?php echo $j['keterangan'] ?></option>
                    <?php endforeach; ?>
                </select>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update_nodin" value="Update">
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Upload berkas SP2D-->
<div class="modal fade" id="uploadSP2D" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload SP2D</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Upload File</label>
        <input type="file" class="form-control" id="sp2d" name="file_upload" placeholder="SP2D">
        <input type="hidden" class="form-control" id="id" name="id" >
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="upload" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Penolakan-->
<div class="modal fade" id="PenolakanKPPN" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Penolakan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
      <div class="modal-body">
       <div class="form-group">
        <label for="exampleInputEmail1">Masukkan Penolakan KPPN</label>
        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="keterangan"> 
       </div>
       <input type="hidden" class="form-control" id="id" name="id" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="update_penolakan" value="Save">
      </div>
      </form>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
