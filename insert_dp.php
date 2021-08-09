<?php 
    $sql="INSERT pengajuan (id,SPM,jenis)values(null,".$_GET['spm'].",".$_GET['jenis'].")";
    echo $sql;

?>