<?php
class CreateJsonFile
{
    public $pathRoot;
    public function __construct($path)
    {
        $this->pathRoot = $path;
    }

    public function createJsonFileFromApi($jsonData, $fileName)
    {
        $jsonDataToString = json_encode($jsonData, JSON_PRETTY_PRINT);
        if ($handle = fopen("$this->pathRoot/jsonFiles/$fileName.json", 'w')) {
            fwrite($handle, $jsonDataToString);
            fclose($handle);
        }

    }
//to create main createMainCategoriesFile add new category in the array
    public function createMainCategoriesFile($data)
    {
        $jsonBody = array();
        $mainCategories = [
            "WOMEN",
            "MEN",
            "YOUTH",
            "KIDS",
            "TODDLER",
            "VINTAGE",
            "RETRO",
            "REWORK",
        ];
        extract($data);
        foreach ($children_data as $block) {
            extract($block);
            if (in_array($name, $mainCategories)) {
                $key = strtolower($name);
                $key = preg_replace('/[^a-z]/i', '', $name);
                $mainId = $id;
                $jsonBody[] = [
                    "label" => $key,
                    "value" => $mainId,
                ];
            }
        }
        return $jsonBody;
    }

    public function getCategoryDetailsJson($data, $categoryName)
    {
        extract($data);
        $jsonBody = array();
        $mwtscategory = [
            'WOMEN',
            'MEN',
            'TODDLER',
            'REWORK',
        ];
        if (!in_array($categoryName, $mwtscategory)) {
            $stringSeparator = $this->stringSeparator($categoryName);
            foreach ($children_data as $block) {
                extract($block);
                if ($name == $stringSeparator[0]) {
                    $mainId = $id;
                    foreach ($children_data as $blockTwo) {
                        extract($blockTwo);
                        if ($name[0] == $stringSeparator[1]) {
                            $secondaryId = $id;
                            foreach ($children_data as $blockThree) {
                                extract($blockThree);
                                $catName = strtolower($name);
                                $catName = preg_replace('/[^a-z]/i', '', $name);
                                $catId = $id;
                                $jsonBody[] = [
                                    'cid' => $catId,
                                    'sid' => $secondaryId,
                                    'id' => $mainId,
                                    'name' => $catName,
                                ];

                            }

                        }
                    }

                }
            }

        }

       

        foreach ($children_data as $block) {
            extract($block);
            if ($name == $categoryName) {
                $mainId = $id;
                foreach ($children_data as $blockTwo) {
                    extract($blockTwo);
                    $secondaryId = $id;
                    foreach ($children_data as $blockThree) {
                        extract($blockThree);
                        $catName = strtolower($name);
                        $catName = preg_replace('/[^a-z]/i', '', $name);
                        $catId = $id;
                        $jsonBody[] = [
                            'cid' => $catId,
                            'sid' => $secondaryId,
                            'id' => $mainId,
                            'name' => $catName,
                        ];

                    }
                }

            }
        }

        return $jsonBody;

    }

    public function stringSeparator($string)
    {
        $first = substr($string, 0, -1);
        $last = $string[-1];
        return [$first, $last];

    }

    public function createSubCategoryJson($data)
    {
        $jsonBody = array();
        extract($data);
        foreach ($children_data as $block) {
            extract($block);
            foreach ($children_data as $blockTwo) {
                extract($blockTwo);
                $jsonBody []=[
                    "label"=>$name,
                    "value"=>$id,
                ];

            }
        }
        return $jsonBody;
    }

}
