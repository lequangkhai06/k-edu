<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://i.imgur.com/C6FKr4f.png" type="image/x-icon" />
    <link rel="shortcut icon" href="https://i.imgur.com/C6FKr4f.png" type="image/x-icon" />
    <title>Trang Không Tồn Tại</title>
    <!--Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300&display=swap" rel="stylesheet">
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <style>
        body {
            font-family: "Montserrat", sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Montserrat", sans-serif;
        }

        .page-section {
            background-image: url("https://i.imgur.com/qC1L9AP.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .page-section .content-detail {
            height: 100vh;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .page-section .content-detail .sub-title,
        .page-section .content-detail .detail-text {
            font-weight: bold;
            display: block;
            color: #1f3b64;
            text-align: center;
        }

        .page-section .content-detail .sub-title {
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 30px;
        }

        .page-section .content-detail .global-title {
            display: block;
            color: #5bc86d;
            font-size: 150px;
            font-weight: 800;
        }

        .page-section .content-detail .global-title span {
            -webkit-animation: animateblur 1s linear forwards;
            animation: animateblur 1s linear forwards;
        }

        .page-section .content-detail .global-title span:nth-child(1) {
            -webkit-animation-delay: 1s;
            animation-delay: 1s;
        }

        .page-section .content-detail .global-title span:nth-child(2) {
            -webkit-animation-delay: 2s;
            animation-delay: 2s;
        }

        .page-section .content-detail .global-title span:nth-child(3) {
            -webkit-animation-delay: 3s;
            animation-delay: 3s;
        }

        @-webkit-keyframes animateblur {
            0% {
                opacity: 0;
                -webkit-filter: blur(10px);
                filter: blur(10px);
            }

            100% {
                opacity: 1;
                -webkit-filter: blur(0px);
                filter: blur(0px);
            }
        }

        @keyframes animateblur {
            0% {
                opacity: 0;
                -webkit-filter: blur(10px);
                filter: blur(10px);
            }

            100% {
                opacity: 1;
                -webkit-filter: blur(0px);
                filter: blur(0px);
            }
        }

        .page-section .content-detail .back-btn {
            margin-top: 15px;
        }

        .page-section .content-detail .back-btn .btn {
            font-weight: bold;
            padding: 8px 15px;
            color: #1f3b64;
            border: 1px solid #1f3b64;
            border-radius: 30px;
            font-size: 14px;
        }

        .page-section .content-detail .back-btn .btn:hover {
            background-color: #1f3b64;
            color: #fff;
        }

        /* Responsive css */
        @media (max-width: 768px) {
            .page-section .content-detail {
                padding: 0 15px;
            }

            .page-section .content-detail .global-title {
                font-size: 120px;
                font-weight: 700;
            }

            .page-section .content-detail .sub-title {
                font-weight: 500;
                font-size: 25px;
            }

            .page-section .content-detail .detail-text {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .page-section .content-detail {
                padding: 0 15px;
            }

            .page-section .content-detail .global-title {
                font-size: 80px;
                font-weight: 600;
            }

            .page-section .content-detail .sub-title {
                font-weight: 500;
                font-size: 22px;
            }
        }
    </style>
    <section class="page-section">
        <div class="full-width-screen">
            <div class="container-fluid">
                <div class="content-detail">
                    <h1 class="global-title"><span>4</span><span>0</span><span>4</span></h1>

                    <h4 class="sub-title">Oops!</h4>

                    <h2 class="detail-text">Thật sự xin lỗi,<br>
                        Không tìm thấy nội dung 😓</h2>
                    <div class="mt-4"></div>
                    <p class="detail-text">URL của nội dung này đã bị thay đổi hoặc không còn tồn tại.<br>
                        Nếu bạn đang lưu URL này, hãy thử liên hệ với quản trị viên website để biết thêm chi tiết.</p>
                    <div class="back-btn">
                        <a href="/home" class="btn">Trở Về Trang Chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>