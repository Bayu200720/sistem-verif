<?php

class  Media {

  public $imageInfo;
  public $fileName;
  public $fileType;
  public $fileTempPath;
  public $fileAdkSpm;
  //Set destination for upload
  public $spmPath = SITE_ROOT.DS.'..'.DS.'uploads/spm';
  public $userPath = SITE_ROOT.DS.'..'.DS.'uploads/users';
  public $productPath = SITE_ROOT.DS.'..'.DS.'uploads/products';
  public $pertanggungjawabanPath = SITE_ROOT.DS.'..'.DS.'uploads/pertanggungjawaban';
  public $sp2d = SITE_ROOT.DS.'..'.DS.'uploads/sp2d';
  public $adk = SITE_ROOT.DS.'..'.DS.'uploads/adk';
  public $kekuranganPath = SITE_ROOT.DS.'..'.DS.'uploads/kekurangan';
  public $Adk_spm = SITE_ROOT.DS.'..'.DS.'uploads/adk_spm';
  public $sptjb_pum = SITE_ROOT.DS.'..'.DS.'uploads/sptjb_pum';
  



  public $errors = array();
  public $upload_errors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.'
  );
  public$upload_extensions = array(
   'pdf',
   'doc',
   'spp',
   'rar',
   'spm'
  );
  public function file_ext($filename){
     $ext = strtolower(substr( $filename, strrpos( $filename, '.' ) + 1 ) );
     if(in_array($ext, $this->upload_extensions)){
       return true;
     }
   }

  public function upload($file,$spm)
  {
    if(!$file || empty($file) || !is_array($file)):
      $this->errors[] = "No file was uploaded.";
      return false;
    elseif($file['error'] != 0):
      $this->errors[] = $this->upload_errors[$file['error']];
      return false;
    elseif(!$this->file_ext($file['name'])):
      $this->errors[] = 'File not right format ';
      return false;
    else:
      $this->imageInfo = getimagesize($file['tmp_name']);
      $h= explode(".",$_FILES['file_upload']['name']);
      date_default_timezone_set('Asia/Jakarta');
      $waktu= date('d-m-Y-His');
      $nama = $spm."-".$waktu."-".$h[0].".".$h[1];
      $this->fileName = $nama;  
      $this->fileType  = $this->imageInfo['mime'];
      $this->fileTempPath = $file['tmp_name'];
     return true;
    endif;

  }

 public function process(){

    if(!empty($this->errors)):
      return false;
    elseif(empty($this->fileName) || empty($this->fileTempPath)):
      $this->errors[] = "The file location was not available.";
      return false;
    elseif(!is_writable($this->productPath)):
      $this->errors[] = $this->productPath." Must be writable!!!.";
      return false;
    elseif(file_exists($this->productPath."/".$this->fileName)):
      $this->errors[] = "The file {$this->fileName} already exists.";
      return false;
    else:
     return true;
    endif;
 }
 /*--------------------------------------------------------------*/
 /* Function for Process media file
 /*--------------------------------------------------------------*/
  public function process_media($id){
    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "The file location was not available.";
        return false;
      }

    if(!is_writable($this->productPath)){
        $this->errors[] = $this->productPath." Must be writable!!!.";
        return false;
      }

    if(file_exists($this->productPath."/".$this->fileName)){
      $this->errors[] = "The file {$this->fileName} already exists.";
      return false;
    }
    //$h =$this->spmPath.'/'.$this->fileName; var_dump($h); exit();// echo 
    if(move_uploaded_file($this->fileTempPath,$this->productPath.'/'.$this->fileName))
    {

      if($this->insert_media($id)){
        unset($this->fileTempPath);
        return true;
      }

    } else {

      $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
      return false;
    }

  }

  public function process_pum($id){
    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "The file location was not available.";
        return false;
      }

    if(!is_writable($this->sptjb_pum)){
        $this->errors[] = $this->sptjb_pum." Must be writable!!!.";
        return false;
      }

    if(file_exists($this->sptjb_pum."/".$this->fileName)){
      $this->errors[] = "The file {$this->fileName} already exists.";
      return false;
    }
    //$h =$this->spmPath.'/'.$this->fileName; var_dump($h); exit();// echo 
    if(move_uploaded_file($this->fileTempPath,$this->sptjb_pum.'/'.$this->fileName))
    {

      if($this->insert_pum($id)){
        unset($this->fileTempPath);
        return true;
      }

    } else {

      $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
      return false;
    }

  }

  //function for process upload pertanggungjawaban
  public function process_pertanggungjawaban($id){
    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "The file location was not available.";
        return false;
      }

    if(!is_writable($this->productPath)){
        $this->errors[] = $this->pertanggungjawabanPath." Must be writable!!!.";
        return false;
      }

    if(file_exists($this->pertanggungjawabanPath."/".$this->fileName)){
      $this->errors[] = "The file {$this->fileName} already exists.";
      return false;
    }
    //$h =$this->spmPath.'/'.$this->fileName; var_dump($h); exit();// echo 
    if(move_uploaded_file($this->fileTempPath,$this->pertanggungjawabanPath.'/'.$this->fileName))
    {

      if($this->insert_pj($id)){
        unset($this->fileTempPath);
        return true;
      }

    } else {

      $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
      return false;
    }

  }
  
    //function for process upload kekurangan
  public function process_kekurangan($id){
    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "The file location was not available.";
        return false;
      }

    if(!is_writable($this->kekuranganPath)){
        $this->errors[] = $this->kekuranganPath." Must be writable!!!.";
        return false;
      }

    if(file_exists($this->kekuranganPath."/".$this->fileName)){
      $this->errors[] = "The file {$this->fileName} already exists.";
      return false;
    }
    
    if(move_uploaded_file($this->fileTempPath,$this->kekuranganPath.'/'.$this->fileName))
    {

      if($this->insert_kk($id)){
        unset($this->fileTempPath);
        return true;
      }

    } else {

      $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
      return false;
    }

  }

    //function for process upload adk
    public function process_adk($id){
      if(!empty($this->errors)){
          return false;
        }
      if(empty($this->fileName) || empty($this->fileTempPath)){
          $this->errors[] = "The file location was not available.";
          return false;
        }
  
      if(!is_writable($this->productPath)){
          $this->errors[] = $this->adk." Must be writable!!!.";
          return false;
        }
  
      if(file_exists($this->adk."/".$this->fileName)){
        $this->errors[] = "The file {$this->fileName} already exists.";
        return false;
      }
      //$h =$this->spmPath.'/'.$this->fileName; var_dump($h); exit();// echo 
      if(move_uploaded_file($this->fileTempPath,$this->adk.'/'.$this->fileName))
      {
  
        if($this->insert_adk($id)){
          unset($this->fileTempPath);
          return true;
        }
  
      } else {
  
        $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
        return false;
      }
  
    }

    public function process_adk_spm($id){
      if(!empty($this->errors)){
          return false;
        }
      if(empty($this->fileName) || empty($this->fileTempPath)){
          $this->errors[] = "The file location was not available.";
          return false;
        }
  
      if(!is_writable($this->Adk_spm)){
          $this->errors[] = $this->$Adk_spm." Must be writable!!!.";
          return false;
        }
  
      if(file_exists($this->Adk_spm."/".$this->fileName)){
        $this->errors[] = "The file {$this->fileName} already exists.";
        return false;
      }
      if(move_uploaded_file($this->fileTempPath,$this->Adk_spm.'/'.$this->fileName))
      {
  
        if($this->insert_adk_spm($id)){
          unset($this->fileTempPath);
          return true;
        }
  
      } else {
  
        $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
        return false;
      }
  
    }

  //process sp2d
  
  public function process_sp2d($id){
    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "The file location was not available.";
        return false;
      }

    if(!is_writable($this->sp2d)){
        $this->errors[] = $this->sp2d." Must be writable ok!!!.";
        return false;
      }

    if(file_exists($this->sp2d."/".$this->fileName)){
      $this->errors[] = "The file {$this->fileName} already exists.";
      return false;
    }
    //$h =$this->spmPath.'/'.$this->fileName; var_dump($h); exit();// echo 
    if(move_uploaded_file($this->fileTempPath,$this->sp2d.'/'.$this->fileName))
    {

      if($this->insert_sp2d($id)){
        unset($this->fileTempPath);
        return true;
      }

    } else {

      $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder ok.";
      return false;
    }

  }





   /*--------------------------------------------------------------*/
 /* Function for Process spm file
 /*--------------------------------------------------------------*/
 public function process_spm($id){
  if(!empty($this->errors)){
      return false;
    }
  if(empty($this->fileName) || empty($this->fileTempPath)){
      $this->errors[] = "The file location was not available.";
      return false;
    }

  if(!is_writable($this->spmPath)){
      $this->errors[] = $this->spmPath." Must be writable!!!.";
      return false;
    }

  if(file_exists($this->spmPath."/".$this->fileName)){
    $this->errors[] = "The file {$this->fileName} already exists.";
    return false;
  }
  
  if(move_uploaded_file($this->fileTempPath,$this->spmPath.'/'.$this->fileName))
  {

    if($this->insert_spm($id)){
      unset($this->fileTempPath);
      return true;
    }

  } else {


    $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
    return false;
  }

}
  /*--------------------------------------------------------------*/
  /* Function for Process user image
  /*--------------------------------------------------------------*/
 public function process_user($id){

    if(!empty($this->errors)){
        return false;
      }
    if(empty($this->fileName) || empty($this->fileTempPath)){
        $this->errors[] = "The file location was not available.";
        return false;
      }
    if(!is_writable($this->userPath)){
        $this->errors[] = $this->userPath." Must be writable!!!.";
        return false;
      }
    if(!$id){
      $this->errors[] = " Missing user id.";
      return false;
    }
    $ext = explode(".",$this->fileName);
    $new_name = randString(8).$id.'.' . end($ext);
    $this->fileName = $new_name;
    if($this->user_image_destroy($id))
    {
    if(move_uploaded_file($this->fileTempPath,$this->userPath.'/'.$this->fileName))
       {

         if($this->update_userImg($id)){
           unset($this->fileTempPath);
           return true;
         }

       } else {
         $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
         return false;
       }
    }
 }
 /*--------------------------------------------------------------*/
 /* Function for Update user image
 /*--------------------------------------------------------------*/
  private function update_userImg($id){
     global $db;
      $sql = "UPDATE users SET";
      $sql .=" image='{$db->escape($this->fileName)}'";
      $sql .=" WHERE id='{$db->escape($id)}'";
      $result = $db->query($sql);
      return ($result && $db->affected_rows() === 1 ? true : false);

   }
 /*--------------------------------------------------------------*/
 /* Function for Delete old image
 /*--------------------------------------------------------------*/
  public function user_image_destroy($id){
     $image = find_by_id('users',$id);
     if($image['image'] === 'no_image.jpg')
     {
       return true;
     } else {
       unlink($this->userPath.'/'.$image['image']);
       return true;
     }

   }
