<?php
include "../config.php";
$action = isset($_GET["action"]) ? $_GET["action"] : "";
$token = UserToken(50);
$ip_addr = getUserIP();
$deviceID = $_SERVER['HTTP_USER_AGENT'];
# XỬ LÝ ĐĂNG NHẬP TÀI KHOẢN #
if ($action == "login") {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $recaptcha_response = isset($_POST["recaptcha_response"]) ? $_POST["recaptcha_response"] : "";
        $email = $conn->real_escape_string(strip_tags(addslashes($email)));
        $password = $conn->real_escape_string(strip_tags(addslashes($password)));
        # Check recaptcha
        if (Recaptcha($G_Captcha['secret_key'], $recaptcha_response, 'auth')) {
            if (!isset($users)) {
                if ($email == "" || $password == "") {
                    echo swal("Thông báo", "Không được bỏ trống thông tin", "error", false);
                    return;
                }

                if (!validateEmail($email)) {
                    echo swal("Thông báo", "Email không hợp lệ, hãy kiểm tra lại", "error", false);
                    return;
                }

                $checkEmail = $conn->query("SELECT * FROM users WHERE email = '{$email}'")->num_rows;

                if ($checkEmail <= 0) {
                    echo swal("Thông báo", "Email không tồn tại trên hệ thống", "error", false);
                    return;
                }
                $password = $handler->hashPassword($password);
                $get = $conn->query("SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
                if ($get->num_rows > 0) {
                    $user_token = $get->fetch_array();
                    // Cấp cookie cho người dùng
                    Cookie($days_of_cookie, 'setcookie', $user_token['token'], 'AUTH');
                    // Update db
                    $conn->query("UPDATE users SET ip_addr = '{$ip_addr}' WHERE email = '{$email}'");
                    $base->insert_if_not_exists(
                        "login_records",
                        [
                            "login_time" => time()
                        ],
                        [
                            "user_email"    => $user_token['email'],
                            "device_id"     => $deviceID,
                            "login_time" => time()
                        ]
                    );
                    echo swal("Thông báo", "Đăng nhập thành công!", "success", true);
                } else {
                    echo swal("Thông báo", "Email hoặc mật khẩu không chính xác!", "error", false);
                }
            } else {
                echo swal("Cảnh báo", "Phiên đăng nhập đang tồn tại!", "warning", true);
            }
        } else {
            echo swal("Cảnh báo", "Không thể xác minh người dùng!", "warning", false);
        }
    } else {
        echo swal("Cảnh báo", "Phương thức không hợp lệ!", "warning", true);
    }
}


# XỬ LÝ ĐĂNG KÝ TÀI KHOẢN #


if ($action == "register") {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = isset($_POST["name"]) ? $_POST["name"] : "";
        $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $repassword = isset($_POST["repassword"]) ? $_POST["repassword"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $verification_code = isset($_POST["verification_code"]) ? $_POST["verification_code"] : "";
        $name = $conn->real_escape_string(strip_tags(addslashes($name)));
        $phone = $conn->real_escape_string(strip_tags(addslashes($phone)));
        $password = $conn->real_escape_string(strip_tags(addslashes($password)));
        $repassword = $conn->real_escape_string(strip_tags(addslashes($repassword)));
        $email = $conn->real_escape_string(strip_tags(addslashes($email)));
        $verification_code = $conn->real_escape_string(strip_tags(addslashes($verification_code)));
        $recaptcha_response = isset($_POST["recaptcha_response"]) ? $_POST["recaptcha_response"] : "";
        # Check recaptcha
        if (Recaptcha($G_Captcha['secret_key'], $recaptcha_response, 'auth')) {
            if (!isset($users)) {
                if ($name == "" || $phone == "" || $password == "" || $repassword == "" || $email == "" || $verification_code == "") {
                    echo swal("Thông báo", "Không được bỏ trống thông tin", "error", false);
                    return;
                }

                if (!isset($_SESSION['code'])) {
                    echo swal("Thông báo", "Vui lòng ấn gửi mã để nhận mã xác minh", "error", false);
                    return;
                }

                if (!validateEmail($email)) {
                    echo swal("Thông báo", "Email không hợp lệ, hãy kiểm tra lại", "error", false);
                    return;
                }

                if (!validatePhoneNumber($phone)) {
                    echo swal("Thông báo", "Số điện thoại không hợp lệ, hãy kiểm tra lại", "error", false);
                    return;
                }

                if ($password != $repassword) {
                    echo swal("Thông báo", "Vui lòng nhập trường nhập lại mật khẩu giống với mật khẩu vừa nhập", "error", false);
                    return;
                }
                if (requireStrongPassword($password) != 'success') {
                    echo swal("Thông báo", requireStrongPassword($password), "error", false);
                    return;
                }
                $username = GetUsername($name);
                $password = $handler->hashPassword($password);
                $get = $conn->query("SELECT * FROM users WHERE email = '{$email}' OR mobile = '{$phone}'");
                if ($get->num_rows > 0) {
                    echo swal("Thông báo", "Địa chỉ email hoặc số điện thoại đã được đăng ký trước đó", "error", false);
                } else {
                    if ($_SESSION['code'] == $verification_code) {
                        if (!$ip_info = IpInfo($ip_addr)) {
                            $address = 'Không rõ';
                        } else {
                            $address = $ip_info->city . ' / ' . $ip_info->region . ' / ' . $ip_info->country;
                        }
                        $base->insert_if_not_exists(
                            "users",
                            [
                                "email" => $email
                            ],
                            [
                                "email"    => $email,
                                "name"     => $name,
                                "username" => $username,
                                "password" => $password,
                                "mobile"   => $phone,
                                "token"    => $token,
                                "ip_addr"  => $ip_addr,
                                "address"  => $address,
                                "verified" => 1
                            ]
                        );
                        // Cấp cookie cho người dùng
                        Cookie($days_of_cookie, 'setcookie', $token, 'AUTH');
                        echo swal("Thông báo", "Đăng ký tài khoản thành công!", "success", true);
                        // Xóa session email,code
                        unset($_SESSION['email'], $_SESSION['code']);
                    } else {
                        echo swal("Thông báo", "Mã xác minh email sai hoặc đã hết hạn!", "error", false);
                    }
                }
            } else {
                echo swal("Cảnh báo", "Phiên đăng nhập đang tồn tại!", "warning", true);
            }
        } else {
            echo swal("Cảnh báo", "Không thể xác minh người dùng!", "warning", false);
        }
    } else {
        echo swal("Cảnh báo", "Phương thức không hợp lệ!", "warning", true);
    }
}


