<?php
include_once 'search.php';

class Initializer extends SearchAndSet
{
    public $uploadData = array();

    public function getUploadData()
    {
        return $this->uploadData;
    }

    public function sanitizeAndSetUploadData($data)
    {

        foreach ($data as $product) {

            $brand = $product[4];
            $bid = parent::searchAndSetAttributeId($brand, 'brand_new');
            $product[4] = $bid;

            $name = $product[2];
            $encode_data_1 = iconv('UTF-8', 'ISO-8859-1//IGNORE', $name);
            $name = str_replace('"', "'", $encode_data_1);
            $product[2] = $name;

            $description = $product[3];
            $description = str_replace('"', "'", $description);
            $product[3] = $description;

            $url = $product[8];
            $encode_data_2 = iconv('UTF-8', 'ISO-8859-1//IGNORE', $url);
            $sanitizedUrl = str_replace('"', "'", $encode_data_2);
            $product[8] = $sanitizedUrl;

             $brandSize = $product[9];
            $brandSize = str_replace('"', "'", $brandSize);
            $product[9] = $brandSize;

            $sizeId = parent::searchAndSetAttributeId($product[10], 'size');
            if($sizeId == ""){
                $sizeId = 0;
            }
            $product[10] = $sizeId;

            $conditionId = parent::searchAndSetAttributeId($product[11], 'condition');

            $product[11] = $conditionId;

            $tagId = parent::setTag($product[12]);
            $product[12] = $tagId;

            $colorId = parent::searchAndSetAttributeId($product[13], 'color1');

            $product[13] = $colorId;

            $price = $product[19];
            $product[19] = trim($price, "AED ");
            $extraCsId = array();
            if ($product[14] == 'RETROM' || $product[14] == 'RETROW' || $product[14] == 'VINTAGEM' || $product[14] == 'VINTAGEW') {
                if (substr($product[14], -1) == 'M') {
                    $extraMainId = parent::searchMainCategory('MEN');
                    $extraCsId = parent::searchCategory($product, $extraMainId);
                }
                if (substr($product[14], -1) == 'W') {
                    $extraMainId = parent::searchMainCategory('Women');
                    $extraCsId = parent::searchCategory($product, $extraMainId);
                }

            }
            $mainCategoryId = parent::searchMainCategory($product[14]);
            $cs = parent::searchCategory($product, $mainCategoryId);
            $categoryId = $cs[0];
            $secondaryId = $cs[1];

            $productLabel = parent::searchAndSetAttributeId($product[17], 'product_label');

            $product[17] = $productLabel;

            $reportCat1 = parent::searchReportCat1($product[14]);
            $reportCat2 = parent::searchReportCat2($secondaryId);
           
            $reportCat3 = parent::searchAndSetAttributeId($product[15], 'report_cat3');

            if (($product[16] == 'Caps') || ($product[16] == 'Hats') &&  ($product[14] !== 'REWORK')) {
                $product[16] = 'Hats / Caps';
            }

            if (($product[16] == 'Scarf') || ($product[16] == 'Shawl')) {
                $product[16] = 'Shawl / Scarf';
            }

            if ($product[16] == 'Casual Pants') {
                $product[24] = 'cat_pants';
            }

            $product[16] = trim(preg_replace('/[\t\n\r\s]+/', ' ', $product[16]));
            $product[24] = trim(preg_replace('/[\t\n\r\s]+/', ' ', $product[24]));

            $catid = parent::searchCatSet($product);
            $product[16] = $catid;

            if ($product[23] == 'Migration_Jerseys') {
                $product[23] = 'Migration_Jersey';
            }

            $as = $product[23];
            $ascodeId = parent::searchAndSetAttributeId($as, 'ascode');

            $product[23] = $ascodeId;

            if (($product[14] == 'VINTAGEYG') || ($product[14] == 'VINTAGEYB')||($product[14] == 'VINTAGEY')) {
                $product[24] = null;
            }
            $mtitle = $product[2] . " online | Fashionrerun";
            if (($brand == null) || ($brand == 'Others') || ($brand == 'Others Vintage')) {
                $mdesc = "Shop second hand " . $product[2] . " online in UAE, Saudi, Philippines & Australia at low price. Buy more branded preloved products at fashionrerun";
            } else {
                $mdesc = "Shop second hand " . $product[2] . " by " . $brand . " online in UAE, Saudi, Philippines & Australia at low price. Buy more branded preloved products at fashionrerun";
            }
            $qtyId = parent::setQty($product[30]);
            $product[30] = $qtyId;
            $this->uploadData[] = ["product" => $product,
                "categoryId" => [
                    "mainCatId" => $mainCategoryId,
                    "secondaryCatId" => $secondaryId,
                    "catId" => $categoryId,
                    "extraMainId" => empty($extraCsId) ? null : $extraMainId,
                    "extraSecondaryId" => empty($extraCsId) ? null : $extraCsId[1],
                    "extraCatId" => empty($extraCsId) ? null : $extraCsId[0],
                ],
                "mtitle" => $mtitle,
                "mdesc" => $mdesc,
                "reportCat1" => $reportCat1,
                "reportCat2" => $reportCat2,
                "reportCat3" => $reportCat3,
                "sku" => $product[1],
            ];
        }

    }
}
