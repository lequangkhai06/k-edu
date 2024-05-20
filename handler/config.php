<?php
session_start();
// production
if ($_SERVER["SERVER_NAME"] != "localhost") {
    error_reporting(1);
}
mysqli_report(MYSQLI_REPORT_OFF);
require "class/database.class.php";
require "class/handler.class.php";
require "class/settings.class.php";
require "class/pagination.class.php";
require "execute/sendEmail.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Tên miền website
$domain = "https://" . $_SERVER["SERVER_NAME"] . "/";

// Database config
$database = [
    "db_server" => "localhost",
    "db_username" => "root",
    "db_pass" => "",
    "db_name" => "lms",
];

// Google recaptcha v3
$G_Captcha = [
    'site_key'   => '6Lc-sSYjAAAAAFxAKHUh6n-GhszXk27Cu9m_ekBc',
    'secret_key' => '6Lc-sSYjAAAAAJWIQCdiLiUNBKSdHgBwNZe7bxM4'
];

// Config chuyển hướng thanh toán
$Url_Redirect = [
    'momo' => $domain . 'payment/momo',
    'vnpay' => $domain . 'payment/vnpay',
    'coins' => $domain . 'payment/coins'
];

// Config thông tin Zalo app
$Z_appId = '3576324161655738071';
$Z_secretKey = 'IK7G8FwBUOL9W6B2E2JD';
$Z_appCallback = $domain . 'handler/callback/callback_zalo.php';
$Z_codeverifier = bin2hex(random_bytes(32));
$Z_code_verifier_hash = hash('sha256', $Z_codeverifier, true);
$Z_code_challenge  = rtrim(strtr(base64_encode($Z_code_verifier_hash), '+/', '-_'), '=');

// Config thông tin Facebook app
$F_appId = '814542126242600';
$F_appCallback = $domain . 'handler/callback/callback_facebook.php';
$F_secretKey = '7421e4be2e76022897b4dc3b98bd38d0';

// Config thông tin Google app
$G_appId = '60709926827-q667gamjpk0nvp6krd8r7o5j1odudrml.apps.googleusercontent.com';
$G_secretKey = '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';
$G_appCallback = $domain . 'handler/callback/callback_google.php';

// Config thông tin thanh toán qua VnPay
$vnp_TmnCode = "7OW3423U";
$vnp_HashSecret = "KYM0I9HVCLG5CCG051IO0T2XBII8RAUG";
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = $Url_Redirect['vnpay'];
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

// Link request hiện tại
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Kết nối db
$conn = new mysqli($database["db_server"], $database["db_username"], $database["db_pass"], $database["db_name"]);

// Kiểm tra kết nối
if ($conn->connect_errno) {
    echo "Lỗi kết nối cơ sở dữ liệu: " . $conn->connect_error;
    exit();
}
$conn->set_charset("utf8");
$handler = new KHAIDZHANDLER($conn);
$base = new KHAIDZ($conn);
$site = $_SERVER['SERVER_NAME'];
$root = $_SERVER["DOCUMENT_ROOT"];
$date = time();
$days_of_cookie = 7;
$settings_site = $conn->query("SELECT * FROM settings WHERE type = 'SETTING'", 1)->fetch_array();
$settings_shop = json_decode($settings_site['detail'], true);
$time = date('d/m/Y - H:i:s', $date);
if (isset($_COOKIE['AUTH'])) {
    $token = $_COOKIE['AUTH'];
    $users = $conn->query("SELECT * FROM users WHERE token = '{$token}'")->fetch_array();
    if ($users) {
        //User is authenticated
        $level = $users["level"];
        $user_id = $users['id'];
        $user_email = $users['email'];
        $user_coins = $users['coins'];
        //MOMO Config
        $MOMO_Phone = '0387290231';
        $MOMO_Trans_Code = 'napmomo' . $user_id;
        $MOMO_Name = 'Le Quang Khai';
    }
} else {
    $user_email = '';
    $user_coins = 0;
    $user_id = 0;
}
function random_code()
{
    $number = rand(100000, 999999);
    return $number;
}

function getAccessToken($app_id, $post_login_url, $app_secret, $code)
{
    $token_url = "https://graph.facebook.com/oauth/" . "access_token?" . "client_id=" .  $app_id . "&redirect_uri=" . urlencode($post_login_url) . "&client_secret=" . $app_secret . "&code=" . $code;
    $response = file_get_contents($token_url);
    $params = null;
    parse_str($response, $params);
    return ($params['access_token']);
}

