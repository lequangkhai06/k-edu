<?php
// Kiểm tra cookie
if (isset($_COOKIE['AUTH'])) {
    if ($_COOKIE['AUTH'] != $users['token']) {
        header("Location: /logout");
        exit();
    }
}
// Kiểm tra csrf-token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo $_SESSION['csrf_token']; ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name='robots' content="index, follow, all">

    <meta name="description" content="home page Description">
    <meta property="og:description" content="home page Description">
    <meta name='twitter:description' content='home page Description'>

    <link rel='shortcut icon' type='image/x-icon' href="https://i.imgur.com/C6FKr4f.png">
    <meta name="theme-color" content="#fff">
    <!-- Windows Phone -->
    <meta name="msapplication-starturl" content="/">
    <meta name="msapplication-TileColor" content="#FFF">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.html">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-title" content="LMS SYSTEM">
    <link rel="apple-touch-icon" href="https://i.imgur.com/BLxXt20.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta property='og:site_name' content=''>
    <meta property='og:image' content='https://i.imgur.com/BLxXt20.png'>
    <meta name='twitter:image' content='https://i.imgur.com/BLxXt20.png'>
    <meta property='og:type' content='website'>

    <title>K - EDU</title>
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Plus Jakarta Sans' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- General CSS File -->
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/toast/jquery.toast.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/simplebar/simplebar.css">
    <link rel="stylesheet" href="/assets/default/css/app.css">
    <link rel="stylesheet" href="/assets/default/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/owl-carousel2/owl.carousel.min.css">
    <!-- Boxicons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.1.1/css/pro.min.css">
    <!-- Recaptcha v3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?= $G_Captcha['site_key']; ?>"></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- sweetalert2 -->
    <script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- placeholder-loading -->
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <!-- Clipboardjs -->
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
    <!-- Swiper -->
    <link rel="stylesheet" href="/assets/default/vendors/swiper/swiper-bundle.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <!-- Pusher realtime -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <!-- Lazyload image -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.0/lazysizes.min.js" async=""></script>
    <!-- time-zone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>

    <!-- Pacejs -->
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script>
        window.paceOptions = {
            ajax: true
        };
    </script>
</head>
<?php
// session_destroy();
?>
<body>