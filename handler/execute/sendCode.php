<?php
include "../config.php";
$action = isset($_GET["action"]) ? $_GET["action"] : "";
$code = 'fp' . random_code();
$ip_addr = getUserIP();
# XÁC MINH EMAIL
if ($action == 'email') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $history_sendEmail = $conn->query("SELECT * FROM send_email WHERE email = '{$email}' AND action = 'register'")->num_rows;
        if ($email == "") {
            echo swal("Thông báo", "Không được bỏ trống thông tin", "error", false);
            return;
        }
        // Kiểm tra người dùng đã thực hiện gửi mã hay chưa
        if ($history_sendEmail > 0) {
            echo swal("Cảnh báo", "Mã đã được gửi vào hòm thư của bạn!", "error", false);
            return;
        }
        // Kiểm tra email có hợp lệ không
        if (!validateEmail($email)) {
            echo swal("Thông báo", "Email không hợp lệ, hãy kiểm tra lại", "error", false);
        } else {
            // Kiểm tra email có tồn tại trên hệ thống hay không
            $get = $conn->query("SELECT * FROM users WHERE email = '{$email}'")->num_rows;
            if ($get > 0) {
                echo swal("Thông báo", "Địa chỉ email đã được đăng ký trước đó", "error", false);
            } else {
                $j = [];
                // Gửi mã xác minh
                if (send_mail($email, 'Verification email', $code, 'register', $j)) {
                    $_SESSION['code'] = $code;
                    $_SESSION['email'] = $email;
                    $msg = 'Đăng ký tài khoản bằng email: ' . $email;
                    $conn->query("INSERT INTO send_email SET email = '{$email}', action = 'register', msg = '{$msg}', code = '{$code}', time = '{$time}'");
                    echo swal("Thông báo", "Mã xác minh đã được gửi!", "success", false);
                } else {
                    // Lỗi gửi mã
                    echo swal("Thông báo", "Có lỗi xảy ra!", "error", false);
                }
            }
        }
    } else {
        echo swal("Cảnh báo", "Phương thức không hợp lệ!", "error", false);
    }

    # ĐẶT LẠI MẬT KHẨU
} elseif ($action == 'reset-password') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        if ($email == "") {
            echo swal("Thông báo", "Không được bỏ trống thông tin", "error", false);
            return;
        }
        // Kiểm tra người dùng đã thực hiện gửi mã hay chưa
        if (isset($_SESSION['email'])) {
            if ($_SESSION['email'] == $email) {
                echo swal("Cảnh báo", "Mã đã được gửi vào hòm thư của bạn!", "error", false);
                return;
            }
        }
        // Kiểm tra email có hợp lệ không
        if (!validateEmail($email)) {
            echo swal("Thông báo", "Email không hợp lệ, hãy kiểm tra lại", "error", false);
        } else {
            // Kiểm tra email có tồn tại trên hệ thống không
            $get = $conn->query("SELECT * FROM users WHERE email = '{$email}'")->num_rows;
            if ($get <= 0) {
                echo swal("Thông báo", "Địa chỉ email không tồn tại trên hệ thống", "error", false);
            } else {
                $info = $conn->query("SELECT * FROM users WHERE email = '{$email}'")->fetch_array();
                // Cấu hình thông tin
                $userAgent = $_SERVER['HTTP_USER_AGENT'];
                // Kiểm tra xem địa chỉ IP có phải là "bogon IP" không
                if (!$ip_info = IpInfo($ip_addr)) {
                    $address = 'Không rõ';
                } else {
                    $address = $ip_info->city . ' / ' . $ip_info->region . ' / ' . $ip_info->country;
                }

                $device = 'Trình duyệt: ' . $browser = getBrowser($userAgent) . ' / ' . 'Hệ điều hành: ' . $operatingSystem = getOperatingSystem($userAgent);
                $arr_user = [
                    'name' => $info['name'],
                    'email' => $email,
                    'time' => date('d/m/Y - H:i:s', time()),
                    'address' => $address,
                    'ip' => $ip_addr,
                    'device' => $device
                ];
                // Gửi mã xác minh
                if (send_mail($email, 'Forget Password', $code, 'reset-password', $arr_user)) {
                    $_SESSION['code'] = $code;
                    $_SESSION['email'] = $email;
                    echo swal("Thông báo", "Mã đặt lại mật khẩu đã được gửi!", "success", false);
                    $msg = 'Đặt lại mật khẩu qua email: ' . $email;
                    $conn->query("INSERT INTO send_email SET email = '{$email}', action = 'reset-password', msg = '{$msg}', code = '{$code}', time = '{$time}'");
                } else {
                    // Lỗi gửi mã
                    echo swal("Thông báo", "Có lỗi xảy ra!", "error", false);
                }
            }
        }
    } else {
        echo swal("Cảnh báo", "Phương thức không hợp lệ!", "error", false);
    }

    # GỬI MẬT KHẨU VỀ EMAIL
} elseif ($action == 'confirm-code') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $confirm_code = isset($_POST["code"]) ? $_POST["code"] : "";
        if ($email == "" || $confirm_code == "") {
            echo swal("Thông báo", "Không được bỏ trống thông tin", "error", false);
            return;
        }
        // Kiểm tra email có hợp lệ không
        if (!validateEmail($email)) {
            echo swal("Thông báo", "Email không hợp lệ, hãy kiểm tra lại", "error", false);
        } else {
            // Kiểm tra email có tồn tại trên hệ thống không
            $get = $conn->query("SELECT * FROM users WHERE email = '{$email}'")->num_rows;
            if ($get <= 0) {
                echo swal("Thông báo", "Địa chỉ email không tồn tại trên hệ thống", "error", false);
            } else {
                $info = $conn->query("SELECT * FROM send_email WHERE email = '{$email}' ORDER BY id DESC")->fetch_array();
                if ($confirm_code == $info['code']) {
                    $j = [];
                    $new_password = UserToken(10);
                    // Gửi mật khẩu qua email
                    if (send_mail($email, 'New Password', $new_password, 'new-password', $j)) {
                        $conn->query("UPDATE `users` SET `password` = '" . md5($new_password) . "' WHERE `email` = '{$email}'");
                        echo swal("Thông báo", "Mật khẩu của bạn đã được gửi qua email!", "success", false);
                        $msg = 'Mật khẩu mới được gửi tới email: ' . $email;
                        $conn->query("INSERT INTO send_email SET email = '{$email}', action = 'new-password', msg = '{$msg}', code = '{$new_password}', time = '{$time}'");
                    } else {
                        // Lỗi gửi mã
                        echo swal("Thông báo", "Có lỗi xảy ra!", "error", false);
                    }
                }
            }
        }
    } else {
        echo swal("Cảnh báo", "Phương thức không hợp lệ!", "error", false);
    }
}