/*--------------------------------------------------------------*/
/* Function for insert media image
/*--------------------------------------------------------------*/
  private function insert_media($id){

         global $db;
         $sql  = "UPDATE pengajuan SET upload ='{$db->escape($this->fileName)}' WHERE id= '{$db->escape($id)}'";
       return ($db->query($sql) ? true : false);

  }

  private function insert_pum($id){

    global $db;
    $sql  = "UPDATE detail_pengajuan SET file_pj ='{$db->escape($this->fileName)}' WHERE id= '{$db->escape($id)}'";
  return ($db->query($sql) ? true : false);

}


  /*--------------------------------------------------------------*/
/* Function for insert sp2d
/*--------------------------------------------------------------*/
private function insert_sp2d($id){

  global $db;
  $sql  = "UPDATE pengajuan SET file_sp2d ='{$db->escape($this->fileName)}' WHERE id= '{$db->escape($id)}'";
return ($db->query($sql) ? true : false);

}
  
    /*--------------------------------------------------------------*/
/* Function for insert kekurangan
/*--------------------------------------------------------------*/
private function insert_kk($id){

  global $db;
  $sql  = "UPDATE pengajuan SET upload_kekurangan ='{$db->escape($this->fileName)}' WHERE id= '{$db->escape($id)}'";
return ($db->query($sql) ? true : false);

}


  /*--------------------------------------------------------------*/
