<?php
  $page_title = 'Detail BKU';
  require_once('includes/load.php');
   //page_require_level(3);
?>


<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-heading clearfix">
            <span class="glyphicon "></span>
            <span>SPTB</span>
          </div>
        </div>
        <div class="panel-body" style="width:100%;">
          <div class="row" style="width:100%; margin-left:2px">

                <table id="tabel" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center" >#</th>
                        <th class="text-center" >No SPTJB-SPM </th>
                        <th class="text-center" > Jumlah </th>
                    </tr>
                    </thead>
                <tbody>
                    <?php
                        $sales= find_sptb_tahun(2021,$_GET['id']);
                      
                    $tot1=0; foreach ($sales as $sale):?>
                    <tr>
                      <td class="text-center"><?php echo count_id();?></td>
                      <td class="text-center" >
                      <?php echo $sale['SPM'];?>-<?php echo $sale['no_sptjb'];?>
                      </td>
                      <td class="text-center">    
                          <?php echo rupiah($sale['nominal'])?>
                      </td>
                    </tr>
                    <?php $tot1+=$sale['nominal']; endforeach;?>
                </tbody>
                  <tr>
                        <th class="text-center">#</th>
                        <th class="text-center" > </th>
                        <th class="text-center"><?=rupiah($tot1);?></th> 
                  </tr>
                  
                </table>
                    
          </div>
        </div>
      </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <span class="glyphicon glyphicon-edit"></span>
        <span>Pencaitan</span>
      </div>
      <div class="panel-body" style="width:100%">
        <div class="row" style="width:100%; margin-left:2px">
            <table id="tabel" class="table table-bordered table-striped" >
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tanggal Pencairan </th>
                            <th class="text-center"> Jumlah </th>
                            <th class="text-center">Tanggal Pengembalian </th>
                            <th class="text-center"> Jumlah </th>
                        </tr>
                        </thead>
                    <tbody>
                        <?php
                            $pencairan= find_pencairan_tahun(2021,$_GET['id']);
                        
                        $tot=0; $tot_pengmbalian=0; foreach ($pencairan as $sale):?>
                        <tr>
                            <td class="text-center"><?php echo $sale['spm'];;?></td>
                            <td class="text-center" >
                                <?php echo $sale['tanggal'];?>
                            </td>
                            <td class="text-center">    
                                <?php echo rupiah($sale['nominal'])?>
                            </td>
                            <td class="text-center" >
                                <?php echo $sale['tanggal_pengembalian'];?>
                            </td>
                            <td class="text-center">    
                                <?php echo rupiah($sale['pengembalian'])?>
                            </td>
                        </tr>
                        <?php $tot+=$sale['nominal']; $tot_pengmbalian+=$sale['pengembalian']; endforeach;?>
                    </tbody>
                    <tr>
                            <th class="text-center">#</th>
                            <th class="text-center" > </th>
                            <th class="text-center"><?=rupiah($tot);?></th> 
                            <th class="text-center" > </th>
                            <th class="text-center"><?=rupiah($tot_pengmbalian);?></th>
                    </tr>
                    <tr>
                            <th class="text-center"></th>
                            <th class="text-center" > Saldo Akhir</th>
                            <th class="text-center"><?php $uang=$tot-$tot_pengmbalian; $saldo=$uang-$tot1;?></th> 
                            <th class="text-center" > </th>
                            <th class="text-center"><?=rupiah($saldo);?></th>
                    </tr>
                </table>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include_once('layouts/footer.php'); ?>
