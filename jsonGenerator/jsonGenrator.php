<?php
include '../config/importer.php';

$apiToken = new Uploader(env('ROOT_URL'), env('TOKEN_TAIL'), env('USERNAME'), env('PASSWORD'));

echo "\t\t Getting Token\n";
$apiToken = $apiToken->getToken();
$apiManager = new ApiCallManager($apiToken, env('ROOT_URL'), env('ATTRIBUTE_SET_TAIL'));
$createJson = new CreateJsonFile($projectRootPAth);
//env attributes
$attributeListFromEnv = [
    'BRAND_NEW',
    'SIZE',
    'COLOR1',
    'CONDITION',
    'CAT_PANTS',
    'CAT_TSHIRT',
    'CAT_SHORTS',
    'CAT_ACCESSORIES',
    'CAT_ACTIVEWEAR',
    'CAT_BAGS',
    'CAT_BLOUSE_TOPS',
    'CAT_DRESSES',
    'CAT_JACKET',
    'CAT_JEANS',
    'CAT_JERSEY',
    'CAT_JUMPER',
    'CAT_NIGHTWEAR_LINGERIE',
    'CAT_SHIRTS',
    'CAT_SHOES',
    'CAT_SKIRTS',
    'CAT_SWEATER',
    'CAT_SWIMWEAR',
    'HOODIES_SWEATSHIRTS',
    'REPORT_CAT1',
    'REPORT_CAT2',
    'REPORT_CAT3',
    'PRODUCT_LABEL',
    'NEW',
];

//get data through api and create json for received data
echo "\t\t Getting Brand Data and Create brand .json\n\n";
 $brand = $apiManager->getAttributeValue(env($attributeListFromEnv[0]));
 $createJson->createJsonFileFromApi($brand, strtolower($attributeListFromEnv[0]));
 echo "\t\t brand.json file generated\n\n";
 echo "\t\t Getting Size Data and Create size.json\n\n";
 $size = $apiManager->getAttributeValue(env($attributeListFromEnv[1]));
 $createJson->createJsonFileFromApi($size, strtolower($attributeListFromEnv[1]));
 echo "\t\t Size.json file generated\n\n";
 echo "\t\t Getting Color Data and Create color .json\n\n";
 $colors = $apiManager->getAttributeValue(env($attributeListFromEnv[2]));
 $createJson->createJsonFileFromApi($colors, strtolower($attributeListFromEnv[2]));
 echo "\t\t color.json file generated\n\n";
 echo "\t\t Getting Condition Data and Create condition .json\n\n";
 $condition = $apiManager->getAttributeValue(env($attributeListFromEnv[3]));
 $createJson->createJsonFileFromApi($condition, strtolower($attributeListFromEnv[3]));
 echo "\t\t condition.json file generated\n\n";
 echo "\t\t Getting ReportAttributes and ProductLabel Data \n\n";
 $reportCat1 = $apiManager->getAttributeValue(env($attributeListFromEnv[23]));
 $createJson->createJsonFileFromApi($reportCat1, strtolower($attributeListFromEnv[23]));
 $reportCat2 = $apiManager->getAttributeValue(env($attributeListFromEnv[24]));
 $createJson->createJsonFileFromApi($reportCat2, strtolower($attributeListFromEnv[24]));
 $reportCat3 = $apiManager->getAttributeValue(env($attributeListFromEnv[25]));
 $createJson->createJsonFileFromApi($reportCat3, strtolower($attributeListFromEnv[25]));
 $productLabel = $apiManager->getAttributeValue(env($attributeListFromEnv[26]));
 $createJson->createJsonFileFromApi($productLabel, strtolower($attributeListFromEnv[26]));
 echo "\t\t json files generated\n\n";
 echo "\t\t Getting Attribute data's\n\n";
 $catPants = $apiManager->getAttributeValue(env($attributeListFromEnv[4]));
 $catTshirt = $apiManager->getAttributeValue(env($attributeListFromEnv[5]));
 $catShorts = $apiManager->getAttributeValue(env($attributeListFromEnv[6]));
 $catAccessories = $apiManager->getAttributeValue(env($attributeListFromEnv[7]));
 $catActivewear = $apiManager->getAttributeValue(env($attributeListFromEnv[8]));
 $catBags = $apiManager->getAttributeValue(env($attributeListFromEnv[9]));
 $catBlouse = $apiManager->getAttributeValue(env($attributeListFromEnv[10]));
 $catDresses = $apiManager->getAttributeValue(env($attributeListFromEnv[11]));
 $catJacket = $apiManager->getAttributeValue(env($attributeListFromEnv[12]));
 $catJeans = $apiManager->getAttributeValue(env($attributeListFromEnv[13]));
 $catJersey = $apiManager->getAttributeValue(env($attributeListFromEnv[14]));
 $catJumper = $apiManager->getAttributeValue(env($attributeListFromEnv[15]));
 $catNightwear = $apiManager->getAttributeValue(env($attributeListFromEnv[16]));
 $catShirts = $apiManager->getAttributeValue(env($attributeListFromEnv[17]));
 $catShoes = $apiManager->getAttributeValue(env($attributeListFromEnv[18]));
 $catSkirts = $apiManager->getAttributeValue(env($attributeListFromEnv[19]));
 $catSweater = $apiManager->getAttributeValue(env($attributeListFromEnv[20]));
 $catSwimwear = $apiManager->getAttributeValue(env($attributeListFromEnv[21]));
 $hoodiesSweatshirts = $apiManager->getAttributeValue(env($attributeListFromEnv[22]));

 //merge data for json file creation

 $catPTSH = array_merge($catPants, $catTshirt, $catShorts, $hoodiesSweatshirts);
 $createJson->createJsonFileFromApi($catPTSH, 'catPTSH');
 $catSet = array_merge($catAccessories, $catActivewear, $catBags, $catBlouse, $catDresses, $catJacket, $catJeans, $catJersey, $catJumper, $catNightwear, $catShirts, $catShoes, $catSkirts, $catSweater, $catSwimwear);
 $createJson->createJsonFileFromApi($catSet, 'catSet');
 echo "\t\t json files generated\n\n";
 echo "\t\t Getting Category's Data's\n\n";

 //create categories json files
 $fullCategoriesResponse = $apiManager->getCategories();
 $createJson->createJsonFileFromApi($fullCategoriesResponse, 'temp/main');
 $jsonData = readJsonFile($projectRootPAth . '/jsonFiles/temp/main.json');
 $categories = $createJson->createMainCategoriesFile($jsonData);