function swal($title, $message, $type, $reload = false)
{
    return json_encode(array("title" => $title, "message" => $message, "type" => $type, "reload" => $reload), JSON_UNESCAPED_UNICODE);
}
function SlugURL($urlString)
{
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $urlString);
    return $slug;
}
function FormatPrice($num)
{
    // switch ($case) {
    // case 'real':
    //     if ($num <= 0) {
    //         return 'Miễn Phí';
    //     } else {
    //         return number_format($num) . 'đ';
    //     }
    //     break;
    // case 'off':
    //     $price = $num / 100 * $percent;
    //     return number_format($price) . 'đ';
    //     break;
    // default:
    //     return false;
    //     break;
    if ($num <= 0) {
        return 'Miễn Phí';
    } else {
        return number_format($num) . 'đ';
    }

    // }
}
function StarsRating($stars)
{
    $stars = intval($stars);
    for ($x = 0; $x < $stars; $x++) {
        echo '<i data-feather="star" width="20" height="20" class="active"></i>';
    }
    for ($j = 0; $j < 5 - $stars; $j++) {
        echo '<i data-feather="star" width="20" height="20" class=""></i>';
    }
}
function status_webshop($status)
{
    switch ($status) {
        case 'on':
            $type_status = "<span class='badge badge-success'>Hoạt Động</span>";
            break;
        case 'off':
            $type_status = "<span class='badge badge-danger'>Bảo Trì</span>";
            break;
        default:
            $type_status = "<span class='badge badge-success'>Hoạt Động</span>";
            break;
    }
    return $type_status;
}

function rank_users($rank)
{
    switch ($rank) {
        case 'member':
            $type_rank = "Thành Viên";
            break;
        case 'idol':
            $type_rank = "KOL/Idol";
            break;
        case 'corators':
            $type_rank = "Cộng Tác Viên";
            break;
        case 'admin':
            $type_rank = "Quản Trị Viên";
            break;
        default:
            $type_rank = "Thành Viên";
            break;
    }
    return $type_rank;
}

function status_game($i)
{
    if ($i == 0) {
        $status = "<span class='badge badge-success'>Hiển Thị</span>";
    }
    if ($i == 1) {
        $status = "<span class='badge badge-danger'>Ẩn</span>";
    }
    return $status;
}

function status_card($i)
{
    if ($i == 0) {
        $status = "<span class='badge badge-secondary font-weight-bold'>Chờ duyệt</span>";
    }
    if ($i == 1) {
        $status = "<span class='badge badge-primary font-weight-bold'>Thành công</span>";
    }
    if ($i == 2) {
        $status = "<span class='badge badge-danger font-weight-bold'>Thẻ sai</span>";
    }
    if ($i == 3) {
        $status = "<span class='badge badge-info font-weight-bold'>Sai mệnh giá</span>";
    }
    return $status;
}

function status_withdraw($i)
{
    if ($i == 0) {
        $status = "<span class='badge badge-warning'>Chờ duyệt</span>";
    }
    if ($i == 1) {
        $status = "<span class='badge badge-success'>Thành công</span>";
    }
    if ($i == 2) {
        $status = "<span class='badge badge-danger'>Thất bại</span>";
    }
    return $status;
}

function status($i)
{
    if ($i == 0) {
        $status = "<span class='badge badge-warning'>Chờ duyệt</span>";
    }
    if ($i == 1) {
        $status = "<span class='badge badge-success'>Hoạt động</span>";
    }
    if ($i == 2) {
        $status = "<span class='badge badge-danger'>Đã hủy</span>";
    }
    return $status;
}

function time_ago($time)
{
    $time_difference = time() - $time;

    if ($time_difference < 1) {
        return 'vừa xong';
    }
    $condition = array(
        12 * 30 * 24 * 60 * 60 =>  'năm',
        30 * 24 * 60 * 60       =>  'tháng',
        24 * 60 * 60            =>  'ngày',
        60 * 60                 =>  'giờ',
        60                      =>  'phút',
        1                       =>  'giây'
    );

    foreach ($condition as $secs => $str) {
        $d = $time_difference / $secs;

        if ($d >= 1) {
            $t = round($d);
            return $t . ' ' . $str . ($t > 1 ? '' : '') . ' trước';
        }
    }
}

