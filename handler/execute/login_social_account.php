<?php
include "../config.php";
$type = isset($_GET["type"]) ? $_GET["type"] : "";
if (isset($users)) {
    echo 'Xin lỗi, bạn đã đăng nhập rồi. Đang chuyển hướng về trang chủ.';
    echo '<script>setTimeout(() => {window.location.href = "/";},1500);</script>';
    return;
}
switch ($type) {
    case 'google':
        $url = 'https://accounts.google.com/o/oauth2/auth?' . http_build_query(array(
            'client_id' => $G_appId,
            'redirect_uri' => $G_appCallback,
            'response_type' => 'code',
            'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
        ));
        header("Location: " . $url);
        exit();
        break;
    case 'facebook':
        // $url = "http://www.facebook.com/dialog/oauth?" . "client_id=" . $F_appId . "&redirect_uri=" . urlencode($F_appCallback) . "&scope=publish_stream,user_photos";
        // header("Location: " . $url);
        // exit();
        break;
    case 'zalo':
        $url = 'https://oauth.zaloapp.com/v4/permission?' . http_build_query(array(
            'app_id' => $Z_appId,
            'redirect_uri' => $Z_appCallback,
            'code_challenge' => $Z_code_challenge,
            'state' => $Z_codeverifier
        ));
        header("Location: " . $url);
        exit();
        break;
    default:
        # code...
        break;
}