$createJson->createJsonFileFromApi($categories, 'categories');
 $women = $createJson->getCategoryDetailsJson($jsonData, 'WOMEN');
 $men = $createJson->getCategoryDetailsJson($jsonData, 'MEN');
 $rework = $createJson->getCategoryDetailsJson($jsonData, 'REWORK');
 $toddler = $createJson->getCategoryDetailsJson($jsonData, 'TODDLER');
 $mwtsr = array_merge($women, $men, $toddler, $rework);
 $createJson->createJsonFileFromApi($mwtsr, 'mwtsr');
 $kidsb = $createJson->getCategoryDetailsJson($jsonData, 'KIDSB');
$createJson->createJsonFileFromApi($kidsb, 'kidsb');
$kidsg = $createJson->getCategoryDetailsJson($jsonData, 'KIDSG');
$createJson->createJsonFileFromApi($kidsg, 'kidsg');
$vintagem = $createJson->getCategoryDetailsJson($jsonData, 'VINTAGEM');
$createJson->createJsonFileFromApi($vintagem, 'vintagem');
$vintagew = $createJson->getCategoryDetailsJson($jsonData, 'VINTAGEW');
$createJson->createJsonFileFromApi($vintagew, 'vintagew');
$vintagey = $createJson->getCategoryDetailsJson($jsonData, 'VINTAGEY');
$createJson->createJsonFileFromApi($vintagey, 'vintagey');
$retrom = $createJson->getCategoryDetailsJson($jsonData, 'RETROM');
$createJson->createJsonFileFromApi($retrom, 'retrom');
$retrow = $createJson->getCategoryDetailsJson($jsonData, 'RETROW');
$createJson->createJsonFileFromApi($retrow, 'retrow');
$retroy = $createJson->getCategoryDetailsJson($jsonData, 'RETROY');
$createJson->createJsonFileFromApi($retroy, 'retroy');
$youthb = $createJson->getCategoryDetailsJson($jsonData, 'YOUTHB');
$createJson->createJsonFileFromApi($youthb, 'youthb');
$youthg = $createJson->getCategoryDetailsJson($jsonData, 'YOUTHG');
$createJson->createJsonFileFromApi($youthg, 'youthg');
$subCategory = $createJson->createSubCategoryJson($jsonData);
$createJson->createJsonFileFromApi($subCategory, 'subcategory');



echo "\t\t json files generated\n\n";

//create ascode json files
echo "\t\t Getting Attribute Set Code Data\n\n";

$asCode = $apiManager->getAttributeSetCode();
$createJson->createJsonFileFromApi($asCode, 'ascode');
echo "\t\t json files generated\n\n";
shell_exec("nautilus --browser $projectRootPAth/jsonFiles");




