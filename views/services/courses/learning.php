<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/head.php');
// kiểm tra phiên đăng nhập
if (!isset($_COOKIE['AUTH'])) {
    exit('<script>location.href="/home"</script>');
}
$slug = $_GET['slug'];
$course = $conn->query("SELECT * FROM webinars WHERE slug = '{$slug}'", 1)->fetch_array();
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
if (isset($_SESSION['course'])) {
    if (isset($_SESSION['course']['slug'])) {
        if ($_SESSION['course']['slug'] == $slug) {
            $lesson_id = $_SESSION['course']['id'];
            $lesson_action = $_SESSION['course']['action'];
        }
    }
}
$total_TextLessons = $conn->query("SELECT * FROM text_lessons WHERE webinar_id = '{$course['id']}'")->num_rows;
$total_Files = $conn->query("SELECT * FROM files WHERE webinar_id = '{$course['id']}'")->num_rows;
$totalPassed = $conn->query("SELECT * FROM user_passed_lesson WHERE webinar_id = '{$course['id']}' AND email = '{$user_email}'")->num_rows;
$totalLesson = $total_TextLessons + $total_Files;
$progress = $base->info_course($course['id'], $user_email, 'progress');
?>
<!-- passed -->
<?php if ($progress == 100) { ?>

    <div class="d-none" id="passed_lesson">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="section-title font-16 text-dark-blue mb-10">🎉 Thật tuyệt vời 🤩</h1>

            <button type="button" class="btn-close-advertising-modal close-swl btn-transparent d-flex">
                <i data-feather="minimize-2" width="20" height="30"></i>
            </button>
        </div>

        <div class="d-flex align-items-center justify-content-center">
            <img src="https://i.imgur.com/SgV9v0J.gif" class="img-fluid rounded-lg">
        </div>

        <p class="font-14 text-gray mt-20 h1">🎉⚡ Xin chúc mừng <?= $users['name']; ?>, bạn đã hoàn thành khóa học: <?= $course['title']; ?>.</p>
    </div>

<?php } ?>

