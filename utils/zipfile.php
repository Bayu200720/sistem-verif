<?php

if (!function_exists('createZipFile')) {
    function createZipFile($zipfiles, $zipNames = null, $isMultiple = false, $isDownload = false, $docId = 0) {
        $zipFile = new \PhpZip\ZipFile();
        $matcher = $zipFile->matcher();
        $outputDir = ROOTDIR.'uploads/zip';
        $fileSavePath = null;
        $childZips = [];
        try {
            if (!file_exists($outputDir)) {
                @mkdir($outputDir, 0755, true);
            }
            foreach ($zipfiles as $key => $file) {
                foreach ($file['zips'] as $zipFilePath) {
                    $zipFile->addFile($zipFilePath['origin'], $zipFilePath['rename']);
                }
                $fileSavePath = $outputDir.'/'.$file['zipName'];
                $zipFile->saveAsFile($fileSavePath);
                $zipOutputCountFile = $zipFile->count();
                if ($zipOutputCountFile > 0) {
                    $zipFile->close();
                    array_push($childZips, [
                        $file['zipName'] => $fileSavePath
                    ]);
                }
            }
    
            if ($isMultiple && count($childZips) > 0) {
                $fileSavePath = $outputDir.'/'.$zipNames;
                foreach ($childZips as $childZip) {
                    $zipFile->addFile(array_values($childZip)[0], array_keys($childZip)[0]);
                }
                $zipFile->saveAsFile($fileSavePath);
                $zipFile->close();
            }

            if ($isDownload) {
                header('Content-Type: application/zip');
                header('Content-disposition: attachment; filename='.$zipNames);
                header('Content-Length: ' . filesize($fileSavePath));
                readfile($fileSavePath);
            } else {
                return $fileSavePath;
            }
        } catch(\PhpZip\Exception\ZipException $e){
            dd($e);
        } finally{
            $zipFile->close();
        }
    }
}
