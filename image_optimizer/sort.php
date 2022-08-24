<?php
// include_once '../config/importer.php';

$source = "../Downloads";
$destination = "../Image";
$processPath = "../ffmpeg";
// $dataProviderObject = new DataProvider();

// $sku = $dataProviderObject->getSku();

$image = new ImageProcessor($source, $destination, $processPath);

$image->extractImage();
$image->optimizeImage();

shell_exec("nautilus --browser $destination");
// var_dump($image->getImageCount());