# THAY ĐỔI THÔNG TIN TÀI KHOẢN #

if ($action == "changeinfo") {
    $username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $name = isset($_POST["name"]) ? $_POST["name"] : "";

    if ($username == "") {
        echo swal("Thông báo", "Bạn cần đăng nhập lại!", "error", true);
        return;
    }

    $get = $conn->query("SELECT * FROM users WHERE username = '{$username}'");
    if ($get->num_rows > 0) {
        $conn->query("UPDATE users SET name = '{$name}', email = '{$email}' WHERE username = '{$username}'");
        echo swal("Thành công", "Cập nhật thông tin thành công", "success", true);
    } else {
        echo swal("Thất bại", "Lỗi vui lòng thử lại", "error", false);
    }
}

if ($action == "changepass") {
    $username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
    $password = isset($_POST["old"]) ? $_POST["old"] : "";
    $new = isset($_POST["new"]) ? $_POST["new"] : "";
    $renew = isset($_POST["renew"]) ? $_POST["renew"] : "";

    $password = $conn->real_escape_string(strip_tags(addslashes($password)));
    $new = $conn->real_escape_string(strip_tags(addslashes($new)));
    $renew = $conn->real_escape_string(strip_tags(addslashes($renew)));

    if ($username == "") {
        echo swal("Thông báo", "Bạn cần đăng nhập lại!", "error", true);
        return;
    }

    $password = $handler->hashPassword($password);

    $get = $conn->query("SELECT * FROM users WHERE password = '{$password}' AND username = '{$username}'");
    if ($get->num_rows > 0) {
        if ($new == $renew) {
            $new = $handler->hashPassword($new);
            $conn->query("UPDATE users SET password = '{$new}' WHERE username = '{$username}'");
            echo swal("Thành công", "Cập nhật thông tin thành công", "success", true);
        } else {
            echo swal("Thất bại", "Nhập lại mật khẩu không chính xác", "error", false);
        }
    } else {
        echo swal("Thất bại", "Mật khẩu cũ không chính xác", "error", false);
    }
}


# ĐĂNG XUẤT PHIÊN NGƯỜI DÙNG #


if ($action == "logout") {
    session_destroy();
    $new_token = UserToken(50);
    if (isset($_COOKIE['AUTH'])) {
        Cookie($days_of_cookie, 'delete', $_COOKIE['AUTH'], 'AUTH');
        header("location: ../../");
    }
}


if ($action == "") {
    header("location: ../../");
}


if ($action == 'user_info') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        if ($email == "") {
            echo swal("Thất bại", "Vui lòng điền địa chỉ email", "error", false);
        } elseif (!validateEmail($email)) {
            echo swal("Thất bại", "Địa chỉ email không hợp lệ", "error", false);
        } else {
            $count = $conn->query("SELECT * FROM users WHERE email = '{$email}'");
            if ($count->num_rows > 0) {
                $user_info = $count->fetch_array();
                $string = $user_info['name'];
                $parts = explode(" ", $string);

                $firstName = $parts[0];
                $firstNameLength = strlen($firstName);
                $maskedFirstName = $firstName[0] . str_repeat("*", $firstNameLength - 1);
                $lastName = $parts[count($parts) - 1];
                $lastNameLength = strlen($lastName);
                $maskedLastName = $lastName[0] . str_repeat("*", $lastNameLength - 1);
                $maskedString = $maskedFirstName . " " . implode(" ", array_slice($parts, 1, -1)) . " " . $maskedLastName;
                echo swal("Thành công", $maskedString, "success", true);
            } else {
                echo swal("Thất bại", "Địa chỉ email không tồn tại", "error", false);
            }
        }
    }
}
