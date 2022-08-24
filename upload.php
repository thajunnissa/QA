<?php
include_once './config/importer.php';

$dataProviderObject = new DataProvider();
$initializer = new Initializer();
$payload = new Payload();
$upload = new Uploader(env('ROOT_URL'), env('TOKEN_TAIL'), env('USERNAME'), env('PASSWORD'));

$year = date("Y");
$month = date("m");
$day = date("d");
$directory = './logs/';
$filename = "$directory$day-$month-$year";
//echo "\t\tConverting xlsm file to csv \n\n";
//shell_exec("cd ClothingSheet; sh tocsv.sh");
//echo "\t\tConverted to csv \n\n";

//$csvFiles = glob('./ClothingSheet/*.csv');
//foreach ($csvFiles as $filePath) {
   // $csvFileName = basename($filePath);

    //rename($filePath, "./import/" . $csvFileName);
//}

$files = glob("./import/*.csv");
foreach ($files as $file) {
    $fileReference[] = basename($file);

    $dataProviderObject->setDataFrom($file);
}
$sku = $dataProviderObject->getSku();

$fileReference = implode(',', $fileReference);
$upload->logs($filename, 'The log has following batches -> ' . $fileReference . "\t");
$data = $dataProviderObject->getData();

$initializer->sanitizeAndSetUploadData($data);
$uploadData = $initializer->getUploadData();

$payload->generatePayloads($uploadData);
$jsonData = $payload->getPayload();



//from here after the upload function starts
 $count = count($jsonData);
$index = 1;

 echo "\t\t\t\tprocessing:- $count products\n\n\n";
foreach ($jsonData as $key => $value) {

   // debugUploadJson(json_decode($value['payload']),"payload$index",$projectRootPAth);
    $upload->uploadProduct($value['payload'], $filename, $index, $value['sku']);
    $index++;
     show_status($index, $count);
}
echo "\n\nAre you Sure Images are Uploaded For Current Products?  Type 'yes' to Enable Products: \n";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
if (trim($line) != 'yes') {
    echo "ABORTING!\n";
    exit;
}
fclose($handle);
echo "\n";
echo "Enabling Products...\n";
foreach ($jsonData as $sku) {
    $upload->enableProducts($sku['sku']);

}



// $searchTest = new SearchAndSet();

// $id = $searchTest->searchAndSetAttributeId('Vintage','product_label');

// echo $id . "\n";
