<?php

$variables = [
    'USERNAME' => 'productupload',
    'PASSWORD' => 'product@2cloud',
    'ROOT_URL' => 'https://adm.fashionrerun.com/rest/V1/',
    'TOKEN_TAIL' => 'integration/admin/token',
    'ATTRIBUTE_SET_TAIL' => 'products/attribute-sets/sets/list?searchCriteria=0',
    'BRAND_NEW' => 'products/attributes/brand_new/options',
    'SIZE' => 'products/attributes/size/options',
    'COLOR1' => 'products/attributes/color1/options',
    'CONDITION' => 'products/attributes/condition/options',
    'CAT_PANTS' => 'products/attributes/cat_pants/options',
    'CAT_TSHIRT' => 'products/attributes/cat_tshirt/options',
    'CAT_SHORTS' => 'products/attributes/cat_shorts/options',
    'CAT_ACCESSORIES' => 'products/attributes/cat_accessories/options',
    'CAT_ACTIVEWEAR' => 'products/attributes/cat_activewear/options',
    'CAT_BAGS' => 'products/attributes/cat_bags/options',
    'CAT_BLOUSE_TOPS' => 'products/attributes/cat_blouse_tops/options',
    'CAT_DRESSES' => 'products/attributes/cat_dresses/options',
    'CAT_JACKET' => 'products/attributes/cat_jacket/options',
    'CAT_JEANS' => 'products/attributes/cat_jeans/options',
    'CAT_JERSEY' => 'products/attributes/cat_jersey/options',
    'CAT_JUMPER' => 'products/attributes/cat_jumper/options',
    'CAT_NIGHTWEAR_LINGERIE' => 'products/attributes/cat_nightwear_lingerie/options',
    'CAT_SHIRTS' => 'products/attributes/cat_shirts/options',
    'CAT_SHOES' => 'products/attributes/cat_shoes/options',
    'CAT_SKIRTS' => 'products/attributes/cat_skirts/options',
    'CAT_SWEATER' => 'products/attributes/cat_sweater/options',
    'CAT_SWIMWEAR' => 'products/attributes/cat_swimwear/options',
    'HOODIES_SWEATSHIRTS' => 'products/attributes/hoodies_sweatshirts/options',
    'REPORT_CAT1' => 'products/attributes/report_cat1/options',
    'REPORT_CAT2' => 'products/attributes/report_cat2/options',
    'REPORT_CAT3' => 'products/attributes/report_cat3/options',
    'PRODUCT_LABEL' => 'products/attributes/product_label/options',

];

foreach ($variables as $key => $value) {
    putenv("$key=$value");
}
