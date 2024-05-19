<?php
$router = empty($_GET['router']) ? "home" : $_GET['router'];
include 'handler/config.php';
if (!isset($_not_nav)) {
    include 'layouts/head.php';
}
include 'layouts/nav.php';
switch ($router) {
    case 'home':
        include 'layouts/home.php';
        break;
    case 'login':
        if (isset($_COOKIE['AUTH'])) {
            echo "<script>Swal.fire('Có lỗi', 'Xin lỗi, bạn đã đăng nhập rồi!', 'error').then(function () {
            	window.location.href='/home';
            });</script>";
            exit;
        }
        include 'views/auth/login.php';
        break;
    case 'register':
        if (isset($_COOKIE['AUTH'])) {
            echo "<script>Swal.fire('Có lỗi', 'Xin lỗi, bạn đã đăng ký rồi!', 'error').then(function () {
                    window.location.href='/home';
                });</script>";
            exit;
        }
        include 'views/auth/register.php';
        break;
        // case 'forget-password':
        //     if (isset($_COOKIE['AUTH'])) {
        //         echo "<script>Swal.fire('Có lỗi', 'Xin lỗi, bạn đã đăng nhập rồi!', 'error').then(function () {
        //                     window.location.href='/home';
        //                 });</script>";
        //         exit;
        //     }
        //     include 'views/forget-password.php';
        //     break;
    default:
        include 'layouts/home.php';
        break;
}
if (!isset($_not_nav)) {
    include 'layouts/footer.php';
}
