<?php

class Payload
{
    public $payloads = array();

    public function getPayload()
    {
        return $this->payloads;
    }

    public function generatePayloads($data)
    {
        foreach ($data as $key => $productData) {
            if (is_numeric($key)) {
                foreach ($productData as $key => $productArray) {
                    if ($key == 'product') {
                        $extracted = $productArray;
                    }if ($key == 'categoryId') {
                        $categories = $productArray;
                    }if ($key == 'mtitle') {
                        $title = $productArray;
                    }
                    if ($key == 'mdesc') {
                        $desc = $productArray;
                    }if ($key == 'reportCat1') {
                        $reportCat1 = $productArray;
                    }if ($key == 'reportCat2') {
                        $reportCat2 = $productArray;
                    }if ($key == 'reportCat3') {
                        $reportCat3 = $productArray;
                    }if ($key == 'sku') {
                        $sku = $productArray;
                    }
                }
                $this->payloads[] = $this->payloadScaffold($extracted, $categories, $title, $desc, $reportCat1, $reportCat2, $reportCat3, $sku);
            }
        }
    }

    public function payloadScaffold($data, $categories, $mtitle, $mdesc, $reportCat1, $reportCat2, $reportCat3, $sku)
    {
        $productBasedPayload = $this->getCustomAttribute($data[14], $data[28], $data[24], $data[16], $data[26], $categories['secondaryCatId']);
        $json = '{
            "product":{
                "sku":"' . $data[1] . '",
                "name":"' . $data[2] . '",
                "attribute_set_id":"' . $data[23] . '",
                "price":' . $data[19] . ',
                "visibility":4,
                "type_id":"simple",
                "weight":' . $data[21] . ',
                "extension_attributes":{
                    "website_ids":[1],
                    "stock_item":{
                        "qty":' . $data[30] . ',
                        "is_in_stock":true
                    }
                },
                "custom_attributes":[
                    {
                        "attribute_code":"length",
                        "value":"' . $data[25] . '"
                    },
                    {
                        "attribute_code":"gift_message_available",
                        "value":"0"
                    },
                    {
                        "attribute_code":"pit_to_pit",
                        "value":"' . $data[27] . '"
                    },

                    {
                        "attribute_code":"brand_new",
                        "value":"' . $data[4] . '"
                    },
                    {
                        "attribute_code":"sleeve",
                        "value":"' . $data[29] . '"
                    },
                    {
                        "attribute_code":"url_key",
                        "value":"' . $data[8] . '"
                    },
                    {
                        "attribute_code":"acetate",
                        "value":"' . $data[31] . '"
                    },
                    {
                        "attribute_code":"acrylic",
                        "value":"' . $data[32] . '"
                    },
                    {
                        "attribute_code":"chiffon",
                        "value":"' . $data[33] . '"
                    },
                    {
                        "attribute_code":"coolmax",
                        "value":"' . $data[34] . '"
                    },
                    {
                        "attribute_code":"cotton",
                        "value":"' . $data[35] . '"
                    },
                    {
                        "attribute_code":"denim",
                        "value":"' . $data[36] . '"
                    },
                    {
                        "attribute_code":"elastane",
                        "value":"' . $data[37] . '"
                    },
                    {
                        "attribute_code":"elastic",
                        "value":"' . $data[38] . '"
                    },
                    {
                        "attribute_code":"lastol",
                        "value":"' . $data[39] . '"
                    },
                    {
                        "attribute_code":"leather",
                        "value":"' . $data[40] . '"
                    },
                    {
                        "attribute_code":"lycra",
                        "value":"' . $data[41] . '"
                    },
                    {
                        "attribute_code":"metallic",
                        "value":"' . $data[42] . '"
                    },
                    {
                        "attribute_code":"modal",
                        "value":"' . $data[43] . '"
                    },
                    {
                        "attribute_code":"nylon",
                        "value":"' . $data[44] . '"
                    },
                    {
                        "attribute_code":"pima Cotton",
                        "value":"' . $data[45] . '"
                    },
                    {
                        "attribute_code":"polyamida",
                        "value":"' . $data[46] . '"
                    },
                    {
                        "attribute_code":"polyester",
                        "value":"' . $data[47] . '"
                    },
                    {
                        "attribute_code":"ramie",
                        "value":"' . $data[48] . '"
                    },
                    {
                        "attribute_code":"rayon",
                        "value":"' . $data[49] . '"
                    },
                    {
                        "attribute_code":"silk",
                        "value":"' . $data[50] . '"
                    },
                    {
                        "attribute_code":"spandex",
                        "value":"' . $data[51] . '"
                    },
                    {
                        "attribute_code":"sport",
                        "value":"' . $data[52] . '"
                    },
                    {
                        "attribute_code":"viscose",
                        "value":"' . $data[53] . '"
                    },
                    {
                        "attribute_code":"woolen",
                        "value":"' . $data[54] . '"
                    },
                    {
                        "attribute_code":"linen",
                        "value":"' . $data[55] . '"
                    },
                    {
                        "attribute_code":"lyocell",
                        "value":"' . $data[56] . '"
                    },
                    {
                        "attribute_code":"austres_fibers",
                        "value":"' . $data[57] . '"
                    },
                    {
                        "attribute_code":"angora",
                        "value":"' . $data[58] . '"
                    },
                    {
                        "attribute_code":"brand_size",
                        "value":"' . $data[9] . '"
                    },
                    {
                        "attribute_code":"size",
                        "value":"' . $data[10] . '"
                    },
                    {
                        "attribute_code":"condition",
                        "value":"' . $data[11] . '"
                    },
                    {
                        "attribute_code":"tag",
                        "value":"' . $data[12] . '"
                    },
                    {
                        "attribute_code":"tax_class_id",
                        "value":"2"
                    },
                    {
                        "attribute_code":"color1",
                        "value":"' . $data[13] . '"
                    },
                    {
                        "attribute_code":"category_ids",
                        "value":[
                            ' . $this->toString($categories) . '
                        ]
                    },
                    {
                        "attribute_code":"msrp_display_actual_price_type",
                        "value":"4"
                    },
                    {
                        "attribute_code":"short_description",
                        "value":"' . $data[3] . '"
                    },
                    {
                        "attribute_code":"meta_title",
                        "value":"' . $mtitle . '"
                    },
                    {
                        "attribute_code":"meta_description",
                        "value":"' . $mdesc . '"
                    },
                    {
                        "attribute_code":"report_cat1",
                        "value":"' . $reportCat1 . '"
                    },
                     {
                        "attribute_code":"report_cat2",
                        "value":"' . $reportCat2 . '"
                    },
                      {
                        "attribute_code":"report_cat3",
                        "value":"' . $reportCat3 . '"
                    },
                      {
                        "attribute_code":"product_label",
                        "value":"' . $data[17] . '"
                    }' . $productBasedPayload . '



                ]
            }
        }';

