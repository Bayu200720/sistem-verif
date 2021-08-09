<?php 
	require_once('includes/load.php');
	require './utils/zipfile.php';
	error_reporting(0);
	// Enter the name of directory 
	$pathPr 	= "uploads/products/";  
	$pathSPM 	= "uploads/spm/";  
	$pathSP2D 	= "uploads/sp2d/";  
	$pathPJ 	= "uploads/pertanggungjawaban/";
	$pathK 		= "uploads/kekurangan/";
	$pathAdkSpp = "uploads/adk/";
	
	$zipfiles = [];
	$isDownload = true;
	$zipNames = null;
	$fileNameKey = microtime(true);

	if(!empty($_GET['spm'])){
		$user 	= find_by_id('users',$_SESSION['user_id']);
		$satker = find_all_global('satker',$user['id_satker'], 'id');
		$sales 	= find_nodin_j_pengajuan_spm($_GET['spm']);
		$zipNames = "Dokumen Rampung SPM ".$_GET['spm']." Tgl. ".$fileNameKey.".zip";
		array_push($zipfiles, [
			'zipName' => $zipNames,
			'zips' => []
		]);
		if(!empty($sales[0]['upload']) && file_exists(ROOTDIR.$pathPr.$sales[0]['upload'])){
			$arrFileExplode = explode('.', $sales[0]['upload']);
			$fileExt = end($arrFileExplode);
			array_push($zipfiles[0]['zips'], [
				'origin' => ROOTDIR.$pathPr.$sales[0]['upload'],
				'rename' => 'Dokumen Pengajuan '." Tgl. ".strtotime(date('d-m-Y')).'.'.$fileExt
			]);
		}
	
		if(!empty($sales[0]['file_spm']) && file_exists(ROOTDIR.$pathSPM.$sales[0]['file_spm'])){
			array_push($zipfiles[0]['zips'], [
				'origin' => ROOTDIR.$pathSPM.$sales[0]['file_spm'],
				'rename' => 'Dokumen SPM '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'
			]);
		}
		
		if(!empty($sales[0]['file_sp2d']) && file_exists(ROOTDIR.$pathSP2D.$sales[0]['file_sp2d'])){
			array_push($zipfiles[0]['zips'], [
				'origin' => ROOTDIR.$pathSP2D.$sales[0]['file_sp2d'],
				'rename' => 'Dokumen SP2D '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'
			]);
		}
		if(!empty($sales[0]['upload_pertanggungjawaban']) && file_exists(ROOTDIR.$pathPJ.$sales[0]['upload_pertanggungjawaban'])){
			array_push($zipfiles[0]['zips'], [
				'origin' => ROOTDIR.$pathPJ.$sales[0]['upload_pertanggungjawaban'],
				'rename' => 'Dokumen Pertanggungjawaban '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'
			]);
		}
		if(!empty($sales[0]['upload_kekurangan']) && file_exists(ROOTDIR.$pathK.$sales[0]['upload_kekurangan'])){
			array_push($zipfiles[0]['zips'], [
				'origin' => ROOTDIR.$pathK.$sales[0]['upload_kekurangan'],
				'rename' => 'Dokumen Kekurangan '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'
			]);
		}
		if(!empty($sales[0]['upload_adk']) && file_exists(ROOTDIR.$pathAdkSpp.$sales[0]['upload_adk'])){
			$arrFileExplode = explode('.', $sales[0]['upload_adk']);
			$fileExt = end($arrFileExplode);
			array_push($zipfiles[0]['zips'], [
				'origin' => ROOTDIR.$pathAdkSpp.$sales[0]['upload_adk'],
				'rename' => 'Dokumen ADK SPP '." Tgl. ".strtotime(date('d-m-Y')).'.'.$fileExt
			]);
		}
		if(!empty($sales[0]['upload_adk_spm']) && file_exists(ROOTDIR.$pathAdkSpp.$sales[0]['upload_adk_spm'])){
			$arrFileExplode = explode('.', $sales[0]['upload_adk_spm']);
			$fileExt = end($arrFileExplode);
			array_push($zipfiles[0]['zips'], [
				'origin' => ROOTDIR.$pathAdkSpp.$sales[0]['upload_adk_spm'],
				'rename' => 'Dokumen ADK SPM '." Tgl. ".strtotime(date('d-m-Y')).'.'.$fileExt
			]);
		}
		createZipFile($zipfiles, $zipNames, false, true, $_GET['spm']);
	} elseif (empty($_GET['spm'])) {
		$arr = explode(',', $_GET['arr']);
		$zipNames = "All Dokumen Rampung SPM Tgl. ".$fileNameKey.".zip";

		foreach ($arr as $key => $value) {
			$sales 	= find_nodin_j_pengajuan_spm($value);
			dd($sales);
			if (count($sales[0]) > 0) {
				$zipcreated = "Dokumen Rampung SPM ".$value." Tgl. ".$fileNameKey.".zip"; 

				array_push($zipfiles, [
					'zipName' => $zipcreated,
					'zips' => []
				]);

				if(!empty($sales[0]['upload']) && file_exists(ROOTDIR.$pathPr.$sales[0]['upload'])){
					$arrFileExplode = explode('.', $sales[0]['upload']);
					$fileExt = end($arrFileExplode);
					array_push($zipfiles[$key]['zips'], [
						'origin' => ROOTDIR.$pathPr.$sales[0]['upload'],
						'rename' => 'Dokumen Pengajuan '." Tgl. ".strtotime(date('d-m-Y')).'.'.$fileExt
					]);
				}
			
				if(!empty($sales[0]['file_spm']) && file_exists(ROOTDIR.$pathSPM.$sales[0]['file_spm'])){
					$arrFileExplode = explode('.', $sales[0]['file_spm']);
					$fileExt = end($arrFileExplode);
					array_push($zipfiles[$key]['zips'], [
						'origin' => ROOTDIR.$pathSPM.$sales[0]['file_spm'],
						'rename' => 'Dokumen SPM '." Tgl. ".strtotime(date('d-m-Y')).'.'.$fileExt
					]);
				}
				
				if(!empty($sales[0]['file_sp2d']) && file_exists(ROOTDIR.$pathSP2D.$sales[0]['file_sp2d'])){
					$arrFileExplode = explode('.', $sales[0]['file_sp2d']);
					$fileExt = end($arrFileExplode);
					array_push($zipfiles[$key]['zips'], [
						'origin' => ROOTDIR.$pathSP2D.$sales[0]['file_sp2d'],
						'rename' => 'Dokumen SP2D '." Tgl. ".strtotime(date('d-m-Y')).'.'.$fileExt
					]);
				}
				if(!empty($sales[0]['upload_pertanggungjawaban']) && file_exists(ROOTDIR.$pathPJ.$sales[0]['upload_pertanggungjawaban'])){
					$arrFileExplode = explode('.', $sales[0]['upload_pertanggungjawaban']);
					$fileExt = end($arrFileExplode);
					array_push($zipfiles[$key]['zips'], [
						'origin' => ROOTDIR.$pathPJ.$sales[0]['upload_pertanggungjawaban'],
						'rename' => 'Dokumen Pertanggungjawaban '." Tgl. ".strtotime(date('d-m-Y')).'.'.$fileExt
					]);
				}
				if(!empty($sales[0]['upload_kekurangan']) && file_exists(ROOTDIR.$pathK.$sales[0]['upload_kekurangan'])){
					$arrFileExplode = explode('.', $sales[0]['upload_kekurangan']);
					$fileExt = end($arrFileExplode);
					array_push($zipfiles[$key]['zips'], [
						'origin' => ROOTDIR.$pathK.$sales[0]['upload_kekurangan'],
						'rename' => 'Dokumen Kekurangan '." Tgl. ".strtotime(date('d-m-Y')).'.'.$fileExt
					]);
				}
				if(!empty($sales[0]['upload_adk']) && file_exists(ROOTDIR.$pathAdkSpp.$sales[0]['upload_adk'])){
					$arrFileExplode = explode('.', $sales[0]['upload_adk']);
					$fileExt = end($arrFileExplode);
					array_push($zipfiles[0]['zips'], [
						'origin' => ROOTDIR.$pathAdkSpp.$sales[0]['upload_adk'],
						'rename' => 'Dokumen ADK SPP '." Tgl. ".strtotime(date('d-m-Y')).'.'.$fileExt
					]);
				}
				if(!empty($sales[0]['upload_adk_spm']) && file_exists(ROOTDIR.$pathAdkSpp.$sales[0]['upload_adk_spm'])){
					$arrFileExplode = explode('.', $sales[0]['upload_adk_spm']);
					$fileExt = end($arrFileExplode);
					array_push($zipfiles[0]['zips'], [
						'origin' => ROOTDIR.$pathAdkSpp.$sales[0]['upload_adk_spm'],
						'rename' => 'Dokumen ADK SPM '." Tgl. ".strtotime(date('d-m-Y')).'.'.$fileExt
					]);
				}
			}
		}
		createZipFile($zipfiles, $zipNames, true, true);
	}