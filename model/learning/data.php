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
                // local video  
                if ($files['storage'] == 'local') {
                    if ($files['downloadable'] == 0) {
                        $block_download = 'controls controlsList="nodownload"';
                    } else {
                        $block_download = '';
                    }
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
                } elseif ($files['storage'] == 'online') {
                    echo '<div class="test-container"><iframe class="responsive-iframe" src="https://www.youtube.com/embed/' . YoutubeVideoID($files['file']) . '" allowfullscreen="" frameborder="0" allowtransparency allow="autoplay"></iframe></div>';
                }
            } else {
                exit('<script>location.href="/home"</script>');
            }
        } else {
            exit('<script>location.href="/home"</script>');
        }


        /** 
         * Download file
         **/

        echo '<div class="d-flex align-items-center justify-content-between rounded-sm mt-15 p-15 border-dashed-gray300">
                <span class="font-weight-bold text-dark">Download the file</span>
                <a href="https://lms2.rocket-soft.org/course/Learn-Python-Programming/file/35/download" class="btn btn-primary btn-sm" target="_blank">Download</a>
            </div>';

        echo '<div class="shadow-sm rounded-lg bg-white px-15 px-md-25 py-20 mt-20">
            <h3 class=" font-16 font-weight-bold text-dark-blue">Attachments</h3>

            <div class="row mt-10">
            <div class="col-12 col-lg-3 mt-10 mt-lg-0">
                    <a href="https://lms2.rocket-soft.org/course/Learn-Python-Programming/file/35/download" class="d-flex align-items-center p-10 border border-gray200 rounded-sm">
                        <span class="chapter-icon bg-gray300 mr-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download-cloud text-gray"><polyline points="8 17 12 21 16 17"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"></path></svg>
                        </span>

                        <div class="">
                            <span class="font-weight-500 font-14 text-dark-blue d-block">Introduction video</span>
                            <span class="font-12 text-gray d-block">mp4 | 7.09 MB</span>
                        </div>
                    </a>
                </div></div>
            </div>';
    }


    // METHOD
} else {
    exit('<script>location.href="/home"</script>');
}
?>

<script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>