/* Function for insert adk spp
/*--------------------------------------------------------------*/
private function insert_adk($id){

  global $db;
  $sql  = "UPDATE pengajuan SET upload_adk ='{$db->escape($this->fileName)}' WHERE id= '{$db->escape($id)}'";
return ($db->query($sql) ? true : false);

}

private function insert_adk_spm($id){

  global $db;
  $sql  = "UPDATE pengajuan SET upload_adk_spm ='{$db->escape($this->fileName)}' WHERE id= '{$db->escape($id)}'";
return ($db->query($sql) ? true : false);

}

  /*--------------------------------------------------------------*/
/* Function for insert berkas pj
/*--------------------------------------------------------------*/
private function insert_pj($id){

  global $db;
  $sql  = "UPDATE pengajuan SET upload_pertanggungjawaban ='{$db->escape($this->fileName)}' WHERE id= '{$db->escape($id)}'";
return ($db->query($sql) ? true : false);

}
  /*--------------------------------------------------------------*/
/* Function for insert File SPM
/*--------------------------------------------------------------*/
private function insert_spm($id){

  global $db;
  $sql  = "UPDATE pengajuan SET file_spm ='{$db->escape($this->fileName)}' WHERE id= '{$db->escape($id)}'";
return ($db->query($sql) ? true : false);

}
/*--------------------------------------------------------------*/
/* Function for Delete media by id
/*--------------------------------------------------------------*/
   public function media_destroy($id,$file_name){
     $this->fileName = $file_name;
     if(empty($this->fileName)){
         $this->errors[] = "The Photo file Name missing.";
         return false;
       }
     if(!$id){
       $this->errors[] = "Missing Photo id.";
       return false;
     }
     if(delete_by_id('media',$id)){
         unlink($this->productPath.'/'.$this->fileName);
         return true;
     } else {
       $this->error[] = "Photo deletion failed Or Missing Prm.";
       return false;
     }

   }



}


?>
