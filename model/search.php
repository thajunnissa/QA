<?php

class SearchAndSet
{
    public $rootDir = './jsonFiles/';

    public function searchAndSetAttributeId($attributeName, $fromFileName)
    {
        $attributeName = strtolower($attributeName);
        if ($fromFileName != 'size') {
            $attributeName = preg_replace('/[^a-z]/i', '', $attributeName);
        }
        $attributeName = str_replace(' ', '', $attributeName);

        if (($attributeName == 'others') || ($attributeName == 'others-vintage')) {
            return 1;
        } else {
            $data = readJsonFile($this->rootDir . $fromFileName . '.json');
            foreach ($data as $block) {
                extract($block);
                $label = strtolower($label);
                if ($fromFileName != 'size') {
                    $label = preg_replace('/[^a-z]/i', '', $label);
                }
                $label = str_replace(' ', '', $label);
                $value = $value;
                if ($label == $attributeName) {
                    return $value;
                }
            }
        }

    }

    public function searchMainCategory($cat)
    {
        $cat = strtolower($cat);

        $data = readJsonFile($this->rootDir . 'categories.json');

        foreach ($data as $item) {
            extract($item);
            $label = strtolower($label);
            $pattern = "/" . $label . "/i";
            $like = preg_match($pattern, $cat);

            if ($like == 1) {
                return $value;
            }
        }
    }

    public function readFromJsonFileCategories($attributeName, $fromFileName, $mainCategoryId)
    {
        $data = readJsonFile($this->rootDir . $fromFileName . '.json') or die("Failed to load");

        foreach ($data as $item) {
            extract($item);
            $categoryId = $cid;
            $secondaryId = $sid;
            $name = strtolower($name);
            if ($name == $attributeName && $id == $mainCategoryId) {
                $values = array($categoryId, $secondaryId);
                return $values;
            }

        }

    }

    public function searchCategory($data, $mainCategoryId)
    {
        $data[15] = strtolower($data[15]);
        if (($mainCategoryId == '187') || ($mainCategoryId == '190') || ($mainCategoryId == '234' || ($mainCategoryId == '741'))) {

            $catArray = $this->readFromJsonFileCategories($data[15], 'mwtsr', $mainCategoryId);
            return $catArray;

        }

//to get subcategory id and category id of kids boys

        elseif ($data[14] == 'KIDSB') {

            $catArray = $this->readFromJsonFileCategories($data[15], 'kidsb', $mainCategoryId);
            return $catArray;

        }

//to get subcategory id and category id of kids girls

        elseif ($data[14] == 'KIDSG') {

            $catArray = $this->readFromJsonFileCategories($data[15], 'kidsg', $mainCategoryId);
            return $catArray;

        }

//to get subcategory id and category id of vintage men

        elseif ($data[14] == 'VINTAGEM') {

            $catArray = $this->readFromJsonFileCategories($data[15], 'vintagem', $mainCategoryId);
            return $catArray;

        }

//to get subcategory id and category id of vintage youth

        elseif (($data[14] == 'VINTAGEYB') || ($data[14] == 'VINTAGEYG') || ($data[14] == 'VINTAGEY')) {

            $catArray = $this->readFromJsonFileCategories($data[15], 'vintagey', $mainCategoryId);
            return $catArray;

        }

//to get subcategory id and category id of vintage women

        elseif ($data[14] == 'VINTAGEW') {

            $catArray = $this->readFromJsonFileCategories($data[15], 'vintagew', $mainCategoryId);
            return $catArray;

        }

//to get subcategory id and category id of youth boys

        elseif ($data[14] == 'YOUTHB') {

            $catArray = $this->readFromJsonFileCategories($data[15], 'youthb', $mainCategoryId);
            return $catArray;

        }

//to get subcategory id and category id of youth girls

        elseif ($data[14] == 'YOUTHG') {

            $catArray = $this->readFromJsonFileCategories($data[15], 'youthg', $mainCategoryId);
            return $catArray;

        } elseif ($data[14] == 'RETROM') {

            $catArray = $this->readFromJsonFileCategories($data[15], 'retrom', $mainCategoryId);
            return $catArray;

        } elseif ($data[14] == 'RETROW') {

            $catArray = $this->readFromJsonFileCategories($data[15], 'retrow', $mainCategoryId);
            return $catArray;

        } elseif ($data[14] == 'RETROY') {

            $catArray = $this->readFromJsonFileCategories($data[15], 'retroy', $mainCategoryId);
            return $catArray;

        }

    }

    public function searchCatSet($data)
    {
        $filter = strtolower($data[16]);

        if (($data[24] == 'cat_pants') || ($data[24] == 'cat_tshirt') || ($data[24] == 'cat_shorts') || ($data[24] == 'hoodies_sweatshirts')) {

            $catSetId = $this->searchAndSetAttributeId($filter, 'catPTSH');
            return $catSetId;

        } else {

            $catSetId = $this->searchAndSetAttributeId($filter, 'catSet');
            return $catSetId;

        }
    }

    public function setTag($tag)
    {
        if ($tag == 'No') {
            return 0;
        } else {
            return 1;
        }
    }

    public function setQty($qty)
    {
        if (($qty == null) || ($qty == 1)) {
            return 1;
        } else {
            return $qty;
        }
    }

    public function searchReportCat1($reportName)
    {
        $reportName = strtolower($reportName);
        $data = readJsonFile($this->rootDir . '/report_cat1.json');
        // if($reportName == 'rework'){
        //     return 1;
        // }
        foreach ($data as $item) {
            extract($item);
            $label = strtolower($label);
            if ($reportName != "women") {
                if (strpos($reportName, $label) !== false) {
                    return $value;
                }

            } else {
                if ($label == $reportName) {
                    return $value;
                }
            }
        }
    }
    public function searchReportCat2($sid)
    {
        $reportName = '';
        $data = readJsonFile($this->rootDir . 'subcategory.json');
        foreach ($data as $item) {
            extract($item);
            $label = strtolower($label);
            if ($sid == $value) {
                $reportName = $label;
            }

        }

        $reportName = strtolower($reportName);
        $repoId = $this->searchAndSetAttributeId($reportName, 'report_cat2');
        return $repoId;
    }

}
