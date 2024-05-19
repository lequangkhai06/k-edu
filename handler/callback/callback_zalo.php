<?php
require "../config.php";
$ip_addr = getUserIP();
$deviceID = $_SERVER['HTTP_USER_AGENT'];
$token = UserToken(50);
/* ----------GHI LOG---------- */
$logFile = 'logZalo.txt';
$getParams = $_GET;
$timestamp = date("d-m-Y H:i:s");
$logData = array(
    'time' => $timestamp,
    'params' => $getParams
);
$logString = json_encode($logData);
file_put_contents($logFile, $logString . PHP_EOL, FILE_APPEND);

/* ----------XÁC THỰC ACCESS TOKEN---------- */
if (isset($_GET['code']) && isset($_GET['state'])) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://oauth.zaloapp.com/v4/access_token');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded',
        'secret_key: ' . $Z_secretKey
    ));
    $code = $_GET['code'];
    $state = $_GET['state'];
    // Định nghĩa các tham số
    $params = array(
        'code' => $code,
        'app_id' => $Z_appId,
        'grant_type' => 'authorization_code',
        'code_verifier' => $state
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    $response = curl_exec($ch);
    $result = json_decode($response);
    curl_close($ch);
    if (!isset($result->error)) {
        $access_token = $result->access_token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.zalo.me/v2.0/me?fields=id,name,picture');
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'access_token: ' . $access_token
        ));
        $getUserResponse = curl_exec($ch);
        $getUserResult = json_decode($getUserResponse);
        curl_close($ch);
        // {
        //     "is_sensitive": false,
        //     "name": "Lê Quang Khải",
        //     "id": "5016401283042469809",
        //     "error": 0,
        //     "message": "Success",
        //     "picture": {
        //       "data": {
        //         "url": "https://s120-ava-talk.zadn.vn/5/f/8/b/51/120/39aa3a85f413ef80da1f8f746d7f8667.jpg"
        //       }
        //     }
        // }
        // kiểm tra xem người dùng đã có tài khoản trên hệ thống hay chưa?
        $zalo_id = $getUserResult->id;
        $check = $conn->query("select * from users where zalo_id = '$zalo_id'")->fetch_array();
        if ($check && $check["id"]) {
            // đã tồn tại
            $_SESSION['zalo_access_token'] = $access_token;
            // Cấp cookie cho người dùng
            Cookie($days_of_cookie, 'setcookie', $check['token'], 'AUTH');
            // Update db
            $conn->query("UPDATE users SET ip_addr = '{$ip_addr}', name = '{$getUserResult->name}', avatar = '{$getUserResult->picture->data->url}' WHERE zalo_id = '{$check["zalo_id"]}'");
            $base->insert_if_not_exists(
                "login_records",
                [
                    "login_time" => time()
                ],
                [
                    "user_id"    => $check['zalo_id'],
                    "device_id"     => $deviceID,
                    "login_time" => time(),
                    "type" => "zalo"
                ]
            );
        } else {
            // chưa tồn tại tài khoản
            if (!$ip_info = IpInfo($ip_addr)) {
                $address = 'Không rõ';
            } else {
                $address = $ip_info->city . ' / ' . $ip_info->region . ' / ' . $ip_info->country;
            }
            $base->insert_if_not_exists(
                "users",
                [
                    "zalo_id" => $getUserResult->id
                ],
                [
                    "name"     => $getUserResult->name,
                    "username" => strtolower(SlugURL($getUserResult->name) . rand(1000, 9999)),
                    "password" => md5(rand(100, 999)),
                    "token"    => $token,
                    "ip_addr"  => $ip_addr,
                    "address"  => $address,
                    "zalo_id"  => $getUserResult->id,
                    "avatar"   => $getUserResult->picture->data->url,
                    "verified" => 1,
                    "registration_type" => "zalo"
                ]
            );
            // Cấp cookie cho người dùng
            Cookie($days_of_cookie, 'setcookie', $token, 'AUTH');
        }
        // done
        //echo 'Xin lỗi, bạn đã đăng nhập rồi. Đang chuyển hướng về trang chủ.';
        echo '<script>setTimeout(() => {window.location.href = "/";},100);</script>';
        return;
    } else {
        echo 'Có lỗi khi xác minh access token. Đang chuyển hướng về trang chủ.';
        echo '<script>setTimeout(() => {window.location.href = "/";},1500);</script>';
        return;
    }
} else {
    echo 'Đã có lỗi xảy ra. Đang chuyển hướng về trang chủ.';
    echo '<script>setTimeout(() => {window.location.href = "/";},1500);</script>';
    return;
}
