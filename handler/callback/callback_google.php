<?php
require "../config.php";
$ip_addr = getUserIP();
$deviceID = $_SERVER['HTTP_USER_AGENT'];
$token = UserToken(50);
/* ----------GHI LOG---------- */
$logFile = 'logGoogle.txt';
$getParams = $_GET;
$timestamp = date("d-m-Y H:i:s");
$logData = array(
    'time' => $timestamp,
    'params' => $getParams
);
$logString = json_encode($logData);
file_put_contents($logFile, $logString . PHP_EOL, FILE_APPEND);

/* ----------GET ACCESS TOKEN---------- */
if (isset($_GET['code'])) {
    $authorization_code = $_GET['code'];
    $token_url = 'https://accounts.google.com/o/oauth2/token';
    $post_data = [
        'code' => $authorization_code,
        'client_id' => $G_appId,
        'client_secret' => $G_secretKey,
        'redirect_uri' => $G_appCallback,
        'grant_type' => 'authorization_code'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response);
    if (!isset($result->access_token)) {
        echo 'Có lỗi khi lấy access token. Đang chuyển hướng về trang chủ.';
        echo '<script>setTimeout(() => {window.location.href = "/";},100);</script>';
        return;
    }
    $access_token = $result->access_token;

    /* ----------XÁC MINH ACCESS TOKEN---------- */
    // Gọi Google API để lấy thông tin người dùng
    $userinfo_url = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $userinfo_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $getUserResult = json_decode($response);
    if (isset($getUserResult->error)) {
        echo 'Có lỗi khi xác minh access token. Đang chuyển hướng về trang chủ.';
        echo '<script>setTimeout(() => {window.location.href = "/";},100);</script>';
        return;
    } else {
        /*
            Example data
            [id] => 115292141256719766504 
            [email] => lequangkhai.dev@gmail.com 
            [verified_email] => 1 
            [name] => Lê Quang Khải 
            [given_name] => Lê Quang 
            [family_name] => Khải 
            [picture] => https://lh3.googleusercontent.com/a/ACg8ocJmK5FaquOCuMmPkAUOtgd0i1vsCQbmwbeiELoK3oLc7WtFY4A=s96-c 
            [locale] => vi
        */
        // kiểm tra xem người dùng đã có tài khoản trên hệ thống hay chưa?
        $google_id = $getUserResult->id;
        $check = $conn->query("select * from users where google_id = '$google_id'")->fetch_array();
        if ($check && $check["id"]) {
            // đã tồn tại
            //$_SESSION['google_access_token'] = $access_token;
            // Cấp cookie cho người dùng
            Cookie($days_of_cookie, 'setcookie', $check['token'], 'AUTH');
            // Update db
            $conn->query("UPDATE users SET ip_addr = '{$ip_addr}', avatar = '{$getUserResult->picture}', name = '{$getUserResult->name}' WHERE google_id = '{$check["google_id"]}'");
            $base->insert_if_not_exists(
                "login_records",
                [
                    "login_time" => time()
                ],
                [
                    "user_email"    => $check['email'],
                    "user_id" => $check["google_id"],
                    "device_id"     => $deviceID,
                    "login_time" => time(),
                    "type" => "google"
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
                    "google_id" => $getUserResult->id
                ],
                [
                    "name"     => $getUserResult->name,
                    "username" => strtolower(SlugURL($getUserResult->name) . rand(1000, 9999)),
                    "password" => md5(rand(100, 999)),
                    "email"    => $getUserResult->email,
                    "token"    => $token,
                    "ip_addr"  => $ip_addr,
                    "address"  => $address,
                    "google_id"  => $getUserResult->id,
                    "avatar"   => $getUserResult->picture,
                    "verified" => 1,
                    "registration_type" => "google"
                ]
            );
            // Cấp cookie cho người dùng
            Cookie($days_of_cookie, 'setcookie', $token, 'AUTH');
        }
        // done
        //echo 'Xin lỗi, bạn đã đăng nhập rồi. Đang chuyển hướng về trang chủ.';
        echo '<script>setTimeout(() => {window.location.href = "/";},100);</script>';
        return;
    }
} else {
    echo 'Đã có lỗi xảy ra. Đang chuyển hướng về trang chủ.';
    echo '<script>setTimeout(() => {window.location.href = "/";},1500);</script>';
    return;
}
