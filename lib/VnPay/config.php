<?php
$vnp_TmnCode = "7OW3423U"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "KYM0I9HVCLG5CCG051IO0T2XBII8RAUG"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "https://localhost/lib/VnPay/vnpay_return.php";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
