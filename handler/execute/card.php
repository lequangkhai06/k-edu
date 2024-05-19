<?php
include "../config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $telco = isset($_POST['card_telco']) ? $_POST['card_telco'] : "";
    $serial = isset($_POST['card_serial']) ? $_POST['card_serial'] : "";
    $pin = isset($_POST['card_pin']) ? $_POST['card_pin'] : "";
    $amount = isset($_POST['card_amount']) ? $_POST['card_amount'] : "";
    # Check recaptcha
    $recaptcha_response = isset($_POST["recaptcha_response"]) ? $_POST["recaptcha_response"] : "";
    if (Recaptcha($G_Captcha['secret_key'], $recaptcha_response, 'post_card')) {
        if (!$users) {
            echo swal("Lỗi", "Bạn chưa đăng nhập", "error", false);
        } elseif (empty($pin) || empty($serial) || empty($telco) || empty($amount)) {
            echo swal("Lỗi", "Vui lòng nhập đầy đủ thông tin", "error", false);
        } elseif (strlen($pin) < 10) {
            echo swal("Lỗi", "Độ dài mã thẻ không hợp lệ", "error", false);
        } elseif (strlen($serial) < 10) {
            echo swal("Lỗi", "Độ dài serial không hợp lệ", "error", false);
        } else {
            $check = $conn->query("SELECT * FROM history_recharge WHERE serial = '{$serial}' AND pin = '{$pin}'")->fetch_array();
            if ($check) {
                echo swal("Lỗi", "Thẻ cào đã tồn tại trên hệ thống", "error", false);
            } else {
                $partner_id = '3903539561';
                $partner_key = 'da31aae6455d99b961980ded60749488';
                $request_id = $_SERVER['SERVER_NAME'] . rand(100009, 999999);
                $trans_id = rand(100009, 999999);
                $data = array(
                    'telco' => $telco,
                    'code' => $pin,
                    'serial' => $serial,
                    'amount' => $amount,
                    'request_id' => $request_id,
                    'partner_id' => $partner_id,
                    'sign' => md5($partner_key . $pin . $serial),
                    'command' => 'charging'
                );
                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => 'https://trumthe.vn/chargingws/v2?' . http_build_query($data),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => [
                        'Content-Type: application/json',
                    ],
                ]);
                $response = curl_exec($curl);
                curl_close($curl);
                if (isset($response)) {
                    $res = json_decode($response, true);
                    if ($res['status'] == 99) {
                        $query = $conn->query("INSERT INTO history_recharge SET email = '{$users["email"]}', type = 'Nạp Thẻ Cào', telco = '{$telco}', serial = '{$serial}', pin = '{$pin}', amount = '{$amount}', request_id = '{$request_id}', trans_id = '{$trans_id}', status = 0, callback_time = 0, time = '{$date}'");
                        if ($query) {
                            echo swal("Thành công", "Thẻ cào đã được gửi đi, vui lòng chờ xử lý.", "success", true);
                        } else {
                            echo swal("Lỗi", "Lỗi truy vấn dữ liệu", "error", false);
                        }
                    } else {
                        echo swal("Lỗi", $res['message'], "error", false);
                    }
                } else {
                    echo swal("Thành công", "Hệ thống đang bảo trì nâng cấp", "success", false);
                }
            }
        }
    }
}
