<link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
<?php
//sleep(3);
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $action = isset($_POST['action']) ? $_POST['action'] : "";
    $slug = isset($_POST['slug']) ? $_POST['slug'] : "";
    // kiểm tra phiên đăng nhập
    if (!isset($users)) {
        exit('<script>location.href="/home"</script>');
    }
    $course = $conn->query("SELECT * FROM webinars WHERE slug = '{$slug}'", 1)->fetch_array();
    /* KIỂM TRA KHÓA HỌC - NGƯỜI DÙNG */
    // kiểm tra slug webinars
    if (!$course) {
        exit('<script>location.href="/home"</script>');
    }
    $orderItem = $conn->query("SELECT * FROM order_items WHERE webinar_id = '{$course['id']}' AND user_id = '{$users['id']}' ", 1)->fetch_array();
    // kiểm tra người dùng đã tham gia khóa học chưa
    if (!$orderItem) {
        exit('<script>location.href="/home"</script>');
    }
    $orderID = $conn->query("SELECT * FROM orders WHERE trans_id =  '{$orderItem['trans_id']}' AND status = 'success'")->fetch_array();
    // kiểm tra trạng thái orders
    if (!$orderID) {
        exit('<script>location.href="/home"</script>');
    }

    /* -------------------------------- */
    if ($id == "" || $action == "") {
        echo ('<div class="mt-100"></div><div class="form-group text-center"><img src="https://i.imgur.com/rQCNdgH.png" class="img-fluid" alt="Responsive image" style="width:20%;"><p class="mt-25 font-weight-bold">Vui lòng chọn bài học.</p></div>');
    } else {
        $arr = [
            'slug' => $slug,
            'id' => $id,
            'action' => $action
        ];
        $_SESSION['course'] = $arr;
        if ($action == "text_lesson") {
            // Xử lí khóa học dạng chữ
            $text_lesson = $conn->query("SELECT * FROM text_lessons WHERE id = '{$id}' AND webinar_id = '{$course['id']}' ", 1)->fetch_array();
            if ($text_lesson) {
                echo '<div class="text-lesson-content p-15 p-lg-30">' . $text_lesson['content'] . '</div>';
            } else {
                unset($_SESSION['course']);
                exit('<script>location.href="/home"</script>');
            }
        } elseif ($action == "files") {
            // Xử lí khóa học dạng videos
            $files = $conn->query("SELECT * FROM files WHERE id = '{$id}' AND webinar_id = '{$course['id']}' ", 1)->fetch_array();
            if ($files) {
                if ($files['downloadable'] == 0) {
                    $block_download = 'controls controlsList="nodownload"';
                } else {
                    $block_download = '';
                }
                // local video  
                if ($files['storage'] == 'local' && $files['file_type'] == 'video') {
                    echo '<div class="d-flex flex-column p-10 h-100">
                        <div class="learning-content-video-player w-100">
                        <video
                        id="my-video"
                        class="video-js"
                        controls
                        preload="auto"
                        width="640"
                        height="268"
                        poster="' . $course['thumbnail'] . '"
                        data-setup="{}"
                        ' . $block_download . '
                        ><source src="' . $files['file'] . '" type="video/mp4">
                        </video>
                        </div></div>';

                    // youtube video
                } elseif ($files['storage'] == 'online' && $files['file_type'] == 'video') {
                    echo '<div class="d-flex flex-column p-10 h-100">
                        <div class="learning-content-video-player w-100">
                            <video
                                id="my-video"
                                class="video-js"
                                controls
                                preload="auto"
                                width="640"
                                height="268"
                                poster="' . $course['thumbnail'] . '"
                                data-setup=\'{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "' . $files["file"] . '"}], "youtube": { "ytControls": 2 } }\'
                                ' . $block_download . '
                            ><source src="' . $files['file'] . '" type="video/mp4">
                            </video>
                        </div>
                      </div>';
                    // document file
                } else if (($files['storage'] == 'online' || $files['storage'] == 'local') && $files['file_type'] == 'document') {
                    echo '
                    <div class="learning-content" id="learningPageContent">
                        <div class="d-flex align-items-center justify-content-center w-100 h-100">
                        <div class="learning-content-box d-flex align-items-center justify-content-center flex-column p-15 p-lg-30 rounded-lg">
                        <div class="learning-content-box-icon">
                        <img src="/assets/default/img/learning/download.svg" alt="downloadable icon">
                    </div>
                    <h4 class="font-16 font-weight-bold text-dark ">Tải tài liệu xuống máy</h4>
                    <span class="font-14 font-weight-500 text-gray mt-5">Nguồn liên kết bên ngoài</span>
                    <a href="'.$files["file"].'" class="btn btn-primary btn-sm mt-15" target="_blank">Tải xuống ngay</a>
                    </div>
                </div>';
                }
            } else {
                exit('<script>location.href="/home"</script>');
            }
        } else {
            exit('<script>location.href="/home"</script>');
        }
    }


    // METHOD
} else {
    exit('<script>location.href="/home"</script>');
}
?>

<script src="/assets/default/vendors/video//video.min.js"></script>
<script src="/assets/default/vendors/video/youtube.min.js"></script>
<script src="/assets/default/vendors/video/vimeo.js"></script>