<div class="loading"></div>
<link rel="stylesheet" href="/assets/default/learning_page/styles.css" />
<div id="app" class="">
    <div class="learning-page">

        <div class="learning-page-navbar d-flex align-items-lg-center justify-content-between flex-column flex-lg-row px-15 px-lg-35 py-10">
            <div class="d-flex align-items-lg-center flex-column flex-lg-row flex-grow-1">

                <div class="learning-page-logo-card d-flex align-items-center justify-content-between justify-content-lg-start">
                    <a class="navbar-brand d-flex align-items-center justify-content-center mr-0" href="/">
                        <img src="https://i.imgur.com/daD12T2.png" class="img-cover" alt="site logo">
                    </a>

                    <div class="d-flex align-items-center d-lg-none ml-20">
                        <a href="/panel/webinars/purchases" class="btn learning-page-navbar-btn btn-sm border-gray200 ml-0 ml-md-10">Khóa học của tôi</a>
                    </div>
                </div>

                <div class="learning-page-progress-card d-flex flex-column">
                    <a href="/course/<?= $course['slug']; ?>" target="_blank" class="learning-page-navbar-title">
                        <span class="font-weight-bold"><?= $course['title']; ?></span>
                    </a>

                    <div class="d-flex align-items-center">
                        <div class="progress course-progress d-flex align-items-center flex-grow-1 bg-white border border-gray200 rounded-sm shadow-none mt-5">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $progress; ?>%" aria-valuenow="<?= $progress; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="ml-10 font-weight-500 font-14 text-gray"><?= $progress; ?>% đã hoàn thành</span>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center mt-5 mt-md-0">

                <div class="d-none align-items-center d-lg-flex">

                    <a href="/course/<?= $course['slug']; ?>" target="_blank" class="btn learning-page-navbar-btn btn-sm border-gray200">Trang khóa học</a>

                    <a href="/panel/webinars/purchases" class="btn learning-page-navbar-btn btn-sm border-gray200 ml-10">Khóa học của tôi</a>
                </div>

                <button id="collapseBtn" type="button" class="btn-transparent ml-auto ml-lg-20">
                    <i data-feather="menu" width="20" height="20" class=""></i>
                </button>
            </div>
        </div>

        <div class="d-flex position-relative">
            <div class="learning-page-content flex-grow-1 bg-info-light p-15">
                <div class="learning-content" id="learning-content">
                    <!-- CONTENT -->
                </div>
            </div>
            <div class="learning-page-tabs show">
                <ul class="nav nav-tabs py-15 d-flex align-items-center justify-content-around" id="tabs-tab" role="tablist">
                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center active" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="true">
                            <i class="learning-page-tabs-icons mr-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g id="Mask_Group_17" clip-path="url(#clip-path)" data-name="Mask Group 17" transform="translate(-25 -410)">
                                        <g id="online-class" transform="translate(25 410)">
                                            <path id="Path_153" d="M22.078 12.319a2.112 2.112 0 0 0 1.922-2.1V3.656a2.112 2.112 0 0 0-2.109-2.109h-6.985A2.112 2.112 0 0 0 12.8 3.656v2.766H4.031a2.112 2.112 0 0 0-2.109 2.109v8.438a2.1 2.1 0 0 0 .121.7h-.777A1.267 1.267 0 0 0 0 18.938a3.52 3.52 0 0 0 3.516 3.516h16.968A3.52 3.52 0 0 0 24 18.938a1.267 1.267 0 0 0-1.266-1.266h-.777a2.1 2.1 0 0 0 .121-.7zM14.2 3.656a.7.7 0 0 1 .7-.7h6.984a.7.7 0 0 1 .7.7v6.562a.7.7 0 0 1-.7.7h-6.509a.7.7 0 0 0-.373.107l-1.418.886.589-1.963a.7.7 0 0 0 .03-.2zm6.281 17.391H3.516a2.112 2.112 0 0 1-2.1-1.969h21.173a2.112 2.112 0 0 1-2.105 1.969zM6.7 12.375a.8.8 0 1 1 .8.8.8.8 0 0 1-.8-.8zm-.375 3c0-.424.548-.8 1.172-.8a1.435 1.435 0 0 1 .885.287.692.692 0 0 1 .287.51v2.3H6.328zm3.75 2.3v-2.3a2.074 2.074 0 0 0-.815-1.608l-.036-.027a2.2 2.2 0 1 0-3.455 0 2.073 2.073 0 0 0-.851 1.634v2.3h-.887a.7.7 0 0 1-.7-.7V8.531a.7.7 0 0 1 .7-.7H12.8v1.816l-.559 1.864a1.4 1.4 0 0 0 2.092 1.6l1.247-.779h5.1v4.641a.7.7 0 0 1-.7.7z" class="cls-3" data-name="Path 153" />
                                            <path id="Path_154" d="M19.125 7.922h-1.5a.7.7 0 0 0 0 1.406h1.5a.7.7 0 0 0 0-1.406z" class="cls-3" data-name="Path 154" />
                                            <path id="Path_155" d="M16.5 5.953h3.75a.7.7 0 0 0 0-1.406H16.5a.7.7 0 0 0 0 1.406z" class="cls-3" data-name="Path 155" />
                                        </g>
                                    </g>
                                </svg>
                            </i>
                            <span class="learning-page-tabs-link-text">Nội Dung</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center" id="quizzes-tab" data-toggle="tab" href="#quizzes" role="tab" aria-controls="quizzes" aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g id="Mask_Group_18" clip-path="url(#clip-path)" data-name="Mask Group 18" transform="translate(-25 -410)">
                                        <g id="task" transform="translate(25 410)">
                                            <path id="Path_156" d="M8.227 6.8h-3.75a.7.7 0 0 0 0 1.406h3.75a.7.7 0 0 0 0-1.406z" class="cls-3" data-name="Path 156" />
                                            <path id="Path_157" d="M8.227 10.547h-3.75a.7.7 0 0 0 0 1.406h3.75a.7.7 0 0 0 0-1.406z" class="cls-3" data-name="Path 157" />
                                            <path id="Path_158" d="M8.227 14.3h-3.75a.7.7 0 0 0 0 1.406h3.75a.7.7 0 0 0 0-1.406z" class="cls-3" data-name="Path 158" />
                                            <path id="Path_159" d="M18.3 12.887V6.468a3.5 3.5 0 0 0-1-2.462l-2.853-2.95A3.538 3.538 0 0 0 11.934 0H2.883a2.112 2.112 0 0 0-2.11 2.109v18.235a2.112 2.112 0 0 0 2.109 2.109H13.75a5.589 5.589 0 1 0 4.55-9.566zM2.18 20.344V2.109a.7.7 0 0 1 .7-.7h9.051a2.124 2.124 0 0 1 1.5.629l2.852 2.95a2.1 2.1 0 0 1 .617 1.48v6.42a5.576 5.576 0 0 0-4.217 8.159h-9.8a.7.7 0 0 1-.7-.7zm15.42 2.25a4.172 4.172 0 1 1 4.219-4.172 4.177 4.177 0 0 1-4.219 4.172z" class="cls-3" data-name="Path 159" />
                                            <path id="Path_160" d="M19.224 16.757a.7.7 0 0 0-.99.09l-1.187 1.424-.269-.538a.7.7 0 0 0-1.258.629l.75 1.5a.7.7 0 0 0 .548.384.716.716 0 0 0 .081 0 .7.7 0 0 0 .54-.253l1.875-2.25a.7.7 0 0 0-.09-.986z" class="cls-3" data-name="Path 160" />
                                            <path id="Path_161" d="M11.977 8.2h.75a.7.7 0 0 0 0-1.406h-.75a.7.7 0 0 0 0 1.406z" class="cls-3" data-name="Path 161" />
                                            <path id="Path_162" d="M13.43 11.25a.7.7 0 0 0-.7-.7h-.75a.7.7 0 0 0 0 1.406h.75a.7.7 0 0 0 .7-.706z" class="cls-3" data-name="Path 162" />
                                        </g>
                                    </g>
                                </svg>
                            </i>
                            <span class="learning-page-tabs-link-text">Luyện Tập</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <!-- <a class="position-relative font-14 d-flex align-items-center" id="certificates-tab" data-toggle="tab" href="#certificates" role="tab" aria-controls="certificates" aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <defs>
                                        <clipPath id="clip-path">
                                            <path id="Rectangle_204" fill="#1f3b64" stroke="#707070" d="M0 0H24V24H0z" data-name="Rectangle 204" transform="translate(25 410)" />
                                        </clipPath>
                                    </defs>
                                    <g id="Mask_Group_19" clip-path="url(#clip-path)" data-name="Mask Group 19" transform="translate(-25 -410)">
                                        <g id="reward" transform="translate(25 410)">
                                            <g id="Group_183" data-name="Group 183">
                                                <g id="Group_182" data-name="Group 182">
                                                    <path id="Path_163" d="M16.423 5.789a7.668 7.668 0 0 0-1.478-.824l-.59 1.406a6.165 6.165 0 0 1 1.181.659z" class="cls-3" data-name="Path 163" />
                                                    <path id="Path_164" d="M18.665 8.291a7.619 7.619 0 0 0-.982-1.373l-1.136 1.018a6.177 6.177 0 0 1 .786 1.1z" class="cls-3" data-name="Path 164" />
                                                    <path id="Path_165" d="M17.855 10.28a6.092 6.092 0 1 1-4.794-4.29l.263-1.5A7.81 7.81 0 0 0 12 4.374a7.618 7.618 0 1 0 7.321 5.479z" class="cls-3" data-name="Path 165" />
                                                    <path id="Path_166" d="M24 12l-1.954-2.692L22.393 6l-3.038-1.355L18 1.607l-3.308.347L12 0 9.308 1.954 6 1.607 4.645 4.645 1.607 6l.347 3.308L0 12l1.954 2.692L1.607 18l3.038 1.354L6 22.393l3.308-.347L12 24l2.692-1.954 3.308.347 1.354-3.038L22.393 18l-.347-3.308zm-5.8 6.2l-1.145 2.56-2.785-.3L12 22.116l-2.27-1.651-2.788.292L5.8 18.2l-2.563-1.148.3-2.782L1.884 12l1.651-2.27-.3-2.788L5.8 5.8l1.145-2.563 2.788.292L12 1.884l2.27 1.651 2.788-.292L18.2 5.8l2.562 1.144-.3 2.782L22.116 12l-1.651 2.27.292 2.788z" class="cls-3" data-name="Path 166" />
                                                    <path id="Path_167" d="M8.726 11.461l-1.078 1.078 2.827 2.827 5.115-5.115-1.079-1.078-4.036 4.037z" class="cls-3" data-name="Path 167" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </i>
                            <span class="learning-page-tabs-link-text">Certificates</span>
                        </a> -->
                    </li>
                </ul>

                <div class="tab-content h-100" id="nav-tabContent">
                    <div class="pb-20 tab-pane fade show active h-100" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <div class="content-tab p-15 pb-50">

                            <div class="accordion-content-wrapper" id="chapterAccordion" role="tablist" aria-multiselectable="true">

                                <?php
                                $chapter_query = $conn->query("SELECT * FROM chapter_content WHERE webinar_id = '{$course['id']}'");
                                if ($chapter_query->num_rows > 0) {
                                    while ($chapter = $chapter_query->fetch_array()) {
                                        $code_random = 'chapter_' . rand(100, 999);
                                        // Đếm số lượng bài giảng text
                                        $partTextLesson = $conn->query("SELECT * FROM text_lessons WHERE webinar_id = '{$course['id']}' AND chapter_id = '{$chapter['chapter_id']}' ")->num_rows;
                                        // Đếm số lượng videos
                                        $partFiles = $conn->query("SELECT * FROM files WHERE webinar_id = '{$course['id']}' AND chapter_id = '{$chapter['chapter_id']}' ")->num_rows;
                                ?>

                                        <!-- CHAPTER: <?= $chapter['title']; ?> -->

                                        <div class="accordion-row bg-white rounded-sm border border-gray200 mb-2">
                                            <div class="d-flex align-items-center justify-content-between p-10" role="tab" id="<?= $code_random; ?>">
                                                <div class="d-flex align-items-center" href="#<?= $code_random; ?>" aria-controls="<?= $code_random; ?>" data-parent="#chapterAccordion" role="button" data-toggle="collapse" aria-expanded="true">
                                                    <span class="chapter-icon mr-10">
                                                        <i data-feather="grid" class="" width="20" height="20"></i>
                                                    </span>

                                                    <div class="">
                                                        <span class="font-weight-bold font-14 text-dark-blue d-block"><?= $chapter['title']; ?></span>

                                                        <span class="font-12 text-gray d-block">
                                                            <?= $partFiles + $partTextLesson; ?> nội dung
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center">
                                                    <i class="collapse-chevron-icon feather-chevron-down text-gray" data-feather="chevron-down" height="20" href="#<?= $code_random; ?>" aria-controls="<?= $code_random; ?>" data-parent="#chapterAccordion" role="button" data-toggle="collapse" aria-expanded="true"></i>
                                                </div>
                                            </div>

                                            <div class="mt-15"></div>

                                            <!-- KẾT THÚC HIỂN THỊ CHAPTER: <?= $chapter['title']; ?> -->

                                            <?php
                                            $text_lesson_query = $conn->query("SELECT * FROM text_lessons WHERE webinar_id = '{$course['id']}' AND chapter_id = '{$chapter['chapter_id']}'");
                                            if ($text_lesson_query->num_rows > 0) {
                                                while ($text_lesson = $text_lesson_query->fetch_array()) {
                                                    $files_ = 'files_' . rand(100, 999);
                                            ?>

                                                    <!-- HIỂN THỊ NỘI DUNG TEXT_LESSON: <?= $text_lesson['title']; ?> -->

                                                    <div id="<?= $code_random; ?>" aria-labelledby="<?= $code_random; ?>" class="collapse" role="tabpanel">
                                                        <div class="panel-collapse text-gray">

                                                            <div class="d-flex align-items-start p-10 cursor-pointer tab-item" onclick="loadContent(<?= $text_lesson['id']; ?>, 'text_lesson');">

                                                                <span class="chapter-icon bg-gray300 mr-10">
                                                                    <i data-feather="file-text" class="text-gray" width="16" height="16"></i>
                                                                </span>

                                                                <div>
                                                                    <div class="">
                                                                        <span class="font-weight-500 font-14 text-dark-blue d-block"><?= $text_lesson['title']; ?></span>
                                                                        <span class="font-12 text-gray d-block">5 Min</span>
                                                                    </div>


                                                                    <div class="tab-item-info mt-15">
                                                                        <p class="font-12 text-gray d-block">
                                                                            <?= $text_lesson['description']; ?>
                                                                        </p>

                                                                        <div class="d-flex align-items-center justify-content-between mt-15">
                                                                            <label class="mb-0 mr-10 cursor-pointer font-weight-normal font-14 text-dark-blue" for="readToggle_textlesson<?= $text_lesson['id']; ?>">Tôi đã hoàn thành</label>
                                                                            <div class="custom-control custom-switch">
                                                                                <?php
                                                                                $checkPassedLesson = $conn->query("SELECT * FROM user_passed_lesson WHERE webinar_id = '{$course['id']}' AND chapter_id = '{$chapter['chapter_id']}' AND webinar_type = 'text_lesson' AND text_lesson_id = '{$text_lesson['id']}' AND email = '{$user_email}'");
                                                                                if ($checkPassedLesson->num_rows > 0) {
                                                                                ?>

                                                                                    <input type="checkbox" id="readToggle_textlesson<?= $text_lesson['id']; ?>" data-item-id="<?= $text_lesson['id']; ?>" data-slug="<?= $slug; ?>" data-item="text_lesson" value="<?= $text_lesson['id']; ?>" class="js-passed-lesson-toggle custom-control-input" disabled checked>
                                                                                    <label for="readToggle_textlesson<?= $text_lesson['id']; ?>" class="custom-control-label"></label>

                                                                                <?php } else { ?>

                                                                                    <input type="checkbox" id="readToggle_textlesson<?= $text_lesson['id']; ?>" data-item-id="<?= $text_lesson['id']; ?>" data-slug="<?= $slug; ?>" data-item="text_lesson" value="<?= $text_lesson['id']; ?>" class="js-passed-lesson-toggle custom-control-input">
                                                                                    <label for="readToggle_textlesson<?= $text_lesson['id']; ?>" class="custom-control-label"></label>

                                                                                <?php } ?>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- KẾT THÚC HIỂN THỊ NỘI DUNG TEXT_LESSON: <?= $text_lesson['title']; ?> -->


                                            <?php }
                                            } ?>

                                            <?php
                                            $files_query = $conn->query("SELECT * FROM files WHERE webinar_id = '{$course['id']}' AND chapter_id = '{$chapter['chapter_id']}' ");
                                            if ($files_query->num_rows > 0) {
                                                while ($files = $files_query->fetch_array()) {
                                                    $files_ = 'files_' . rand(100, 999);
                                                    $length_video = null;
                                                    $file_volume = $files["volume"] != 0 ? $files["volume"] : null;
                                                    // lấy thời lượng video youtube
                                                    if ($files['storage'] == 'online' && $files['file_type'] == "video") {
                                                        $length_video = YoutubeVideoLength(YoutubeVideoID($files['file'])) != false ? YoutubeVideoLength(YoutubeVideoID($files['file'])) : null;
                                                    }
                                                    // lấy dung lượng file
                                                    // if (($files['file_type'] == "document" || $files['file_type'] == "video") && $files['storage'] == "local") {
                                                    //     if ($files['storage'] == "online") {
                                                    //         $file_volume = getFileSize($files["file"], "online") != false ? round(getFileSize($files["file"], "online"), 2) : null;
                                                    //     } else {
                                                    //         $file_volume = getFileSize($files["file"], "local") != false ? round(getFileSize($files["file"], "local"), 2) : null;
                                                    //     }
                                                    // }
                                                    $chapter_icon = 'video';
                                                    if ($files['file_type'] == 'video' && $files['storage'] == 'online') {
                                                        $chapter_icon = 'youtube';
                                                    } elseif ($files['file_type'] == 'document') {
                                                        $chapter_icon = 'archive';
                                                    }
                                            ?>

                                                    <!-- HIỂN THỊ NỘI DUNG VIDEO: <?= $files['title']; ?> -->

                                                    <div id="<?= $code_random; ?>" aria-labelledby="<?= $code_random; ?>" class="collapse" role="tabpanel">
                                                        <div class="panel-collapse text-gray">

                                                            <div class=" d-flex align-items-start p-10 cursor-pointer tab-item" onclick="loadContent(<?= $files['id']; ?>, 'files');">

                                                                <span class="chapter-icon bg-gray300 mr-10">
                                                                    <i data-feather="<?= $chapter_icon; ?>" class="text-gray" width="16" height="16"></i>
                                                                </span>

                                                                <div>
                                                                    <div>
                                                                        <span class="font-weight-500 font-14 text-dark-blue d-block"><?= $files['title']; ?></span>
                                                                        <?php if ($length_video != null) { ?>
                                                                            <span class="font-12 text-gray d-block">Thời lượng: <?= $length_video; ?></span>
                                                                        <?php } ?>

                                                                        <?php if ($file_volume != null) { ?>
                                                                            <span class="font-12 text-gray d-block">Dung lượng: <?= $file_volume; ?> MB</span>
                                                                        <?php } ?>
                                                                    </div>

                                                                    <div class="tab-item-info mt-15">
                                                                        <p class="font-12 text-gray d-block">
                                                                            <?= $files['description']; ?>
                                                                        </p>

                                                                        <div class="d-flex align-items-center justify-content-between mt-15">
                                                                            <label class="mb-0 mr-10 cursor-pointer font-weight-normal font-14 text-dark-blue" for="readTogglefile<?= $files['id']; ?>">Tôi đã hoàn thành</label>
                                                                            <div class="custom-control custom-switch">

                                                                                <?php
                                                                                $checkPassedLesson = $conn->query("SELECT * FROM user_passed_lesson WHERE webinar_id = '{$course['id']}' AND chapter_id = '{$chapter['chapter_id']}' AND webinar_type = 'file_id' AND file_id = '{$files['id']}' AND email = '{$user_email}'");
                                                                                if ($checkPassedLesson->num_rows > 0) {
                                                                                ?>

                                                                                    <input type="checkbox" id="readTogglefile<?= $files['id']; ?>" data-slug="<?= $slug; ?>" data-item-id="<?= $files['id']; ?>" data-item="file_id" value="<?= $files['id']; ?>" class="js-passed-lesson-toggle custom-control-input" disabled checked>
                                                                                    <label class="custom-control-label" for="readTogglefile<?= $files['id']; ?>"></label>


                                                                                <?php } else { ?>

                                                                                    <input type="checkbox" id="readTogglefile<?= $files['id']; ?>" data-slug="<?= $slug; ?>" data-item-id="<?= $files['id']; ?>" data-item="file_id" value="<?= $files['id']; ?>" class="js-passed-lesson-toggle custom-control-input">
                                                                                    <label class="custom-control-label" for="readTogglefile<?= $files['id']; ?>"></label>

                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- KẾT THÚC HIỂN THỊ NỘI DUNG VIDEO: <?= $files['title']; ?> -->

                                            <?php }
                                            } ?>


                                        </div>

                                    <?php }
                                } else { ?>
                                    <div class="learning-page-forum-empty d-flex align-items-center justify-content-center flex-column">
                                        <div class="learning-page-forum-empty-icon d-flex align-items-center justify-content-center">
                                            <img src="https://lms2.rocket-soft.org/assets/default/img/learning/quiz-empty.svg" class="img-fluid" alt="">
                                        </div>

                                        <div class="d-flex align-items-center flex-column mt-10 text-center">
                                            <h3 class="font-20 font-weight-bold text-dark-blue text-center">Chưa có nội dung nào!</h3>
                                            <p class="font-14 font-weight-500 text-gray mt-5 text-center">Khoá học chưa có nội dung được cập nhật!</p>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <!-- quizzes -->

                    <div class="pb-20 tab-pane fade h-100" id="quizzes" role="tabpanel" aria-labelledby="quizzes-tab">

                        <div class="content-tab p-15 pb-50">

                            <?php
                            $quiz_query = $conn->query("select * from quizzes where webinar_id = '{$course["id"]}'");
                            if ($quiz_query->num_rows > 0) {
                                while ($quiz_data = $quiz_query->fetch_assoc()) {
                                    $total_question = $conn->query("select * from quizzes_questions where quiz_id = '{$quiz_data["id"]}'")->num_rows;
                            ?>

                                    <!-- -- -->
                                    <div onclick="window.open('/quizzes/<?= $quiz_data['id']; ?>/prepare','_blank')" class="tab-item p-10 cursor-pointer px-10 border border-gray200 rounded-sm mb-15" data-type="quiz">

                                        <div class="d-flex align-items-center">
                                            <span class="chapter-icon bg-gray300 mr-10">
                                                <i data-feather="award" class="text-gray" width="18" height="18"></i>
                                            </span>

                                            <div class="flex-grow-1">
                                                <span class="font-weight-500 font-14 text-dark-blue d-block"><?= $quiz_data["title"]; ?></span>

                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="font-12 text-gray d-block">
                                                        <?= $quiz_data["time"]; ?> Phút

                                                        | <?= $total_question; ?> Câu hỏi
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- -- -->

                                <?php }
                            } else { ?>

                                <div class="learning-page-forum-empty d-flex align-items-center justify-content-center flex-column">
                                    <div class="learning-page-forum-empty-icon d-flex align-items-center justify-content-center">
                                        <img src="https://lms2.rocket-soft.org/assets/default/img/learning/quiz-empty.svg" class="img-fluid" alt="">
                                    </div>

                                    <div class="d-flex align-items-center flex-column mt-10 text-center">
                                        <h3 class="font-20 font-weight-bold text-dark-blue text-center">Không có bài luyện tập!</h3>
                                        <p class="font-14 font-weight-500 text-gray mt-5 text-center">Khoá học không có bài luyện tập nào!</p>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>

                    </div>

                    <!-- quizzes -->


                    <!-- certificate -->

                    <div class="pb-20 tab-pane fade  h-100" id="certificates" role="tabpanel" aria-labelledby="certificates-tab">
                        <div class="content-tab p-15 pb-50">

                            <div class="course-certificate-item cursor-pointer p-10 border border-gray200 rounded-sm mb-15" data-course-certificate="">
                                <div class="d-flex align-items-center">
                                    <span class="chapter-icon bg-gray300 mr-10">
                                        <i data-feather="award" class="text-gray" width="16" height="16"></i>
                                    </span>

                                    <div class="flex-grow-1">
                                        <span class="font-weight-500 font-14 text-dark-blue d-block">Course certificate</span>

                                        <div class="d-flex align-items-center">
                                            <span class="font-12 text-gray">Not Achieved!</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- certificate -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Template JS File -->
<script src="/assets/default/js/app.js"></script>
<script src="/assets/default/vendors/feather-icons/dist/feather.min.js"></script>
<script src="/assets/default/vendors/moment.min.js"></script>
<script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="/assets/default/vendors/toast/jquery.toast.min.js"></script>
<script type="text/javascript" src="/assets/default/vendors/simplebar/simplebar.min.js"></script>
<script>
    function loadContent(id, action) {
        $(".loading").show();
        $.post("<?= $domain; ?>model/learning/data.php", {
                slug: '<?= $course['slug']; ?>',
                id: id,
                action: action
            })
            .done(function(data) {
                $(".loading").hide();
                $("#learning-content").html('');
                $("#learning-content").empty().append(data);
            });
    }
    <?php if (isset($lesson_id) && isset($lesson_action)) { ?>
        loadContent(<?= $lesson_id; ?>, '<?= $lesson_action; ?>');
    <?php } else { ?>
        loadContent();
    <?php } ?>
</script>
<script type="text/javascript" src="/assets/default/vendors/dropins/dropins.js"></script>
<script src="/assets/learning_page/scripts.min.js"></script>
<script src="/assets/default/js/parts/main.min.js"></script>

</script>
</body>

</html>