function count_callback_time($time)
{
    $time_difference = $time;

    if ($time_difference < 1) {
        return 'vừa xong';
    }
    $condition = array(
        12 * 30 * 24 * 60 * 60 =>  'năm',
        30 * 24 * 60 * 60       =>  'tháng',
        24 * 60 * 60            =>  'ngày',
        60 * 60                 =>  'giờ',
        60                      =>  'phút',
        1                       =>  'giây'
    );

    foreach ($condition as $secs => $str) {
        $d = $time_difference / $secs;

        if ($d >= 1) {
            $t = round($d);
            return $t . ' ' . $str . ($t > 1 ? '' : '');
        }
    }
}


function UserLevel($status)
{
    if ($status == 'member') {
        return 'Học viên';
    } elseif ($status == 'instructor') {
        return 'Giáo viên';
    } elseif ($status == 'admin') {
        return 'Quản trị viên';
    } else {
        return 'Không xác định';
    }
}

function UserToken($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = random_int(0, strlen($characters) - 1);
        $token .= $characters[$randomIndex];
    }

    return $token;
}

function Recaptcha($secret_key, $recaptcha_response, $action)
{
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = $secret_key;
    $recaptcha_response = $recaptcha_response;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $recaptcha_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response
    )));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $arrResponse = json_decode($response, true);
    # CHECK CAPTCHA V3
    if ($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
        return true;
    } else {
        return false;
    }
}

function validateEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function GetUsername($name)
{
    // Loại bỏ các ký tự không phải chữ cái và số
    $username = preg_replace('/[^a-zA-Z0-9]/', '', $name);

    // Chuyển đổi thành chữ thường
    $username = strtolower($username);

    return $username . rand(1000, 9999);
}


function validatePhoneNumber($phoneNumber)
{
    // Loại bỏ các ký tự không phải số
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    // Kiểm tra độ dài số điện thoại
    $phoneNumberLength = strlen($phoneNumber);
    if ($phoneNumberLength < 10 || $phoneNumberLength > 11) {
        return false;
    }

    // Kiểm tra số điện thoại bắt đầu bằng 0 (đối với số điện thoại trong nước)
    if ($phoneNumberLength == 10 && $phoneNumber[0] != '0') {
        return false;
    }

    // Kiểm tra số điện thoại bắt đầu bằng +84 (đối với số điện thoại quốc tế)
    if ($phoneNumberLength == 11 && substr($phoneNumber, 0, 3) != '+84') {
        return false;
    }

    return true;
}


function getUserIP()
{
    // Kiểm tra nếu địa chỉ IP được chuyển qua Proxy
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}


function requireStrongPassword($password)
{
    // Kiểm tra độ dài mật khẩu
    if (strlen($password) < 8) {
        return 'Yêu cầu mật khẩu có ít nhất 8 ký tự.';
        //return false;
    }

    // Kiểm tra chữ hoa
    if (!preg_match('/[A-Z]/', $password)) {
        return 'Yêu cầu mật khẩu chứa ít nhất một chữ hoa.';
        //return false;
    }

    // Kiểm tra chữ thường
    if (!preg_match('/[a-z]/', $password)) {
        return 'Yêu cầu mật khẩu chứa ít nhất một chữ thường.';
        //return false;
    }

    // Kiểm tra số
    if (!preg_match('/[0-9]/', $password)) {
        return 'Yêu cầu mật khẩu chứa ít nhất một chữ số.';
    }

    // Kiểm tra ký tự đặc biệt
    if (!preg_match('/[\W_]/', $password)) {
        return 'Yêu cầu mật khẩu chứa ít nhất một ký tự đặc biệt.';
    }

    return 'success';
}

function Cookie($days, $action, $value, $name)
{
    switch ($action) {
        case 'setcookie':
            $cookieExpiration = time() + ($days * 24 * 60 * 60);
            if (setcookie($name, $value, $cookieExpiration, "/")) {
                return true;
            } else {
                return false;
            }
            break;

        default:
            $expiration = time() - ($days * 24 * 60 * 60);
            if (setcookie($name, '', $expiration, "/")) {
                return true;
            } else {
                return false;
            }
            break;
    }
}