        return ["payload" => $json, "sku" => $sku];
    }
    public function getCustomAttribute($category, $waist, $catSet, $filters, $chestOrBust, $secondaryId)
    {
        if ($waist != null) {

            $categories = array('cat_activewear', 'cat_dresses', 'cat_jeans' , 'cat_jersey', 'cat_jumper', 'cat_nightwear_lingerie', 'cat_pants', 'cat_shorts', 'cat_skirts', 'cat_sweater', 'cat_swimwear');
            if (in_array($catSet, $categories)) {
                return ',
                    {
                        "attribute_code":"' . $catSet . '",
                        "value":"' . $filters . '"
                    },
                    {
                        "attribute_code":"waist",
                        "value":"' . $waist . '"
                    }';
            } else {
                return ' ,
                    {
                        "attribute_code":"waist",
                        "value":"' . $waist . '"
                    }';
            }
        }
        //adding product without waist and chest/bust

        elseif ($chestOrBust == null && $waist == null) {
            $categories = array('cat_accessories', 'cat_activewear', 'cat_bags', 'cat_blouse_tops', 'cat_dresses', 'cat_jacket', 'cat_jeans', 'cat_jersey', 'cat_jumper', 'cat_nightwear_lingerie', 'cat_pants', 'cat_shirts', 'cat_shoes', 'cat_shorts', 'cat_skirts', 'cat_sweater', 'cat_swimwear', 'cat_tshirt', 'hoodies_sweatshirts');
            if (in_array($catSet, $categories)) {
                return ',
                    {
                        "attribute_code":"' . $catSet . '",
                        "value":"' . $filters . '"
                    }';
            } else {
                return '';
            }

        }
        // adding product with chest/bust
        //chest
        elseif (($category == 'MEN') || ($category == 'YOUTHB') || ($category == 'KIDSB') || ($category == 'VINTAGEM') || ($secondaryId == '189') || ($category == 'VINTAGEYB') || ($category == 'RETROM') || ($category == 'RETROY')) {
            $categories = array('cat_activewear', 'cat_blouse_tops', 'cat_dresses', 'cat_jacket', 'cat_jeans', 'cat_jersey', 'cat_jumper', 'cat_nightwear_lingerie', 'cat_shirts', 'cat_sweater', 'cat_swimwear', 'cat_tshirt', 'hoodies_sweatshirts');
            if (in_array($catSet, $categories)) {
                return ',
                    {
                        "attribute_code":"' . $catSet . '",
                        "value":"' . $filters . '"
                    },
                    {
                        "attribute_code":"chest",
                        "value":"' . $chestOrBust . '"
                    }';
            } else {
                return ',
                    {
                        "attribute_code":"chest",
                        "value":"' . $chestOrBust . '"
                    }';
            }
        } else {
            $categories = array('cat_activewear', 'cat_blouse_tops', 'cat_dresses', 'cat_jacket', 'cat_jeans', 'cat_jersey', 'cat_jumper', 'cat_nightwear_lingerie', 'cat_shirts', 'cat_sweater', 'cat_swimwear', 'cat_tshirt', 'hoodies_sweatshirts');

            if (in_array($catSet, $categories)) {
                return ',
                    {
                        "attribute_code":"' . $catSet . '",
                        "value":"' . $filters . '"
                    },
                    {
                        "attribute_code":"bust",
                        "value":"' . $chestOrBust . '"
                    }';
            } else {
                return ',
                    {
                        "attribute_code":"bust",
                        "value":"' . $chestOrBust . '"
                    }';
            }

        }
    }

    public function toString($data)
    {

        $data = array_filter($data);
        return implode(",", $data);

    }

}
