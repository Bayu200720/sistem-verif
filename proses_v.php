<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  $user = find_by_id('users',$_SESSION['user_id']);
   if($user['user_level'] == 2){ //echo "ok 3";exit();
   page_require_level(2); 
   }else if($user['user_level'] == 7 ){ //echo "7";exit();
     page_require_level(7); 
   }else{ //echo "3";exit();
     page_require_level(2); 
   }
 ?>
<?php
  $pengajuan = find_by_id('verifikasi',(int)$_GET['id']);
  $jenis_v = find_by_id('pengajuan',$pengajuan['id_pengajuan']);
  $user = find_by_id('users',(int)$_SESSION['user_id']);
  if(!$pengajuan){
    $session->msg("d","Missing Pengajuan id.");

    if($user['user_level']==2){
      redirect('pengajuan_verifikator.php');  
    }else{
    redirect('pengajuan.php');
    }
  }
  if($_GET['p'] === 'v_kasubbag'){
    $query  = "UPDATE pengajuan SET ";
    $query .= "verifikasi_kasubbag_v = 1";
    $query .= " WHERE id='{$pengajuan["id_pengajuan"]}'";
    $result = $db->query($query);
    $session->msg('s',' Berhasil di Proses');
    if($user['user_level']==2){
      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }
  }

  if($_GET['p'] === 'bv_kasubbag'){
    $query  = "UPDATE pengajuan SET ";
    $query .= "verifikasi_kasubbag_v = 0";
    $query .= " WHERE id='{$pengajuan["id_pengajuan"]}'";
    $result = $db->query($query);
    $session->msg('s',' Berhasil di Proses');
    if($user['user_level']==2){
      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }
  }


  if($_GET['p'] === 'update'){
    $query  = "UPDATE verifikasi SET ";
    $query .= "{$_GET['key']} = 1";
    $query .= " WHERE id='{$pengajuan["id"]}'";
    $result = $db->query($query);
    $session->msg('s',' Berhasil di Proses');
    if($user['user_level']==2){
       $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }
  }
  if($_GET['p'] === 'batal'){
    $query  = "UPDATE verifikasi SET ";
    $query .= "{$_GET['key']}=0";
    $query .= " WHERE id='{$pengajuan["id"]}'";
    $result = $db->query($query);
    $session->msg('s',' Berhasil di Batalkan');
    if($user['user_level']==2){
       $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }
  }

  if($_GET['key'] === 'rkakl'){
    $query  = "UPDATE verifikasi SET ";
    $query .= "rkakl=1";
    $query .= " WHERE id='{$pengajuan["id"]}'";
    //exit();
    $result = $db->query($query);
    
    $session->msg('s',' Berhasil di Proses');
    if($user['user_level']==2){
       $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
     //  var_dump($jenis_v);exit();
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }
  }

  if($_GET['key'] === 'brkakl'){
    $query  = "UPDATE verifikasi SET ";
    $query .= "rkakl=0";
    $query .= " WHERE id='{$pengajuan["id"]}'";
    $result = $db->query($query);
    $session->msg('s',' Berhasil di Batalkan');
    if($user['user_level']==2){
      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
      redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
    }else{
      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
      redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
    }   
    }

    if($_GET['key'] === 'kode_anggaran'){
        $query  = "UPDATE verifikasi SET ";
        $query .= "{$_GET['key']} = 1";
        $query .= " WHERE id='{$pengajuan["id"]}'";
        $result = $db->query($query);
        $session->msg('s',' Berhasil di Proses');
        if($user['user_level']==2){
          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }    
        }
    
        if($_GET['key'] === 'bkode_anggaran'){
            $query  = "UPDATE verifikasi SET ";
            $query .= "kode_anggaran= 0";
            $query .= " WHERE id='{$pengajuan["id"]}'";
            $result = $db->query($query);
            $session->msg('s',' Berhasil di Batalkan');
            if($user['user_level']==2){
              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
              redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
            }else{
              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
              redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
            }    
            }
    
            if($_GET['key'] === 'nd_pengajuan'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "{$_GET['key']} = 1";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Proses');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                }else{
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                }    
                }  
            
            if($_GET['key'] === 'bnd_pengajuan'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "nd_pengajuan = 0";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Batalkan');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                }else{
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                }   
                }
            if($_GET['key'] === 'spp'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "spp = 1";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Proses');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                }else{
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                }    
                }
            if($_GET['key'] === 'bspp'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "spp = 0";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Batalkan');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }    
                }
            if($_GET['key'] === 'sptb'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "sptb = 1";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Proses');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }    
                }
            if($_GET['key'] === 'bsptb'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "sptb = 0";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Batalkan');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                }else{
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                }    
                }

            if($_GET['key'] === 'daftar_nominatif'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "daftar_nominatif = 1";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Proses');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                }else{
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                }   
                }
            if($_GET['key'] === 'bdaftar_nominatif'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "daftar_nominatif = 0";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Batalkan');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                }else{
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                }    
                }
            if($_GET['key'] === 'st'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "st = 1";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Proses');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }    
                }
            if($_GET['key'] === 'bst'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "st = 0";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Proses');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                }else{
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                }    
                }

            if($_GET['key'] === 'status_pengajuan'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "status_pengajuan = 1";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Proses');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                }else{
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                }    
                }
            if($_GET['key'] === 'bstatus_pengajuan'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "status_pengajuan = 0";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Proses');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                }else{
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                }    
                }

            if($_GET['key'] === 'sp2d'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "{$_GET['key']} = 1";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Proses');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }    
                }
            if($_GET['key'] === 'rincian'){
                $query  = "UPDATE verifikasi SET ";
                $query .= "{$_GET['key']} = 1";
                $query .= " WHERE id='{$pengajuan["id"]}'";
                $result = $db->query($query);
                $session->msg('s',' Berhasil di Proses');
                if($user['user_level']==2){
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                }else{
                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                }    
                }
                if($_GET['key'] === 'tanda_tiba'){
                    $query  = "UPDATE verifikasi SET ";
                    $query .= "{$_GET['key']} = 1";
                    $query .= " WHERE id='{$pengajuan["id"]}'";
                    $result = $db->query($query);
                    $session->msg('s',' Berhasil di Proses');
                    if($user['user_level']==2){
                      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }   
                    }
                    if($_GET['key'] === 'tiket_pesawat'){
                        $query  = "UPDATE verifikasi SET ";
                        $query .= "{$_GET['key']} = 1";
                        $query .= " WHERE id='{$pengajuan["id"]}'";
                        $result = $db->query($query);
                        $session->msg('s',' Berhasil di Proses');
                        if($user['user_level']==2){
                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                        }else{
                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                        }    
                        }
                        if($_GET['key'] === 'boardingpass'){
                            $query  = "UPDATE verifikasi SET ";
                            $query .= "{$_GET['key']} = 1";
                            $query .= " WHERE id='{$pengajuan["id"]}'";
                            $result = $db->query($query);
                            $session->msg('s',' Berhasil di Proses');
                            if($user['user_level']==2){
                              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }   
                            }
                            if($_GET['key'] === 'spd'){
                                $query  = "UPDATE verifikasi SET ";
                                $query .= "{$_GET['key']} = 1";
                                $query .= " WHERE id='{$pengajuan["id"]}'";
                                $result = $db->query($query);
                                $session->msg('s',' Berhasil di Proses');
                                if($user['user_level']==2){
                                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                }else{
                                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                }   
                                }
                                if($_GET['key'] === 'invoice_hotel'){
                                    $query  = "UPDATE verifikasi SET ";
                                    $query .= "{$_GET['key']} = 1";
                                    $query .= " WHERE id='{$pengajuan["id"]}'";
                                    $result = $db->query($query);
                                    $session->msg('s',' Berhasil di Proses');
                                    if($user['user_level']==2){
                                      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                      redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                    }else{
                                      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                      redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                    }   
                                    }
                                    if($_GET['key'] === 'lapgas'){
                                        $query  = "UPDATE verifikasi SET ";
                                        $query .= "{$_GET['key']} = 1";
                                        $query .= " WHERE id='{$pengajuan["id"]}'";
                                        $result = $db->query($query);
                                        $session->msg('s',' Berhasil di Proses');
                                        if($user['user_level']==2){
                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                        }else{
                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                        }    
                                        }
                                        if($_GET['key'] === 'undangan'){
                                            $query  = "UPDATE verifikasi SET ";
                                            $query .= "{$_GET['key']} = 1";
                                            $query .= " WHERE id='{$pengajuan["id"]}'";
                                            $result = $db->query($query);
                                            $session->msg('s',' Berhasil di Proses');
                                            if($user['user_level']==2){
                                              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                              redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                            }else{
                                              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                              redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                            }   
                                            }
                                            if($_GET['key'] === 'pengeluaran_rill'){
                                                $query  = "UPDATE verifikasi SET ";
                                                $query .= "{$_GET['key']} = 1";
                                                $query .= " WHERE id='{$pengajuan["id"]}'";
                                                $result = $db->query($query);
                                                $session->msg('s',' Berhasil di Proses');
                                                if($user['user_level']==2){
                                                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                                }else{
                                                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                                }   
                                                }
                                                if($_GET['key'] === 'sp_setneg'){
                                                    $query  = "UPDATE verifikasi SET ";
                                                    $query .= "{$_GET['key']} = 1";
                                                    $query .= " WHERE id='{$pengajuan["id"]}'";
                                                    $result = $db->query($query);
                                                    $session->msg('s',' Berhasil di Proses');
                                                    if($user['user_level']==2){
                                                      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }  
                                                    }
                                                    if($_GET['key'] === 'visa_paspor'){
                                                        $query  = "UPDATE verifikasi SET ";
                                                        $query .= "{$_GET['key']} = 1";
                                                        $query .= " WHERE id='{$pengajuan["id"]}'";
                                                        $result = $db->query($query);
                                                        $session->msg('s',' Berhasil di Proses');
                                                        if($user['user_level']==2){
                                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }   
                                                    }
                                    //batal verif

                                    if($_GET['key'] === 'bsp_setneg'){
                                        $query  = "UPDATE verifikasi SET ";
                                        $query .= "sp_setneg = 0";
                                        $query .= " WHERE id='{$pengajuan["id"]}'";
                                        $result = $db->query($query);
                                        $session->msg('s',' Berhasil di Proses');
                                        if($user['user_level']==2){
                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                        }else{
                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                        } 
                                        }
                                    if($_GET['key'] === 'bsp2d'){
                                        $query  = "UPDATE verifikasi SET ";
                                        $query .= "sp2d = 0";
                                        $query .= " WHERE id='{$pengajuan["id"]}'";
                                        $result = $db->query($query);
                                        $session->msg('s',' Berhasil di Proses');
                                        if($user['user_level']==2){
                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                        }else{
                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                        } 
                                        }
                                    if($_GET['key'] === 'brincian'){
                                        $query  = "UPDATE verifikasi SET ";
                                        $query .= "rincian = 0";
                                        $query .= " WHERE id='{$pengajuan["id"]}'";
                                        $result = $db->query($query);
                                        $session->msg('s',' Berhasil di Proses');
                                        if($user['user_level']==2){
                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                        }else{
                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                        }   
                                        }
                                        if($_GET['key'] === 'btanda_tiba'){
                                            $query  = "UPDATE verifikasi SET ";
                                            $query .= "tanda_tiba = 0";
                                            $query .= " WHERE id='{$pengajuan["id"]}'";
                                            $result = $db->query($query);
                                            $session->msg('s',' Berhasil di Proses');
                                            if($user['user_level']==2){
                                              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                              redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                            }else{
                                              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                              redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                            }  
                                            }
                                            if($_GET['key'] === 'btiket_pesawat'){
                                                $query  = "UPDATE verifikasi SET ";
                                                $query .= "tiket_pesawat = 0";
                                                $query .= " WHERE id='{$pengajuan["id"]}'";
                                                $result = $db->query($query);
                                                $session->msg('s',' Berhasil di Proses');
                                                if($user['user_level']==2){
                                                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                                }else{
                                                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                                  redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                                } 
                                                }
                                                if($_GET['key'] === 'bboardingpass'){
                                                    $query  = "UPDATE verifikasi SET ";
                                                    $query .= "boardingpass = 0";
                                                    $query .= " WHERE id='{$pengajuan["id"]}'";
                                                    $result = $db->query($query);
                                                    $session->msg('s',' Berhasil di Proses');
                                                    if($user['user_level']==2){
                                                      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                                      redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                                    }else{
                                                      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                                      redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                                    }   
                                                    }
                                                    if($_GET['key'] === 'bspd'){
                                                        $query  = "UPDATE verifikasi SET ";
                                                        $query .= "spd = 0";
                                                        $query .= " WHERE id='{$pengajuan["id"]}'";
                                                        $result = $db->query($query);
                                                        $session->msg('s',' Berhasil di Proses');
                                                        if($user['user_level']==2){
                                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }    
                                                        }
                                                        if($_GET['key'] === 'binvoice_hotel'){
                                                            $query  = "UPDATE verifikasi SET ";
                                                            $query .= "invoice_hotel = 0";
                                                            $query .= " WHERE id='{$pengajuan["id"]}'";
                                                            $result = $db->query($query);
                                                            $session->msg('s',' Berhasil di Proses');
                                                            if($user['user_level']==2){
                                                              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                                              redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                                            }else{
                                                              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                                              redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                                            }    
                                                            }
                                                            if($_GET['key'] === 'blapgas'){
                                                                $query  = "UPDATE verifikasi SET ";
                                                                $query .= "lapgas = 0";
                                                                $query .= " WHERE id='{$pengajuan["id"]}'";
                                                                $result = $db->query($query);
                                                                $session->msg('s',' Berhasil di Proses');
                                                                if($user['user_level']==2){
                                                                  $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
      }else{
        $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
        redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
      }    
                                                                }
                                                                if($_GET['key'] === 'bundangan'){
                                                                    $query  = "UPDATE verifikasi SET ";
                                                                    $query .= "undangan = 0";
                                                                    $query .= " WHERE id='{$pengajuan["id"]}'";
                                                                    $result = $db->query($query);
                                                                    $session->msg('s',' Berhasil di Proses');
                                                                    if($user['user_level']==2){
                                                                      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                                                      redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                                                    }else{
                                                                      $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                                                      redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                                                    }    
                                                                    }
                                                                    if($_GET['key'] === 'bpengeluaran_rill'){
                                                                        $query  = "UPDATE verifikasi SET ";
                                                                        $query .= "pengeluaran_rill = 0";
                                                                        $query .= " WHERE id='{$pengajuan["id"]}'";
                                                                        $result = $db->query($query);
                                                                        $session->msg('s',' Berhasil di Proses');
                                                                        if($user['user_level']==2){
                                                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                                                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                                                        }else{
                                                                          $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                                                          redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                                                        }   
                                                                        }
                                                                        if($_GET['key'] === 'bvisa_paspor'){
                                                                            $query  = "UPDATE verifikasi SET ";
                                                                            $query .= "visa_paspor = 0";
                                                                            $query .= " WHERE id='{$pengajuan["id"]}'";
                                                                            $result = $db->query($query);
                                                                            $session->msg('s',' Berhasil di Proses');
                                                                            if($user['user_level']==2){
                                                                              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']); 
                                                                              redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan']);
                                                                            }else{
                                                                              $jenis= find_by_id('jenis_pengajuan',$jenis_v['id_jenis_pengajuan']);
                                                                              redirect($jenis['link'].'.php?id='.$pengajuan['id_pengajuan'], false);
                                                                            }    
                                                                            }

 
?>