// Hàm lấy thông tin về trình duyệt
function getBrowser($userAgent)
{
    $browser = "Unknown";

    if (preg_match('/MSIE/i', $userAgent) && !preg_match('/Opera/i', $userAgent)) {
        $browser = 'Internet Explorer';
    } elseif (preg_match('/Firefox/i', $userAgent)) {
        $browser = 'Mozilla Firefox';
    } elseif (preg_match('/Chrome/i', $userAgent)) {
        $browser = 'Google Chrome';
    } elseif (preg_match('/Safari/i', $userAgent)) {
        $browser = 'Apple Safari';
    } elseif (preg_match('/Opera/i', $userAgent)) {
        $browser = 'Opera';
    } elseif (preg_match('/Netscape/i', $userAgent)) {
        $browser = 'Netscape';
    }

    return $browser;
}

// Hàm lấy thông tin về hệ điều hành
function getOperatingSystem($userAgent)
{
    $os = "Unknown";

    if (preg_match('/linux/i', $userAgent)) {
        $os = 'Linux';
    } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
        $os = 'Mac';
    } elseif (preg_match('/windows|win32/i', $userAgent)) {
        $os = 'Windows';
    }

    return $os;
}

// Hàm lấy thông tin người dùng qua địa chỉ IP
function IpInfo($ip)
{
    /**
    Examples
    stdClass Object ( [ip] => 171.234.11.243 [hostname] => dynamic-ip-adsl.viettel.vn [city] => Gia Nghĩa [region] => Ðắk Nông [country] => VN [loc] => 12.0042,107.6907 [org] => AS7552 Viettel Group [postal] => 65150 [timezone] => Asia/Ho_Chi_Minh [readme] => https://ipinfo.io/missingauth )
     **/
    // Khởi tạo cURL
    $ch = curl_init();

    // Cấu hình các tham số cho cURL
    curl_setopt($ch, CURLOPT_URL, "https://ipinfo.io/{$ip}/json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Thực hiện yêu cầu
    $response = curl_exec($ch);

    // Đóng cURL
    curl_close($ch);

    if ($response) {
        $data = json_decode($response);
        if (isset($data->bogon)) {
            return false;
        }
        return $data;
    }
}

// Hàm lấy id video youtube
function YoutubeVideoID($url)
{
    $parts = parse_url($url);
    if (isset($parts['query'])) {
        parse_str($parts['query'], $qs);
        if (isset($qs['v'])) {
            return $qs['v'];
        } else if (isset($qs['vi'])) {
            return $qs['vi'];
        }
    }
    if (isset($parts['path'])) {
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path) - 1];
    }
    return false;
}


// Hàm lấy thông tin độ dài video từ Youtube api
function YoutubeVideoLength($videoId)
{
    $apiKey = "AIzaSyCBhRUgzxj3MwWUE_aBQWwAEPs9vTuivlU";

    // URL API YouTube để lấy thông tin video
    $apiUrl = "https://www.googleapis.com/youtube/v3/videos?id={$videoId}&part=contentDetails&key={$apiKey}";

    // Khởi tạo cURL
    $ch = curl_init();

    // Cấu hình cURL
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Thực thi cURL và lấy dữ liệu trả về
    $response = curl_exec($ch);

    // Đóng cURL
    curl_close($ch);

    // Chuyển đổi chuỗi JSON sang mảng PHP
    $data = json_decode($response, true);

    // Kiểm tra và lấy thông tin độ dài video
    if (isset($data['items'][0]['contentDetails']['duration'])) {
        $duration = $data['items'][0]['contentDetails']['duration'];

        // Sử dụng DateInterval để chuyển đổi ISO 8601
        $interval = new DateInterval($duration);
        $seconds = ($interval->d * 24 * 60 * 60) +
            ($interval->h * 60 * 60) +
            ($interval->i * 60) +
            $interval->s;

        // Chuyển đổi từ giây sang định dạng hh:mm:ss
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    return false;
}

/** Momo test request **/
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

// lấy dung lượng file
function getFileSize($file_path, $act)
{
    switch ($act) {
        case 'online':
            $ch = curl_init($file_path);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $data = curl_exec($ch);
            if (curl_errno($ch)) {
                curl_close($ch);
                return false;
            }
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_code != 200) {
                curl_close($ch);
                return false;
            }
            $file_size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
            curl_close($ch);
            if ($file_size == -1) {
                return false;
            }
            $file_size_mb = $file_size / 1024 / 1024;

            return $file_size_mb;
            break;
        case 'local':
            if (file_exists($file_path)) {
                $file_size = filesize($file_path);
                $file_size_mb = $file_size / 1024 / 1024;

                return $file_size_mb;
            } else {
                return false;
            }
            break;
        default:
            # code...
            break;
    }
}
