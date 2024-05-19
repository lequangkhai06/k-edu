<?php

// CHECK LỊCH SỬ GIAO DỊCH MOMO TEST 

error_reporting(1);
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/query";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$requestId = time() . "";

if (isset($_GET['orderId'])) {
    $orderId = $_GET["orderId"];
    $rawHash = "accessKey=" . $accessKey . "&orderId=" . $orderId . "&partnerCode=" . $partnerCode . "&requestId=" . $requestId;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);
    $data = array(
        'partnerCode' => $partnerCode,
        'requestId' => $requestId,
        'orderId' => $orderId,
        'requestType' => $requestType,
        'signature' => $signature,
        'lang' => 'vi'
    );
    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);
    if (!empty($result)) {
        $partnerCode = $jsonResult["partnerCode"];
        $accessKey = $jsonResult["accessKey"];
        $requestId = $jsonResult["requestId"];
        $orderId = $jsonResult["orderId"];
        $errorCode = $jsonResult["errorCode"];
        $transId = $jsonResult["transId"];
        $amount = $jsonResult["amount"];
        $message = $jsonResult["message"];
        $localMessage = $jsonResult["localMessage"];
        $requestType = $jsonResult["requestType"];
        $payType = $jsonResult["payType"];
        $extraData = ($jsonResult["extraData"] ? $jsonResult["extraData"] : "");
        $m2signature = $jsonResult["signature"];

        //before sign HMAC SHA256 signature
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&orderId=" . $orderId . "&errorCode=" . $errorCode . "&transId=" . $transId . "&amount=" . $amount . "&message=" . $message . "&localMessage=" . $localMessage . "&requestType=" . $requestType . "&payType=" . $payType . "&extraData=" . $extraData;
        $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);
    }
}

if (isset($jsonResult)) {
    // hợp lệ
    if ($jsonResult['resultCode'] == 0) {
        echo 'success';
    } else {
        echo $jsonResult['message'];
    }
    // print_r($jsonResult);
}
