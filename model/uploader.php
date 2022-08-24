<?php
class Uploader
{
    public $token;
    public $rootUrl;
    public $tokenUrl;
    public $username;
    public $password;
    public function __construct($rootUrl, $tokenTail, $username, $password)
    {
        $this->rootUrl = $rootUrl;
        $this->tokenUrl = $this->rootUrl . $tokenTail;
        $this->username = $username;
        $this->password = $password;
        $this->token = $this->ApiToken();

    }
    public function getToken()
    {
        return $this->token;
    }
    public function ApiToken()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->tokenUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "username":"' . $this->username . '",
            "password":"' . $this->password . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: PHPSESSID=rmuqs3o49eo8ncqfmhpklhvhqd',
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $newToken = trim($response, '"');
        return $newToken;
    }
    public function uploadProduct($payload, $filename, $index, $sku)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->rootUrl . 'products/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token . '',
                'Content-Type: application/json',
                'Cookie: PHPSESSID=52lfou3bv0mgbt8pg62dge4a16',
            ),
        ));

        $response = curl_exec($curl);
        $response = "\n[$index]=>\n\t" . $response . "\n\t";
        $this->disableProducts($sku);
        $this->logs($filename, $response);

    }

    public function logs($filename, $response)
    {
        $response = "\n$response\n";
        if ($handle = fopen("$filename", 'a')) {
            fwrite($handle, $response);
            fclose($handle);
        }
    }
    public function disableProducts($sku)
    {

        $curl = curl_init();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->rootUrl . 'products/' . $sku,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => '{
           "product":{
                      "status":2
                     }
                                    }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token . '',
                'Content-Type: application/json',
                'Cookie: PHPSESSID=52lfou3bv0mgbt8pg62dge4a16',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

    }
    public function enableProducts($sku)
    {

        $curl = curl_init();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->rootUrl . 'products/' . $sku,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => '{
           "product":{
                      "status":1
                     }
                                    }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token . '',
                'Content-Type: application/json',
                'Cookie: PHPSESSID=52lfou3bv0mgbt8pg62dge4a16',
            ),
        ));

        $response = curl_exec($curl);
        echo "\t\t" . $sku . "      Enabled" . "\n\n";
        curl_close($curl);

    }
}
