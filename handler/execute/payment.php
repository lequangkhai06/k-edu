<?php
include "../config.php";
$method = isset($_POST["method"]) ? $_POST["method"] : "";
$webinar_id = isset($_POST["webinar_id"]) ? $_POST["webinar_id"] : "";
if (!isset($users)) {
    echo swal("LOGIN", "/login", "success", false);
    return;
}
if ($method == "" || $webinar_id == "") {
    echo swal("Thông báo", "Vui lòng chọn phương thức thanh toán.", "error", false);
    return;
}
// Kiểm tra webinars
$checkWebinars = $conn->query("SELECT * FROM webinars WHERE id = '{$webinar_id}'");

// ton tai webinar
if ($checkWebinars->num_rows > 0) {
    // Data Webnars
    $webinars = $checkWebinars->fetch_array();
    // Check số lượng đơn chờ xử lý
    //$checkWebinars = $conn->query("SELECT * FROM orders WHERE user_id = '{$user_id}' AND webinar_id = '{$webinars['id']}'");
    if (!$base->checkUserCourse($webinars['id'], $user_id)) {
        /** Methods:
         * Momo
         * Vnpay
         * K Coins
         */
        /** THANH TOAN BANG MOMO **/
        if ($method == 'momo') {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán: " . $webinars['title'];
            $amount = $webinars['price'];
            $orderId = rand(1000, 9999) . time();
            $redirectUrl = $Url_Redirect[$method];
            $ipnUrl = $Url_Redirect[$method];
            $extraData = "";
            $requestId = time();
            $requestType = "payWithATM";
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);
            if ($jsonResult['resultCode'] == 0) {
                // insert db
                $orderInsert = $base->insert_if_not_exists(
                    "orders",
                    [
                        "trans_id" => $orderId
                    ],
                    [
                        "user_id"    => $user_id,
                        "webinar_id" => $webinars['id'],
                        "status"     => "pedding",
                        "payment_method" => $method,
                        "amount" => $webinars['price'],
                        "total_amount" => $webinars['price'],
                        "trans_id"   => $orderId,
                        "note"      => $orderInfo,
                        "created_at"    => time()
                    ]
                );
                echo swal("MOMO", $jsonResult['payUrl'], "success", false);
            } else {
                echo swal("MOMO", $jsonResult['message'], "error", false);
            }
            /** THANH TOAN BANG VNPAY **/
        } elseif ($method == 'vnpay') {
            $vnp_TxnRef = rand(1000, 9999) . time(); //Mã giao dịch thanh toán tham chiếu của merchant
            $vnp_Amount = $webinars['price']; // Số tiền thanh toán
            $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
            $vnp_BankCode = 'VNBANK'; //Mã phương thức thanh toán
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán
            $vnp_OrderInfo = "Thanh toán: " . $webinars['title'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount * 100,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => "other",
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate" => $expire
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            // insert db
            $orderInsert = $base->insert_if_not_exists(
                "orders",
                [
                    "trans_id" => $vnp_TxnRef
                ],
                [
                    "user_id"    => $user_id,
                    "webinar_id" => $webinars['id'],
                    "status"     => "pedding",
                    "payment_method" => $method,
                    "amount" => $webinars['price'],
                    "total_amount" => $webinars['price'],
                    "trans_id"   => $vnp_TxnRef,
                    "note"      => $vnp_OrderInfo,
                    "created_at"    => time()
                ]
            );
            echo swal("VNPAY", $vnp_Url, "success", false);
            return;
            /** THANH TOAN BANG COINS **/
        } elseif ($method == 'coins') {
            /** EXECUTE **/
            if ($user_coins < $webinars['price']) {
                echo swal("Thông báo", "Xin lỗi, bạn không đủ tiền để thực hiện giao dịch này!", "error", false);
            } elseif ($user_coins < 0) {
                echo swal("Thông báo", "Xin lỗi, bạn không đủ tiền để thực hiện giao dịch này!", "error", false);
            } else {
                //Tru tien 
                $query = $conn->query("UPDATE users SET `coins` = `coins` - '{$webinars["price"]}' WHERE `id` = '{$user_id}'");
                $trans_id_coins = rand(1000, 9999) . time();
                $coins_note = "Thanh toán: " . $webinars['title'];
                if ($query) {
                    // insert db
                    $orderInsert = $base->insert_if_not_exists(
                        "orders",
                        [
                            "trans_id" => $trans_id_coins
                        ],
                        [
                            "user_id"    => $user_id,
                            "webinar_id" => $webinars['id'],
                            "status"     => "success",
                            "payment_method" => $method,
                            "amount" => $webinars['price'],
                            "total_amount" => $webinars['price'],
                            "trans_id"   => $trans_id_coins,
                            "note"      => $coins_note,
                            "created_at"    => time()
                        ]
                    );
                    if ($orderInsert) {
                        $coins_url = $Url_Redirect[$method] . '?order_id=' . $trans_id_coins;
                        echo swal("VNPAY", $coins_url, "success", false);
                    } else {
                        echo swal("Thông báo", "Có lỗi truy vấn từ hệ thống!", "error", false);
                    }
                } else {
                    echo swal("Thông báo", "Có lỗi truy vấn từ hệ thống!", "error", false);
                }
            }
        } else {
            echo swal("Thông báo", "Phương thức thanh toán không tồn tại!", "error", false);
        }
    } else {
        echo swal("Thông báo", "Bạn đã tham gia khóa học này rồi.", "error", false);
    }
} else {
    echo swal("Thông báo", "Khóa học không tồn tại.", "error", false);
}
