<?php

class ApiCallManager
{
    public $apiToken;
    public $rootUrl;
    public $attributeSetUrl;

    public function __construct($apiToken, $rootUrl, $attributeSetUrl)
    {
        $this->rootUrl = $rootUrl;

        $this->apiToken = $apiToken;

        $this->attributeSetUrl = $this->rootUrl . $attributeSetUrl;

    }
    public function getAttributeValue($link)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->rootUrl . $link,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->apiToken . "",
                "Content-Type: application/json",
                "Cookie: PHPSESSID=tvsstbt4uch3d4ss65dah9adfm",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);

        }

    }

    public function getAttributeSetCode()
    {
        $jsonBody = array();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->attributeSetUrl",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->apiToken . "",
                "Content-Type: application/json",
                "Cookie: PHPSESSID=tvsstbt4uch3d4ss65dah9adfm",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);
            foreach ($json as $item) {
                if (is_array($item)) {
                    foreach ($item as $data) {
                        extract($data);
                        $jsonBody[] = [
                            "label" => $attribute_set_name,
                            "value" => $attribute_set_id,
                        ];
                    }
                }
            }
        }

        return $jsonBody;

    }

    public function getCategories()
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->rootUrl . "categories",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->apiToken . "",
                "Content-Type: application/json",
                "Cookie: PHPSESSID=tvsstbt4uch3d4ss65dah9adfm",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $json = json_decode($response, true);

            return $json;
        }

    }

}
