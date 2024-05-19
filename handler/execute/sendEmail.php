<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/lib/PHPMailer/src/Exception.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/lib/PHPMailer/src/PHPMailer.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/lib/PHPMailer/src/SMTP.php');

function send_mail($recipient, $subject, $message, $action, $arr)
{
    // EMAIL ĐĂNG KÝ TÀI KHOẢN
    if ($action == 'register') {
        $html_content = <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <style type="text/css">
            @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');

            a, body, table, td {
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }

            img {
                -ms-interpolation-mode: bicubic;
            }

            img {
                border: 0;
                height: auto;
                line-height: 100%;
                outline: 0;
                text-decoration: none;
            }

            table {
                border-collapse: collapse !important;
            }

            body {
                height: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }

            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            @media screen and (max-width: 600px) {
                h1 {
                    font-size: 32px !important;
                    line-height: 32px !important;
                }
            }

            div[style*="margin: 16px 0;"] {
                margin: 0 !important;
            }

            a {
                text-decoration: none !important;
            }
        </style>
    </head>

    <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td bgcolor="#FFA73B" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                        <tr>
                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#FFA73B" align="center" style="padding: 0 10px 0 10px">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                        <tr>
                            <td bgcolor="#ffffff" align="center" valign="top"
                                style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0 0; color: #111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px">
                                <h1 style="font-size: 48px; font-weight: 400; margin: 2">Xin chào!</h1>
                                <img src="https://i.imgur.com/WzNUNNT.png" width="125" height="120"
                                    style="display: block; border: 0">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f4f4f4" align="center" style="padding: 0 10px 0 10px">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                        <tr>
                            <td bgcolor="#ffffff" align="left"
                                style="padding: 20px 30px 40px 30px; color: #666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px">
                                <p style="margin: 0">Đây là email xác minh, chúng tôi vừa nhận được yêu cầu xác minh email để đăng ký tài khoản của bạn, mã là:</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#ffffff" align="center"
                                            style="padding: 20px 30px 60px 30px">
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td align="center"
                                                        style="border-radius: 3px; background-color: #FFA73B">
                                                        <strong href="#"
                                                            style="font-size: 32px; font-family: 'Lato', Helvetica, Arial, sans-serif; color: #fff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block">$message</strong>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left"
                                style="padding: 0 30px 0 30px; color: #666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px">
                                <br>
                                <p style="margin: 0; font-weight: 700">Vui lòng không chia sẻ mã cho bất kỳ ai!</p>
                                <p style="margin: 0">Vui lòng sao chép mã và dán vào trường xác minh để tiếp tục.</p>
                                <p style="margin: 0">Trường hợp nếu không phải bạn là người thực hiện thao tác này, hãy bỏ qua email này.</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" align="left"
                                style="padding: 0 30px 40px 30px; border-radius: 0 0 4px 4px; color: #666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px">
                                <br>
                                <p style="margin: 0; font-weight: 700">
                                    Khải,<br>Admin
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0 10px">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                        <tr>
                            <td bgcolor="#FFECD1" align="center"
                                style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px">
                                <h2 style="font-size: 20px; font-weight: 400; color: #111; margin: 0">Bạn cần hỗ trợ?</h2>
                                <p style="margin: 0">
                                    <a href="mailto:lequangkhai.dev@gmail.com" target="_blank"
                                        style="color: #FFA73B">Liên hệ với tôi tại đây</a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td bgcolor="#f4f4f4" align="center" style="padding: 0 10px 0 10px">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                        <tr>
                            <td bgcolor="#f4f4f4" align="left"
                                style="padding: 0 30px 30px 30px; color: #666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px">
                                <br>
                                <p style="margin: 0; text-align: center">
                                    &copy; 2023 - Thiết kế bởi:
                                    <a href="//zalo.me/0387290231" target="_blank"
                                        style="color: #FFA73B; font-weight: 700">Lê Quang Khải</a>.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>

    </html>

    HTML;
        // EMAIL ĐẶT LẠI MẬT KHẨU
    } elseif ($action == 'reset-password') {
        $html_content = <<<HTML
            <!DOCTYPE html
            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">

            <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta name="x-apple-disable-message-reformatting" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="color-scheme" content="light dark" />
            <meta name="supported-color-schemes" content="light dark" />
            <title></title>
            <style type="text/css" rel="stylesheet" media="all">
                /* Base ------------------------------ */

                @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");

                body {
                    width: 100% !important;
                    height: 100%;
                    margin: 0;
                    -webkit-text-size-adjust: none;
                }

                a {
                    color: #3869D4;
                }

                a img {
                    border: none;
                }

                td {
                    word-break: break-word;
                }

                .preheader {
                    display: none !important;
                    visibility: hidden;
                    mso-hide: all;
                    font-size: 1px;
                    line-height: 1px;
                    max-height: 0;
                    max-width: 0;
                    opacity: 0;
                    overflow: hidden;
                }

                /* Type ------------------------------ */

                body,
                td,
                th {
                    font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
                }

                h1 {
                    margin-top: 0;
                    color: #333333;
                    font-size: 22px;
                    font-weight: bold;
                    text-align: left;
                }

                h2 {
                    margin-top: 0;
                    color: #333333;
                    font-size: 16px;
                    font-weight: bold;
                    text-align: left;
                }

                h3 {
                    margin-top: 0;
                    color: #333333;
                    font-size: 14px;
                    font-weight: bold;
                    text-align: left;
                }

                td,
                th {
                    font-size: 16px;
                }

                p,
                ul,
                ol,
                blockquote {
                    margin: .4em 0 1.1875em;
                    font-size: 16px;
                    line-height: 1.625;
                }

                p.sub {
                    font-size: 13px;
                }

                /* Utilities ------------------------------ */

                .align-right {
                    text-align: right;
                }

                .align-left {
                    text-align: left;
                }

                .align-center {
                    text-align: center;
                }

                .u-margin-bottom-none {
                    margin-bottom: 0;
                }

                /* Buttons ------------------------------ */

                .button {
                    background-color: #3869D4;
                    border-top: 10px solid #3869D4;
                    border-right: 18px solid #3869D4;
                    border-bottom: 10px solid #3869D4;
                    border-left: 18px solid #3869D4;
                    display: inline-block;
                    color: #FFF;
                    text-decoration: none;
                    border-radius: 3px;
                    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
                    -webkit-text-size-adjust: none;
                    box-sizing: border-box;
                }

                .button--green {
                    background-color: #22BC66;
                    border-top: 10px solid #22BC66;
                    border-right: 18px solid #22BC66;
                    border-bottom: 10px solid #22BC66;
                    border-left: 18px solid #22BC66;
                }

                .button--red {
                    background-color: #FF6136;
                    border-top: 10px solid #FF6136;
                    border-right: 18px solid #FF6136;
                    border-bottom: 10px solid #FF6136;
                    border-left: 18px solid #FF6136;
                }

                @media only screen and (max-width: 500px) {
                    .button {
                        width: 100% !important;
                        text-align: center !important;
                    }
                }

                /* Attribute list ------------------------------ */

                .attributes {
                    margin: 0 0 21px;
                }

                .attributes_content {
                    background-color: #F4F4F7;
                    padding: 16px;
                }

                .attributes_item {
                    padding: 0;
                }

                /* Related Items ------------------------------ */

                .related {
                    width: 100%;
                    margin: 0;
                    padding: 25px 0 0 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                }

                .related_item {
                    padding: 10px 0;
                    color: #CBCCCF;
                    font-size: 15px;
                    line-height: 18px;
                }

                .related_item-title {
                    display: block;
                    margin: .5em 0 0;
                }

                .related_item-thumb {
                    display: block;
                    padding-bottom: 10px;
                }

                .related_heading {
                    border-top: 1px solid #CBCCCF;
                    text-align: center;
                    padding: 25px 0 10px;
                }

                /* Discount Code ------------------------------ */

                .discount {
                    width: 100%;
                    margin: 0;
                    padding: 24px;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    background-color: #F4F4F7;
                    border: 2px dashed #CBCCCF;
                }

                .discount_heading {
                    text-align: center;
                }

                .discount_body {
                    text-align: center;
                    font-size: 15px;
                }

                /* Social Icons ------------------------------ */

                .social {
                    width: auto;
                }

                .social td {
                    padding: 0;
                    width: auto;
                }

                .social_icon {
                    height: 20px;
                    margin: 0 8px 10px 8px;
                    padding: 0;
                }

                /* Data table ------------------------------ */

                .purchase {
                    width: 100%;
                    margin: 0;
                    padding: 35px 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                }

                .purchase_content {
                    width: 100%;
                    margin: 0;
                    padding: 25px 0 0 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                }

                .purchase_item {
                    padding: 10px 0;
                    color: #51545E;
                    font-size: 15px;
                    line-height: 18px;
                }

                .purchase_heading {
                    padding-bottom: 8px;
                    border-bottom: 1px solid #EAEAEC;
                }

                .purchase_heading p {
                    margin: 0;
                    color: #85878E;
                    font-size: 12px;
                }

                .purchase_footer {
                    padding-top: 15px;
                    border-top: 1px solid #EAEAEC;
                }

                .purchase_total {
                    margin: 0;
                    text-align: right;
                    font-weight: bold;
                    color: #333333;
                }

                .purchase_total--label {
                    padding: 0 15px 0 0;
                }

                body {
                    background-color: #F2F4F6;
                    color: #51545E;
                }

                p {
                    color: #51545E;
                }

                .email-wrapper {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    background-color: #F2F4F6;
                }

                .email-content {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                }

                /* Masthead ----------------------- */

                .email-masthead {
                    padding: 25px 0;
                    text-align: center;
                }

                .email-masthead_logo {
                    width: 94px;
                }

                .email-masthead_name {
                    font-size: 16px;
                    font-weight: bold;
                    color: #A8AAAF;
                    text-decoration: none;
                    text-shadow: 0 1px 0 white;
                }

                /* Body ------------------------------ */

                .email-body {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                }

                .email-body_inner {
                    width: 570px;
                    margin: 0 auto;
                    padding: 0;
                    -premailer-width: 570px;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    background-color: #FFFFFF;
                }

                .email-footer {
                    width: 570px;
                    margin: 0 auto;
                    padding: 0;
                    -premailer-width: 570px;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    text-align: center;
                }

                .email-footer p {
                    color: #A8AAAF;
                }

                .body-action {
                    width: 100%;
                    margin: 30px auto;
                    padding: 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    text-align: center;
                }

                .body-sub {
                    margin-top: 25px;
                    padding-top: 25px;
                    border-top: 1px solid #EAEAEC;
                }

                .content-cell {
                    padding: 45px;
                }

                /*Media Queries ------------------------------ */

                @media only screen and (max-width: 600px) {

                    .email-body_inner,
                    .email-footer {
                        width: 100% !important;
                    }
                }

                @media (prefers-color-scheme: dark) {

                    body,
                    .email-body,
                    .email-body_inner,
                    .email-content,
                    .email-wrapper,
                    .email-masthead,
                    .email-footer {
                        background-color: #333333 !important;
                        color: #FFF !important;
                    }

                    p,
                    ul,
                    ol,
                    blockquote,
                    h1,
                    h2,
                    h3,
                    span,
                    .purchase_item {
                        color: #FFF !important;
                    }

                    .attributes_content,
                    .discount {
                        background-color: #222 !important;
                    }

                    .email-masthead_name {
                        text-shadow: none !important;
                    }
                }

                :root {
                    color-scheme: light dark;
                    supported-color-schemes: light dark;
                }

                /* table {
                    font-family: arial, sans-serif;
                    border-collapse: collapse;
                    width: 100%;
                }

                td,
                th {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }

                tr:nth-child(even) {
                    background-color: #dddddd;
                } */
            </style>
            <!--[if mso]>
            <style type="text/css">
            .f-fallback  {
                font-family: Arial, sans-serif;
            }
            </style>
            <![endif]-->
            </head>

            <body>
            <span class="preheader">Use this link to reset your password. The link is only valid for 24 hours.</span>
            <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="center">
                        <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="email-masthead">
                                    <a href="#" class="f-fallback email-masthead_name">
                                        🚀 K EDU SYSTEM
                                    </a>
                                </td>
                            </tr>
                            <!-- Email Body -->
                            <tr>
                                <td class="email-body" width="570" cellpadding="0" cellspacing="0">
                                    <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0"
                                        role="presentation">
                                        <!-- Body content -->
                                        <tr>
                                            <td class="content-cell">
                                                <div class="f-fallback">
                                                    <h1>👋 Xin chào {$arr['name']},</h1>
                                                    <p>Gần đây, bạn đã yêu cầu đặt lại mật khẩu cho tài khoản có địa chỉ email:
                                                        📧 $recipient. <br>Sử dụng mã bên dưới để đặt lại. Việc đặt lại mật khẩu
                                                        này chỉ có
                                                        hiệu lực trong 24 giờ tới.</strong></p>
                                                    <p>Sao chép mã bên dưới</p>
                                                    <!-- Action -->
                                                    <table class="body-action" align="center" width="100%" cellpadding="0"
                                                        cellspacing="0" role="presentation">
                                                        <tr>
                                                            <td align="center">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                                    role="presentation">
                                                                    <tr>
                                                                        <td align="center">
                                                                            <a type="button"
                                                                                class="f-fallback button button--red">$message</a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <p>Thông tin người gửi yêu cầu đặt lại mật khẩu</p>
                                                    <ul>
                                                        <li>⏱️: {$arr['time']}</li>
                                                        <li>🗺️: {$arr['address']}</li>
                                                        <li>🌐: {$arr['ip']}</li>
                                                        <li>💻: {$arr['device']}</li>
                                                    </ul>
                                                    <!-- <p>For security, this request was received from a {{operating_system}}
                                                        device using {{browser_name}}. If you did not request a password reset,
                                                        please ignore this email or <a href="{{support_url}}">contact
                                                            support</a> if you have questions.</p> -->
                                                    <p>Cảm ơn,
                                                        <br>Đội Ngũ K EDU
                                                    </p>
                                                    <!-- Sub copy -->
                                                    <table role="presentation">
                                                        <tr>
                                                            <td>
                                                                <p class="f-fallback sub" style="text-align: center;">Nếu không
                                                                    phải bạn thực hiện thao tác,
                                                                    hãy bỏ qua email này.</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <hr>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0"
                                        role="presentation">
                                        <tr>
                                            <td class="content-cell" align="center">
                                                <p class="f-fallback sub align-center" style="font-weight: bold;">
                                                    🚀 K EDU SYSTEM
                                                    <br>
                                                    Thiết kế bởi: Lê Quang Khải
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            </body>

            </html>
        HTML;

        // EMAIL GỬI MẬT KHẨU MỚI
    } elseif ($action == 'new-password') {

        $html_content = <<<HTML
                <!DOCTYPE html
            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta name="x-apple-disable-message-reformatting" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="color-scheme" content="light dark" />
            <meta name="supported-color-schemes" content="light dark" />
            <title></title>
            <style type="text/css" rel="stylesheet" media="all">
                /* Base ------------------------------ */

                @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");

                body {
                    width: 100% !important;
                    height: 100%;
                    margin: 0;
                    -webkit-text-size-adjust: none;
                }

                a {
                    color: #3869D4;
                }

                a img {
                    border: none;
                }

                td {
                    word-break: break-word;
                }

                .preheader {
                    display: none !important;
                    visibility: hidden;
                    mso-hide: all;
                    font-size: 1px;
                    line-height: 1px;
                    max-height: 0;
                    max-width: 0;
                    opacity: 0;
                    overflow: hidden;
                }

                /* Type ------------------------------ */

                body,
                td,
                th {
                    font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
                }

                h1 {
                    margin-top: 0;
                    color: #333333;
                    font-size: 22px;
                    font-weight: bold;
                    text-align: left;
                }

                h2 {
                    margin-top: 0;
                    color: #333333;
                    font-size: 16px;
                    font-weight: bold;
                    text-align: left;
                }

                h3 {
                    margin-top: 0;
                    color: #333333;
                    font-size: 14px;
                    font-weight: bold;
                    text-align: left;
                }

                td,
                th {
                    font-size: 16px;
                }

                p,
                ul,
                ol,
                blockquote {
                    margin: .4em 0 1.1875em;
                    font-size: 16px;
                    line-height: 1.625;
                }

                p.sub {
                    font-size: 13px;
                }

                /* Utilities ------------------------------ */

                .align-right {
                    text-align: right;
                }

                .align-left {
                    text-align: left;
                }

                .align-center {
                    text-align: center;
                }

                .u-margin-bottom-none {
                    margin-bottom: 0;
                }

                /* Buttons ------------------------------ */

                .button {
                    background-color: #3869D4;
                    border-top: 10px solid #3869D4;
                    border-right: 18px solid #3869D4;
                    border-bottom: 10px solid #3869D4;
                    border-left: 18px solid #3869D4;
                    display: inline-block;
                    color: #FFF;
                    text-decoration: none;
                    border-radius: 3px;
                    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
                    -webkit-text-size-adjust: none;
                    box-sizing: border-box;
                }

                .button--green {
                    background-color: #22BC66;
                    border-top: 10px solid #22BC66;
                    border-right: 18px solid #22BC66;
                    border-bottom: 10px solid #22BC66;
                    border-left: 18px solid #22BC66;
                }

                .button--red {
                    background-color: #FF6136;
                    border-top: 10px solid #FF6136;
                    border-right: 18px solid #FF6136;
                    border-bottom: 10px solid #FF6136;
                    border-left: 18px solid #FF6136;
                }

                @media only screen and (max-width: 500px) {
                    .button {
                        width: 100% !important;
                        text-align: center !important;
                    }
                }

                /* Attribute list ------------------------------ */

                .attributes {
                    margin: 0 0 21px;
                }

                .attributes_content {
                    background-color: #F4F4F7;
                    padding: 16px;
                }

                .attributes_item {
                    padding: 0;
                }

                /* Related Items ------------------------------ */

                .related {
                    width: 100%;
                    margin: 0;
                    padding: 25px 0 0 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                }

                .related_item {
                    padding: 10px 0;
                    color: #CBCCCF;
                    font-size: 15px;
                    line-height: 18px;
                }

                .related_item-title {
                    display: block;
                    margin: .5em 0 0;
                }

                .related_item-thumb {
                    display: block;
                    padding-bottom: 10px;
                }

                .related_heading {
                    border-top: 1px solid #CBCCCF;
                    text-align: center;
                    padding: 25px 0 10px;
                }

                /* Discount Code ------------------------------ */

                .discount {
                    width: 100%;
                    margin: 0;
                    padding: 24px;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    background-color: #F4F4F7;
                    border: 2px dashed #CBCCCF;
                }

                .discount_heading {
                    text-align: center;
                }

                .discount_body {
                    text-align: center;
                    font-size: 15px;
                }

                /* Social Icons ------------------------------ */

                .social {
                    width: auto;
                }

                .social td {
                    padding: 0;
                    width: auto;
                }

                .social_icon {
                    height: 20px;
                    margin: 0 8px 10px 8px;
                    padding: 0;
                }

                /* Data table ------------------------------ */

                .purchase {
                    width: 100%;
                    margin: 0;
                    padding: 35px 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                }

                .purchase_content {
                    width: 100%;
                    margin: 0;
                    padding: 25px 0 0 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                }

                .purchase_item {
                    padding: 10px 0;
                    color: #51545E;
                    font-size: 15px;
                    line-height: 18px;
                }

                .purchase_heading {
                    padding-bottom: 8px;
                    border-bottom: 1px solid #EAEAEC;
                }

                .purchase_heading p {
                    margin: 0;
                    color: #85878E;
                    font-size: 12px;
                }

                .purchase_footer {
                    padding-top: 15px;
                    border-top: 1px solid #EAEAEC;
                }

                .purchase_total {
                    margin: 0;
                    text-align: right;
                    font-weight: bold;
                    color: #333333;
                }

                .purchase_total--label {
                    padding: 0 15px 0 0;
                }

                body {
                    background-color: #F2F4F6;
                    color: #51545E;
                }

                p {
                    color: #51545E;
                }

                .email-wrapper {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    background-color: #F2F4F6;
                }

                .email-content {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                }

                /* Masthead ----------------------- */

                .email-masthead {
                    padding: 25px 0;
                    text-align: center;
                }

                .email-masthead_logo {
                    width: 94px;
                }

                .email-masthead_name {
                    font-size: 16px;
                    font-weight: bold;
                    color: #A8AAAF;
                    text-decoration: none;
                    text-shadow: 0 1px 0 white;
                }

                /* Body ------------------------------ */

                .email-body {
                    width: 100%;
                    margin: 0;
                    padding: 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                }

                .email-body_inner {
                    width: 570px;
                    margin: 0 auto;
                    padding: 0;
                    -premailer-width: 570px;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    background-color: #FFFFFF;
                }

                .email-footer {
                    width: 570px;
                    margin: 0 auto;
                    padding: 0;
                    -premailer-width: 570px;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    text-align: center;
                }

                .email-footer p {
                    color: #A8AAAF;
                }

                .body-action {
                    width: 100%;
                    margin: 30px auto;
                    padding: 0;
                    -premailer-width: 100%;
                    -premailer-cellpadding: 0;
                    -premailer-cellspacing: 0;
                    text-align: center;
                }

                .body-sub {
                    margin-top: 25px;
                    padding-top: 25px;
                    border-top: 1px solid #EAEAEC;
                }

                .content-cell {
                    padding: 45px;
                }

                /*Media Queries ------------------------------ */

                @media only screen and (max-width: 600px) {

                    .email-body_inner,
                    .email-footer {
                        width: 100% !important;
                    }
                }

                @media (prefers-color-scheme: dark) {

                    body,
                    .email-body,
                    .email-body_inner,
                    .email-content,
                    .email-wrapper,
                    .email-masthead,
                    .email-footer {
                        background-color: #333333 !important;
                        color: #FFF !important;
                    }

                    p,
                    ul,
                    ol,
                    blockquote,
                    h1,
                    h2,
                    h3,
                    span,
                    .purchase_item {
                        color: #FFF !important;
                    }

                    .attributes_content,
                    .discount {
                        background-color: #222 !important;
                    }

                    .email-masthead_name {
                        text-shadow: none !important;
                    }
                }

                :root {
                    color-scheme: light dark;
                    supported-color-schemes: light dark;
                }

                /* table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td,
            th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            } */
            </style>
            <!--[if mso]>
        <style type="text/css">
        .f-fallback  {
            font-family: Arial, sans-serif;
        }
        </style>
        <![endif]-->
        </head>

        <body>
            <span class="preheader">Use this link to reset your password. The link is only valid for 24 hours.</span>
            <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="center">
                        <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td class="email-masthead">
                                    <a href="#" class="f-fallback email-masthead_name">
                                        🚀 K EDU SYSTEM
                                    </a>
                                </td>
                            </tr>
                            <!-- Email Body -->
                            <tr>
                                <td class="email-body" width="570" cellpadding="0" cellspacing="0">
                                    <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0"
                                        role="presentation">
                                        <!-- Body content -->
                                        <tr>
                                            <td class="content-cell">
                                                <div class="f-fallback">
                                                    <h1>👋 Xin chào!</h1>
                                                    <p>Mật khẩu của bạn đã được đặt lại, vui lòng đăng nhập và đổi mật khẩu để
                                                        bảo mật tài khoản, xin cảm ơn!</p>
                                                    <!-- Action -->
                                                    <table class="body-action" align="center" width="100%" cellpadding="0"
                                                        cellspacing="0" role="presentation">
                                                        <tr>
                                                            <td align="center">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                                    role="presentation">
                                                                    <tr>
                                                                        <td align="center">
                                                                            <a type="button"
                                                                                class="f-fallback button button--red">$message</a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!-- <p>For security, this request was received from a {{operating_system}}
                                                    device using {{browser_name}}. If you did not request a password reset,
                                                    please ignore this email or <a href="{{support_url}}">contact
                                                        support</a> if you have questions.</p> -->
                                                    <p>Cảm ơn,
                                                        <br>Đội Ngũ K EDU
                                                    </p>
                                                    <!-- Sub copy -->
                                                    <table role="presentation">
                                                        <tr>
                                                            <td>
                                                                <p class="f-fallback sub" style="text-align: center;">Nếu không
                                                                    phải bạn thực hiện thao tác,
                                                                    hãy bỏ qua email này.</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <hr>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0"
                                        role="presentation">
                                        <tr>
                                            <td class="content-cell" align="center">
                                                <p class="f-fallback sub align-center" style="font-weight: bold;">
                                                    🚀 K EDU SYSTEM
                                                    <br>
                                                    Thiết kế bởi: Lê Quang Khải
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>

        </html>
    HTML;
    } elseif ($action == 'course-order') {
        $html_content = <<<HTML
                                    <!DOCTYPE HTML
                                        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
                                        xmlns:o="urn:schemas-microsoft-com:office:office">

                                    <head>
                                        <!--[if gte mso 9]>
                                    <xml>
                                    <o:OfficeDocumentSettings>
                                        <o:AllowPNG/>
                                        <o:PixelsPerInch>96</o:PixelsPerInch>
                                    </o:OfficeDocumentSettings>
                                    </xml>
                                    <![endif]-->
                                        <!-- Fonts -->
                                        <link href='https://fonts.googleapis.com/css?family=Plus Jakarta Sans' rel='stylesheet'>
                                        <link rel="stylesheet"
                                            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
                                        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                        <meta name="x-apple-disable-message-reformatting">
                                        <!--[if !mso]><!-->
                                        <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
                                        <title></title>

                                        <style type="text/css">
                                            * {
                                                font-family: 'Plus Jakarta Sans';
                                                font-weight: 1000;
                                            }

                                            @media only screen and (min-width: 660px) {
                                                .u-row {
                                                    width: 640px !important;
                                                }

                                                .u-row .u-col {
                                                    vertical-align: top;
                                                }

                                                .u-row .u-col-100 {
                                                    width: 640px !important;
                                                }

                                            }

                                            @media (max-width: 660px) {
                                                .u-row-container {
                                                    max-width: 100% !important;
                                                    padding-left: 0px !important;
                                                    padding-right: 0px !important;
                                                }

                                                .u-row .u-col {
                                                    min-width: 320px !important;
                                                    max-width: 100% !important;
                                                    display: block !important;
                                                }

                                                .u-row {
                                                    width: 100% !important;
                                                }

                                                .u-col {
                                                    width: 100% !important;
                                                }

                                                .u-col>div {
                                                    margin: 0 auto;
                                                }
                                            }

                                            body {
                                                margin: 0;
                                                padding: 0;
                                            }

                                            table,
                                            tr,
                                            td {
                                                vertical-align: top;
                                                border-collapse: collapse;
                                            }

                                            p {
                                                margin: 0;
                                            }

                                            .ie-container table,
                                            .mso-container table {
                                                table-layout: fixed;
                                            }

                                            * {
                                                line-height: inherit;
                                            }

                                            a[x-apple-data-detectors='true'] {
                                                color: inherit !important;
                                                text-decoration: none !important;
                                            }

                                            table,
                                            td {
                                                color: #000000;
                                            }

                                            #u_body a {
                                                color: #0000ee;
                                                text-decoration: underline;
                                            }
                                        </style>



                                    </head>

                                    <body class="clean-body u_body"
                                        style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #e7e7e7;color: #000000">
                                        <!--[if IE]><div class="ie-container"><![endif]-->
                                        <!--[if mso]><div class="mso-container"><![endif]-->
                                        <table id="u_body"
                                            style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #e7e7e7;width:100%"
                                            cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr style="vertical-align: top">
                                                    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #e7e7e7;"><![endif]-->


                                                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                                            <div class="u-row"
                                                                style="Margin: 0 auto;min-width: 320px;max-width: 640px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                                                <div
                                                                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px;"><tr style="background-color: #ffffff;"><![endif]-->

                                                                    <!--[if (mso)|(IE)]><td align="center" width="640" style="width: 640px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                                                    <div class="u-col u-col-100"
                                                                        style="max-width: 320px;min-width: 640px;display: table-cell;vertical-align: top;">
                                                                        <div style="height: 100%;width: 100% !important;">
                                                                            <!--[if (!mso)&(!IE)]><!-->
                                                                            <div
                                                                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                                                <!--<![endif]-->

                                                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation"
                                                                                    cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:arial,helvetica,sans-serif;"
                                                                                                align="left">

                                                                                                <table width="100%" cellpadding="0" cellspacing="0"
                                                                                                    border="0">
                                                                                                    <tr>
                                                                                                        <td style="padding-right: 0px;padding-left: 0px;"
                                                                                                            align="center">

                                                                                                            <img align="center" border="0"
                                                                                                                src="https://img.upanh.tv/2023/06/30/Logo_green-removebg-preview.png"
                                                                                                                alt="Image" title="Image"
                                                                                                                style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 35%;max-width: 224px;"
                                                                                                                width="224" />

                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                                <!--[if (!mso)&(!IE)]><!-->
                                                                            </div><!--<![endif]-->
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                                            <div class="u-row"
                                                                style="Margin: 0 auto;min-width: 320px;max-width: 640px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #35c661;">
                                                                <div
                                                                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px;"><tr style="background-color: #35c661;"><![endif]-->

                                                                    <!--[if (mso)|(IE)]><td align="center" width="640" style="width: 640px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                                                    <div class="u-col u-col-100"
                                                                        style="max-width: 320px;min-width: 640px;display: table-cell;vertical-align: top;">
                                                                        <div style="height: 100%;width: 100% !important;">
                                                                            <!--[if (!mso)&(!IE)]><!-->
                                                                            <div
                                                                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                                                <!--<![endif]-->

                                                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation"
                                                                                    cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:50px 10px 0px;font-family:arial,helvetica,sans-serif;"
                                                                                                align="left">

                                                                                                <div
                                                                                                    style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                                                                    <p
                                                                                                        style="font-size: 14px; line-height: 140%; text-align: center;">
                                                                                                        <span
                                                                                                            style="color: #ffffff; font-size: 22px; line-height: 30.8px;"><strong><span
                                                                                                                    style="line-height: 30.8px; font-size: 22px;"><span
                                                                                                                        style="line-height: 30.8px; font-size: 22px;">👋 Xin chào {$arr['name']}, đơn hàng của bạn đã hoàn tất </span>&nbsp;</span></strong></span>
                                                                                                    </p>
                                                                                                    <p
                                                                                                        style="font-size: 14px; line-height: 140%; text-align: center;">
                                                                                                        <span
                                                                                                            style="color: #ffffff; font-size: 44px; line-height: 61.6px;"><strong><span
                                                                                                                    style="line-height: 61.6px; font-size: 44px;">Thật tuyệt vời 🎉</span></strong></span>
                                                                                                    </p>
                                                                                                </div>

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation"
                                                                                    cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:0px 60px 30px;font-family:arial,helvetica,sans-serif;"
                                                                                                align="left">

                                                                                                <div
                                                                                                    style="font-size: 14px; color: #ffffff; line-height: 150%; text-align: left; word-wrap: break-word;">
                                                                                                    <p style="line-height: 150%;">Đây là email thông báo rằng, bạn đã thanh toán thành công khóa học {$arr['webinar_title']}</p>
                                                                                                </div>

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                                <!--[if (!mso)&(!IE)]><!-->
                                                                            </div><!--<![endif]-->
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                                            <div class="u-row"
                                                                style="Margin: 0 auto;min-width: 320px;max-width: 640px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                                                <div
                                                                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px;"><tr style="background-color: #ffffff;"><![endif]-->

                                                                    <!--[if (mso)|(IE)]><td align="center" width="640" style="width: 640px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                                                    <div class="u-col u-col-100"
                                                                        style="max-width: 320px;min-width: 640px;display: table-cell;vertical-align: top;">
                                                                        <div style="height: 100%;width: 100% !important;">
                                                                            <!--[if (!mso)&(!IE)]><!-->
                                                                            <div
                                                                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                                                <!--<![endif]-->

                                                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation"
                                                                                    cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                                                                                align="left">

                                                                                                <table width="100%" cellpadding="0" cellspacing="0"
                                                                                                    border="0">
                                                                                                    <tr>
                                                                                                        <td style="padding-right: 0px;padding-left: 0px;"
                                                                                                            align="center">

                                                                                                            <img align="center" border="0"
                                                                                                                src="{$arr['webinar_image']}"
                                                                                                                alt="" title=""
                                                                                                                style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 260px;"
                                                                                                                width="260" />

                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation"
                                                                                    cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                                                                                align="left">

                                                                                                <div
                                                                                                    style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                                                                    <p
                                                                                                        style="font-size: 14px; line-height: 140%; text-align: center;">
                                                                                                        <span
                                                                                                            style="font-size: 22px; line-height: 30.8px;"><strong>{$arr['webinar_title']}</strong></span>
                                                                                                    </p>
                                                                                                </div>

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation"
                                                                                    cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                                                                                align="left">

                                                                                                <div
                                                                                                    style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                                                                    <p
                                                                                                        style="font-size: 14px; line-height: 140%; text-align: center;">
                                                                                                        <span
                                                                                                            style="font-size: 16px; line-height: 22.4px;">{$arr['webinar_price']}đ</span>
                                                                                                    </p>
                                                                                                    <p
                                                                                                        style="font-size: 14px; line-height: 140%; text-align: center;">
                                                                                                        <span
                                                                                                            style="font-size: 16px; line-height: 22.4px;">Phương thức thanh toán: {$arr['webinar_payment_method']}</span>
                                                                                                    </p>
                                                                                                    <p
                                                                                                        style="font-size: 14px; line-height: 140%; text-align: center;">
                                                                                                        <span
                                                                                                            style="font-size: 16px; line-height: 22.4px;">Thời gian: {$arr['webinar_time']}</span>
                                                                                                    </p>
                                                                                                </div>

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation"
                                                                                    cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                                                                                align="left">

                                                                                                <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                                <!--[if (!mso)&(!IE)]><!-->
                                                                            </div><!--<![endif]-->
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                                            <div class="u-row"
                                                                style="Margin: 0 auto;min-width: 320px;max-width: 640px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                                                <div
                                                                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px;"><tr style="background-color: #ffffff;"><![endif]-->

                                                                    <!--[if (mso)|(IE)]><td align="center" width="640" style="width: 640px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                                                    <div class="u-col u-col-100"
                                                                        style="max-width: 320px;min-width: 640px;display: table-cell;vertical-align: top;">
                                                                        <div style="height: 100%;width: 100% !important;">
                                                                            <!--[if (!mso)&(!IE)]><!-->
                                                                            <div
                                                                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                                                <!--<![endif]-->

                                                                                <table style="font-family:arial,helvetica,sans-serif;" role="presentation"
                                                                                    cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px;font-family:arial,helvetica,sans-serif;"
                                                                                                align="left">

                                                                                                <div
                                                                                                    style="font-size: 14px; line-height: 140%; text-align: left; word-wrap: break-word;">
                                                                                                    <p
                                                                                                        style="font-size: 14px; line-height: 140%; text-align: center;">
                                                                                                        <strong>Liên hệ với chúng tôi nếu bạn có bất kì thắc mắc nào.</strong>
                                                                                                    </p>
                                                                                                </div>

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                                <!--[if (!mso)&(!IE)]><!-->
                                                                            </div><!--<![endif]-->
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                                            <div class="u-row"
                                                                style="Margin: 0 auto;min-width: 320px;max-width: 640px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                                                <div
                                                                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px;"><tr style="background-color: #ffffff;"><![endif]-->

                                                                    <!--[if (mso)|(IE)]><td align="center" width="640" style="width: 640px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                                                    <div class="u-col u-col-100"
                                                                        style="max-width: 320px;min-width: 640px;display: table-cell;vertical-align: top;">
                                                                        <div style="height: 100%;width: 100% !important;">
                                                                            <!--[if (!mso)&(!IE)]><!-->
                                                                            <div
                                                                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                                                <!--<![endif]-->

                                                                                <!--[if (!mso)&(!IE)]><!-->
                                                                            </div><!--<![endif]-->
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                                            <div class="u-row"
                                                                style="Margin: 0 auto;min-width: 320px;max-width: 640px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                                                <div
                                                                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px;"><tr style="background-color: #ffffff;"><![endif]-->

                                                                    <!--[if (mso)|(IE)]><td align="center" width="640" style="width: 640px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                                                    <div class="u-col u-col-100"
                                                                        style="max-width: 320px;min-width: 640px;display: table-cell;vertical-align: top;">
                                                                        <div style="height: 100%;width: 100% !important;">
                                                                            <!--[if (!mso)&(!IE)]><!-->
                                                                            <div
                                                                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                                                <!--<![endif]-->

                                                                                <!--[if (!mso)&(!IE)]><!-->
                                                                            </div><!--<![endif]-->
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                                            <div class="u-row"
                                                                style="Margin: 0 auto;min-width: 320px;max-width: 640px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                                                <div
                                                                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px;"><tr style="background-color: transparent;"><![endif]-->

                                                                    <!--[if (mso)|(IE)]><td align="center" width="640" style="width: 640px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                                                    <div class="u-col u-col-100"
                                                                        style="max-width: 320px;min-width: 640px;display: table-cell;vertical-align: top;">
                                                                        <div style="height: 100%;width: 100% !important;">
                                                                            <!--[if (!mso)&(!IE)]><!-->
                                                                            <div
                                                                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                                                <!--<![endif]-->

                                                                                <table class="addressContent"
                                                                                    style="font-family:arial,helvetica,sans-serif;" role="presentation"
                                                                                    cellpadding="0" cellspacing="0" width="100%" border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:6px 10px 8px;font-family:arial,helvetica,sans-serif;"
                                                                                                align="left">

                                                                                                <div
                                                                                                    style="font-size: 14px; color: #000000; line-height: 160%; text-align: left; word-wrap: break-word;">
                                                                                                    <p style="line-height: 160%; text-align: center;">
                                                                                                        <strong>Designed by Le Quang Khai</strong>
                                                                                                    </p>
                                                                                                </div>

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                                <!--[if (!mso)&(!IE)]><!-->
                                                                            </div><!--<![endif]-->
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                                            <div class="u-row"
                                                                style="Margin: 0 auto;min-width: 320px;max-width: 640px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                                                <div
                                                                    style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                                                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:640px;"><tr style="background-color: transparent;"><![endif]-->

                                                                    <!--[if (mso)|(IE)]><td align="center" width="640" style="width: 640px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                                                    <div class="u-col u-col-100"
                                                                        style="max-width: 320px;min-width: 640px;display: table-cell;vertical-align: top;">
                                                                        <div style="height: 100%;width: 100% !important;">
                                                                            <!--[if (!mso)&(!IE)]><!-->
                                                                            <div
                                                                                style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                                                <!--<![endif]-->

                                                                                <table class="logoContent" style="font-family:arial,helvetica,sans-serif;"
                                                                                    role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                                                    border="0">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;"
                                                                                                align="left">

                                                                                                <table width="100%" cellpadding="0" cellspacing="0"
                                                                                                    border="0">
                                                                                                    <tr>
                                                                                                        <td style="padding-right: 0px;padding-left: 0px;"
                                                                                                            align="center">
                                                                                                            <a href="//zalo.me/0387290231"
                                                                                                                target="_blank">
                                                                                                                <img align="center" border="0"
                                                                                                                    src="https://img.upanh.tv/2023/06/30/K.png"
                                                                                                                    alt="Image" title="Image"
                                                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 7%;max-width: 43.4px;"
                                                                                                                    width="43.4" />
                                                                                                            </a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>

                                                                                <!--[if (!mso)&(!IE)]><!-->
                                                                            </div><!--<![endif]-->
                                                                        </div>
                                                                    </div>
                                                                    <!--[if (mso)|(IE)]></td><![endif]-->
                                                                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--[if mso]></div><![endif]-->
                                        <!--[if IE]></div><![endif]-->
                                    </body>

                                    </html>

        HTML;
    }


    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = 'lequangkhai.dev@gmail.com';
    $mail->Password   = "wyybrvmwtvxbbtlt";

    $mail->IsHTML(true);
    $mail->AddAddress($recipient, "Account security");
    $mail->SetFrom("lequangkhai.dev@gmail.com", "Account security");
    $mail->Subject = $subject;
    $mail->IsHTML(true);
    $mail->Body = $html_content;
    if (!$mail->Send()) {
        return false;
    } else {
        return true;
    }
}
