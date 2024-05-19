<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/handler/config.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/head.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/nav.php');
$slug = $_GET['slug'];
$course = $conn->query("SELECT * FROM webinars WHERE slug = '{$slug}'", 1)->fetch_array();
if (!$course) {
    die('<script>location.href="/home"</script>');
}
$category = $conn->query("SELECT * FROM categories WHERE id = '{$course['category_id']}'", 1)->fetch_array();
$author = $conn->query("SELECT * FROM users WHERE id = '{$course['teacher_id']}'")->fetch_array();
$total_TextLessons = $conn->query("SELECT * FROM text_lessons WHERE webinar_id = '{$course['id']}'")->num_rows;
$total_Files = $conn->query("SELECT * FROM files WHERE webinar_id = '{$course['id']}'")->num_rows;
$total_Review = $conn->query("SELECT * FROM webinar_reviews WHERE webinar_id = '{$course['id']}' AND status = 'active'")->num_rows;
?>
<link rel="stylesheet" href="/assets/default/css/css-stars.css">
<link rel="stylesheet" href="/assets/default/vendors/video/video-js.min.css">
<section class="course-cover-container not-active-special-offer">
    <img data-src="<?= $course['image_cover']; ?>" class="lazy img-cover course-cover-img" />

    <div class="cover-content pt-40">
        <div class="container position-relative">
        </div>
    </div>
</section>

<section class="container course-content-section text_lesson ">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="course-content-body user-select-none">
                <div class="course-body-on-cover text-white">
                    <h1 class="font-30 course-title">
                        <?= $course['title']; ?>
                    </h1>

                    <span class="d-block font-16 mt-10">Danh mục: <a href="/categories/<?= $category['slug']; ?>" target="_blank" class="font-weight-500 text-white"><?= $category['title']; ?></a></span>
                    <!-- <span class="d-block font-16 mt-10">ID: <a class="font-weight-500 text-white"><?= $course['id']; ?></a></span> -->

                    <div class="d-flex align-items-center">
                        <div class="stars-card d-flex align-items-center mt-15">
                            <?php
                            // Tính trung bình đánh giá
                            $get = $conn->query("SELECT * FROM `webinar_reviews` WHERE `webinar_id` = '{$course['id']}' AND status = 'active'");
                            $total = 0;
                            $i_stars = 0;
                            while ($row = mysqli_fetch_array($get)) {
                                $total = $total + $row['rates'];
                                $i_stars++;
                            }
                            if ($i_stars != 0) {
                                $res = $total / $i_stars;
                            } else {
                                $res = 0;
                            }
                            ?>
                            <?= StarsRating($res); ?>
                            <?php if (intval($res) != 0) { ?>

                                <span class="badge badge-primary ml-10"><?= round($res, 2); ?></span>

                            <?php } ?>
                        </div>
                        <span class="ml-10 mt-15 font-14">(<?= $i_stars; ?> Đánh giá)</span>
                    </div>

                    <div class="mt-15">
                        <span class="font-14">Tác giả:</span>
                        <a href="/users/profile/<?= $author['id']; ?>" target="_blank" class="text-white font-14 font-weight-500"><?= $author['name']; ?></a>
                    </div>

                    <?php if (isset($users)) { ?>

                        <?php if ($base->checkUserCourse($course['id'], $users['id'])) { ?>

                            <?php $progress = $base->info_course($course['id'], $user_email, 'progress'); ?>
                            <div class="mt-10 d-flex align-items-center">
                                <div class="progress course-progress flex-grow-1 shadow-xs rounded-sm">
                                    <span class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: <?= $progress; ?>%"></span>
                                </div>

                                <span class="ml-15 font-14 font-weight-500">
                                    <?= $progress; ?>% hoàn thành
                                </span>
                            </div>

                        <?php } ?>

                    <?php } ?>

                </div>

                <div class="mt-35">
                    <ul class="nav nav-tabs bg-secondary rounded-sm p-15 d-flex align-items-center justify-content-between" id="tabs-tab" role="tablist">
                        <li class="nav-item">
                            <a class="position-relative font-14 text-white active" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="true">Thông tin</a>
                        </li>
                        <li class="nav-item">
                            <a class="position-relative font-14 text-white" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="false">Nội dung (<?= $total_Files + $total_TextLessons; ?>)</a>
                        </li>
                        <li class="nav-item">
                            <a class="position-relative font-14 text-white " id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá (<?= $total_Review; ?>)</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active " id="information" role="tabpanel" aria-labelledby="information-tab">
                            <div class="mt-20">
                                <h2 class="section-title after-line">Mô tả khóa học</h2>
                                <div class="mt-15 course-description text-center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                                        Xem mô tả
                                    </button>
                                    <div><br></div>
                                </div>
                            </div>

                            <!-- Modal description -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Xem mô tả khoá học</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?= $course['description']; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End: modal -->

                            <div class="mt-20">
                                <h2 class="section-title after-line"><i data-feather="help-circle" width="20" height="20" class="mr-5"></i> Câu hỏi thường gặp</h2>
                                <div class="accordion-content-wrapper mt-15" id="accordion" role="tablist" aria-multiselectable="true">
                                    <?php
                                    $get = $conn->query("SELECT * FROM faqs WHERE webinar_id = '{$course['id']}'");
                                    if ($get->num_rows > 0) {
                                        while ($row = $get->fetch_array()) {
                                            $code_random = rand(100, 999);
                                    ?>
                                            <div class="accordion-row rounded-sm shadow-lg border mt-20 py-20 px-35">
                                                <div class="font-weight-bold font-14 text-secondary" role="tab" id="faq_21">
                                                    <div href="#collapseFaq<?= $code_random; ?>" aria-controls="collapseFaq<?= $code_random; ?>" class="d-flex align-items-center justify-content-between" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="true">
                                                        <span><?= $row['title']; ?></span>
                                                        <i class="collapse-chevron-icon" data-feather="chevron-down" width="25" class="text-gray"></i>
                                                    </div>
                                                </div>
                                                <div id="collapseFaq<?= $code_random; ?>" aria-labelledby="faq_21" class=" collapse" role="tabpanel">
                                                    <div class="panel-collapse text-gray">
                                                        <?= $row['answer']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- --- -->
                                    <?php }
                                    } ?>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade " id="content" role="tabpanel" aria-labelledby="content-tab">
                            <section class="">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="accordion-content-wrapper" id="chaptersAccordion" role="tablist" aria-multiselectable="true">
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

                                                    <!-- HIỂN THỊ CHƯƠNG: <?= $chapter['title']; ?> -->
                                                    <div class="accordion-row rounded-sm border mt-20 p-15">
                                                        <div class="d-flex align-items-center justify-content-between" role="tab" id="<?= $code_random; ?>">
                                                            <div class="js-chapter-collapse-toggle d-flex align-items-center" href="#collapseChapter24" aria-controls="collapseChapter24" data-parent="#chaptersAccordion" role="button" data-toggle="collapse" aria-expanded="true">
                                                                <span class="chapter-icon mr-15">
                                                                    <i data-feather="book-open" class=""></i>
                                                                </span>
                                                                <span class="font-weight-bold text-secondary font-14"><?= $chapter['title']; ?></span>
                                                            </div>

                                                            <div class="d-flex align-items-center">
                                                                <span class="mr-15 font-14 font-weight-bold">
                                                                    <?= $partTextLesson + $partFiles; ?> Nội Dung
                                                                </span>

                                                                <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapse<?= $code_random; ?>" aria-controls="collapse<?= $code_random; ?>" data-parent="#chaptersAccordion" role="button" data-toggle="collapse" aria-expanded="true"></i>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $text_lesson_query = $conn->query("SELECT * FROM text_lessons WHERE webinar_id = '{$course['id']}' AND chapter_id = '{$chapter['chapter_id']}'");
                                                        if ($text_lesson_query->num_rows > 0) {
                                                            while ($text_lesson = $text_lesson_query->fetch_array()) {
                                                                $files_ = 'files_' . rand(100, 999);
                                                        ?>

                                                                <!-- HIỂN THỊ NỘI DUNG DẠNG TEXT_LESSONS: <?= $text_lesson['title']; ?> -->
                                                                <div id="collapse<?= $code_random; ?>" aria-labelledby="<?= $code_random; ?>" class=" collapse" role="tabpanel">
                                                                    <div class="panel-collapse">
                                                                        <div class="accordion-row rounded-sm border mt-15 p-15">
                                                                            <div class="d-flex align-items-center justify-content-between" role="tab" id="<?= $files_; ?>">
                                                                                <div class="d-flex align-items-center" href="#collapse<?= $files_; ?>" aria-controls="collapse<?= $files_; ?>" data-parent="#chaptersAccordion" role="button" data-toggle="collapse" aria-expanded="true">

                                                                                    <span class="d-flex align-items-center justify-content-center mr-15">
                                                                                        <span class="chapter-icon chapter-content-icon">
                                                                                            <i data-feather="file" width="20" height="20" class="text-gray"></i>
                                                                                        </span>
                                                                                    </span>

                                                                                    <span class="font-weight-bold text-secondary font-14 file-title"><?= $text_lesson['title']; ?></span>
                                                                                </div>

                                                                                <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapse<?= $files_; ?>" aria-controls="collapse<?= $files_; ?>" data-parent="#chaptersAccordion" role="button" data-toggle="collapse" aria-expanded="true"></i>
                                                                            </div>

                                                                            <div id="collapse<?= $files_; ?>" aria-labelledby="<?= $files_; ?>" class=" collapse" role="tabpanel">
                                                                                <div class="panel-collapse">
                                                                                    <div class="text-gray text-14">
                                                                                        <p><?= $text_lesson['description']; ?></p>
                                                                                    </div>

                                                                                    <div class="d-flex align-items-center justify-content-between mt-20">

                                                                                        <div class="d-flex align-items-center">
                                                                                            <div class="d-flex align-items-center text-gray text-center font-14 mr-20">
                                                                                                <i data-feather="clock" width="18" height="18" class="text-gray mr-5"></i>
                                                                                                <span class="line-height-1"><?= $text_lesson['study_time']; ?> Phút</span>
                                                                                            </div>

                                                                                            <div class="d-flex align-items-center text-gray text-center font-14 mr-20">
                                                                                                <i data-feather="paperclip" width="18" height="18" class="text-gray mr-5"></i>
                                                                                                <span class="line-height-1">Hỗ trợ tải tài liệu</span>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="">
                                                                                            <a href="#" class="course-content-btns btn btn-sm btn-danger disabled">
                                                                                                <i data-feather="download" width="18" height="18" class="mr-5"></i> Tải xuống
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- KẾT THÚC HIỂN THỊ DẠNG TEXT_LESSONS: <?= $text_lesson['title']; ?> -->

                                                        <?php }
                                                        } ?>

                                                        <?php
                                                        $files_query = $conn->query("SELECT * FROM files WHERE webinar_id = '{$course['id']}' AND chapter_id = '{$chapter['chapter_id']}' ");
                                                        if ($files_query->num_rows > 0) {
                                                            while ($files = $files_query->fetch_array()) {
                                                                $files_ = 'files_' . rand(100, 999);
                                                        ?>

                                                                <!-- HIỂN THỊ NỘI DUNG DẠNG VIDEOS: <?= $files['title']; ?> -->
                                                                <div id="collapse<?= $code_random; ?>" aria-labelledby="<?= $code_random; ?>" class=" collapse" role="tabpanel">
                                                                    <div class="panel-collapse">
                                                                        <div class="accordion-row rounded-sm border mt-15 p-15">
                                                                            <div class="d-flex align-items-center justify-content-between" role="tab" id="<?= $files_; ?>">
                                                                                <div class="d-flex align-items-center" href="#collapse<?= $files_; ?>" aria-controls="collapse<?= $files_; ?>" data-parent="#chaptersAccordion" role="button" data-toggle="collapse" aria-expanded="true">

                                                                                    <span class="d-flex align-items-center justify-content-center mr-15">
                                                                                        <span class="chapter-icon chapter-content-icon">
                                                                                            <i data-feather="film" width="20" height="20" class="text-gray"></i>
                                                                                        </span>
                                                                                    </span>

                                                                                    <span class="font-weight-bold text-secondary font-14 file-title"><?= $files['title']; ?></span>
                                                                                </div>

                                                                                <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapse<?= $files_; ?>" aria-controls="collapse<?= $files_; ?>" data-parent="#chaptersAccordion" role="button" data-toggle="collapse" aria-expanded="true"></i>
                                                                            </div>

                                                                            <div id="collapse<?= $files_; ?>" aria-labelledby="<?= $files_; ?>" class=" collapse" role="tabpanel">
                                                                                <div class="panel-collapse">
                                                                                    <div class="text-gray text-14">
                                                                                        <p><?= $files['description']; ?></p>
                                                                                    </div>

                                                                                    <div class="d-flex align-items-center justify-content-between mt-20">

                                                                                        <div class="d-flex align-items-center">
                                                                                            <div class="d-flex align-items-center text-gray text-center font-14 mr-20">
                                                                                                <i data-feather="download-cloud" width="18" height="18" class="text-gray mr-5"></i>
                                                                                                <span class="line-height-1">7.09 MB</span>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="">
                                                                                            <a href="#" class="course-content-btns btn btn-sm btn-danger disabled">
                                                                                                <i data-feather="download" width="18" height="18" class="mr-5"></i> Tải xuống
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- KẾT THÚC HIỂN THỊ DẠNG VIDEOS: <?= $files['title']; ?> -->

                                                        <?php }
                                                        } ?>

                                                    </div>
                                                    <!-- KẾT THÚC HIỂN THỊ CHƯƠNG: <?= $chapter['title']; ?> -->

                                                <?php }
                                            } else { ?>
                                                <div class="mt-25 text-center">
                                                    <strong class="text-danger">
                                                        Khóa học đang được cập nhật hẹn bạn lần sau nhé.
                                                    </strong>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- PLAY VIDEOS INTRO -->
                            <div class="modal fade" id="playVideo" tabindex="-1" aria-labelledby="playVideoLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content py-20">
                                        <div class="d-flex align-items-center justify-content-between px-20">
                                            <h3 class="section-title after-line"></h3>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i data-feather="x" width="25" height="25"></i>
                                            </button>
                                        </div>

                                        <div class="mt-25 position-relative">
                                            <div class="px-20">
                                                <div class="file-video-loading align-items-center justify-content-center py-50 text-center">
                                                    <img src="/assets/default/img/loading.gif" width="100" height="100">
                                                </div>
                                                <div class="js-modal-video-content d-none">

                                                </div>
                                            </div>


                                            <div class="modal-video-lists mt-15">


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ĐÁNH GIÁ TAB -->
                        <div class="tab-pane fade " id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="mt-35">
                                <div class="course-reviews-box row align-items-center">
                                    <div class="col-12 text-center font-weight-500">
                                        <div class="reviews-rate font-36 font-weight-bold text-primary"><?= round($res, 2); ?></div>

                                        <div class="text-center">
                                            <div class="stars-card d-flex align-items-center justify-content-center mt-0">

                                                <?= StarsRating($res); ?>

                                            </div>
                                            <div class="mt-15"><?= $i_stars; ?> Đánh giá</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $disabled = "";
                            if (!$base->checkUserCourse($course['id'], $user_id)) {
                                $disabled = "disabled";
                            } ?>
                            <section class="mt-40">
                                <h2 class="section-title after-line">Nhập đánh giá của bạn</h2>
                                <div class="mt-10"></div>
                                <small class="text-danger font-weight-bold">Chức năng đánh giá khóa học chỉ khả dụng khi bạn đã mua / tham gia chúng.</small><br>
                                <small class="text-danger font-weight-bold">Khi gửi nhận xét, cần 1 ít thời gian để admin xem xét phê duyệt.</small>
                                <div class="mt-2"></div>
                                <p>Đánh giá</p>
                                <form class="mt-20" method="post" id="postReviews" action="#">
                                    <input type="hidden" name="course_id" value="<?= $course["id"]; ?>">
                                    <div class="form-group">
                                        <div class="col-12">
                                            <!-- <div class="container-wrapper"> -->
                                            <div class="container d-flex align-items-center justify-content-center">
                                                <div class="row justify-content-center">

                                                    <!-- star rating -->
                                                    <div class="rating-wrapper">

                                                        <!-- star 5 -->
                                                        <input type="radio" id="5-star-rating" name="star_rating" value="5" <?= $disabled; ?>>
                                                        <label for="5-star-rating" class="star-rating">
                                                            <i class="fas fa-star d-inline-block"></i>
                                                        </label>

                                                        <!-- star 4 -->
                                                        <input type="radio" id="4-star-rating" name="star_rating" value="4" <?= $disabled; ?>>
                                                        <label for="4-star-rating" class="star-rating star">
                                                            <i class="fas fa-star d-inline-block"></i>
                                                        </label>

                                                        <!-- star 3 -->
                                                        <input type="radio" id="3-star-rating" name="star_rating" value="3" <?= $disabled; ?>>
                                                        <label for="3-star-rating" class="star-rating star">
                                                            <i class="fas fa-star d-inline-block"></i>
                                                        </label>

                                                        <!-- star 2 -->
                                                        <input type="radio" id="2-star-rating" name="star_rating" value="2" <?= $disabled; ?>>
                                                        <label for="2-star-rating" class="star-rating star">
                                                            <i class="fas fa-star d-inline-block"></i>
                                                        </label>

                                                        <!-- star 1 -->
                                                        <input type="radio" id="1-star-rating" name="star_rating" value="1" <?= $disabled; ?>>
                                                        <label for="1-star-rating" class="star-rating star">
                                                            <i class="fas fa-star d-inline-block"></i>
                                                        </label>

                                                    </div>

                                                </div>
                                            </div>
                                            <!-- </div> -->

                                        </div>
                                    </div>
                                    <div class="mt-2"></div>
                                    <div class="form-group">
                                        <textarea name="description" class="form-control" rows="8" placeholder="Nhập đánh giá của bạn tại đây nhé..." required <?= $disabled; ?>></textarea>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="anonymous_user" value="hide" type="checkbox" id="flexCheckDefault" <?= $disabled; ?>>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Nhận xét ẩn danh.
                                        </label>
                                    </div>
                                    <button type="submit" class="review-btn btn btn-sm btn-primary mt-20" <?php if (!$base->checkUserCourse($course['id'], $user_id)) {
                                                                                                                echo 'disabled';
                                                                                                            } ?>>Đăng đánh giá</button>
                                </form>
                                <div>
                                    <div id="loading" class="mt-20">
                                        <div class="loading-icon"></div>
                                    </div>
                                    <div class="mt-45" id="listReviews">
                                        <!-- render -->
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="course-content-sidebar col-12 col-lg-4 mt-25 mt-lg-0">
            <div class="rounded-lg shadow-sm">
                <div class="course-img has-video">

                    <img data-src="<?= $course['thumbnail']; ?>" class="lazy img-cover" alt="">

                    <div id="webinarDemoVideoBtn" data-video-path="<?= $course['video_demo']; ?>" data-video-source="" class="course-video-icon cursor-pointer d-flex align-items-center justify-content-center">
                        <i data-feather="play" width="20" height="20"></i>
                    </div>
                </div>

                <div class="px-20 pb-30">

                    <div class="d-flex align-items-center justify-content-center mt-20">
                        <span class="font-30 text-primary">
                            <?= ($course['price'] == 0) ? "Miễn Phí" : number_format($course['price']) . 'đ'; ?>
                        </span>
                    </div>


                    <div class="mt-20 d-flex flex-column">
                        <?php if ($course['price'] == 0) { ?>
                            <?php
                            $checkOrder = $conn->query("SELECT * FROM order_items WHERE user_id = '{$user_id}' AND webinar_id = '{$course['id']}' AND type = 'free'")->num_rows;
                            if ($checkOrder >= 1) { ?>
                                <a href="/learning/<?= $course['slug']; ?>" class="btn btn-primary"><i data-feather="book" width="20" height="20" class="mr-5"></i> Đến trang học tập</a>
                            <?php } else { ?>
                                <button type="button" id="get-course-free" class="btn btn-primary"><i data-feather="gift" width="20" height="20" class="mr-5"></i> Nhận khóa học ngay</button>
                            <?php } ?>
                        <?php } else { ?>

                            <?php if ($base->checkUserCourse($course['id'], $user_id)) { ?>

                                <a href="/learning/<?= $course['slug']; ?>" class="btn btn-primary"><i data-feather="book" width="20" height="20" class="mr-5"></i> Đến trang học tập</a>

                            <?php } else { ?>

                                <button type="button" class="btn btn-danger mt-20" data-toggle="modal" data-target="#paymentModal" data-target="#paymentModal"><i data-feather="shopping-cart" width="17" height="17" class="mr-5"></i>
                                    Mua ngay
                                </button>

                            <?php } ?>
                        <?php } ?>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="paymentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="paymentModalLabel">Chọn phương thức thanh toán</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <img data-src="https://i.imgur.com/GmrZhM0.png" src="https://i.pinimg.com/originals/c7/e1/b7/c7e1b7b5753737039e1bdbda578132b8.gif" class="img-fluid rounded-lg lazyload">
                                    </div>
                                    <div class="mt-20">
                                        <select name="method" id="method" data-show-content="true" class="form-control">
                                            <option></option>
                                            <option value="momo">Ví điện tử MOMO (tự động)</option>
                                            <option value="vnpay">VnPay (tự động)</option>
                                            <option value="coins">K Coins - Bạn có: <?php echo isset($users) ? number_format($users['coins']) . ' coins' : '0 coins'; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</button>
                                    <?php if (!isset($users)) { ?>

                                        <button type="button" onclick="window.location.href='/login'" class="btn btn-primary btn-sm">Đăng nhập</button>

                                    <?php } else { ?>

                                        <button type="button" id="payment_submit" class="btn btn-primary btn-sm">Chuyển hướng</button>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-20 d-flex align-items-center justify-content-center text-gray">
                        <i data-feather="thumbs-up" width="20" height="20"></i>
                        <span class="ml-5 font-14">7 Ngày hoàn tiền</span>
                    </div>

                    <div class="mt-35">
                        <strong class="d-block text-secondary font-weight-bold">Bao gồm:</strong>
                        <div class="mt-20 d-flex align-items-center text-gray">
                            <i data-feather="download-cloud" width="20" height="20"></i>
                            <span class="ml-5 font-14 font-weight-500">Tải xuống nội dung miễn phí</span>
                        </div>



                        <div class="mt-20 d-flex align-items-center text-gray">
                            <i data-feather="headphones" width="20" height="20"></i>
                            <span class="ml-5 font-14 font-weight-500">Hỗ trợ khóa học</span>
                        </div>
                    </div>

                    <div class="mt-40 p-10 rounded-sm border row align-items-center favorites-share-box">
                        <div class="col">
                            <?php
                            $get = $conn->query("SELECT * FROM favourite_courses WHERE course_slug = '{$slug}' AND user_id = '{$user_id}' ORDER BY id DESC");
                            if ($get->num_rows > 0) {
                                while ($row = $get->fetch_array()) {
                            ?>

                                    <a class="d-flex flex-column align-items-center text-gray">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart favorite-active">
                                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                        </svg>
                                        <span class="font-12">Đã thích</span>
                                    </a>

                                <?php }
                            } else { ?>

                                <a id="favoriteCourse" class="d-flex flex-column align-items-center text-gray">
                                    <i data-feather="heart" class="" width="20" height="20"></i>
                                    <span class="font-12">Yêu thích</span>
                                </a>
                                <script>
                                    // xử lý yêu thích khóa học
                                    $('body').on('click', '#favoriteCourse', function(e) {
                                        var icon = $(this).find('svg');
                                        $.ajax({
                                            url: "<?= $domain; ?>handler/execute/favourite.php?action=add",
                                            type: 'post',
                                            data: {
                                                slug: '<?= $slug; ?>'
                                            },
                                            dataType: 'json',
                                            success: function(response) {
                                                //console.log(response)
                                                if (response.type == 'success') {
                                                    icon.addClass('favorite-active');
                                                } else {
                                                    Swal.fire(response.title, response.message, response.type)
                                                }
                                            },
                                            error: function(xhr, status, error) {
                                                alert('Lỗi kết nối mạng!')
                                                // Xử lý lỗi
                                                console.log(xhr);
                                                console.log(status);
                                                console.log(error);
                                            }
                                        });
                                    });
                                </script>
                            <?php } ?>

                        </div>
                        <div class="col">
                            <a href="#" class="js-share-course d-flex flex-column align-items-center text-gray">
                                <i data-feather="share-2" width="20" height="20"></i>
                                <span class="font-12">Chia sẻ</span>
                            </a>
                        </div>
                    </div>

                    <!-- <div class="mt-30 text-center">
                        <button type="button" id="webinarReportBtn" class="font-14 text-gray btn-transparent">Báo cáo khóa học này</button>
                    </div> -->
                </div>
            </div>

            <div class="rounded-lg shadow-sm mt-35 px-25 py-20">
                <h3 class="sidebar-title font-16 text-secondary font-weight-bold">Thông tin cơ bản của khóa học</h3>

                <div class="mt-30">

                    <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                        <div class="d-flex align-items-center">
                            <i data-feather="user" width="20" height="20"></i>
                            <span class="ml-5 font-14 font-weight-500">Giới hạn tham gia:</span>
                        </div>
                        <span class="font-14">Không giới hạn</span>
                    </div>

                    <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                        <div class="d-flex align-items-center">
                            <i data-feather="clock" width="20" height="20"></i>
                            <span class="ml-5 font-14 font-weight-500">Thời lượng:</span>
                        </div>
                        <span class="font-14">Đang cập nhật...</span>
                    </div>

                    <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                        <div class="d-flex align-items-center">
                            <i data-feather="users" width="20" height="20"></i>
                            <span class="ml-5 font-14 font-weight-500">Đã học:</span>
                        </div>
                        <span class="font-14"><?= $base->info_course($course['id'], $user_email, 'total_users'); ?></span>
                    </div>


                    <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                        <div class="d-flex align-items-center">
                            <img src="/assets/default/img/icons/sessions.svg" width="20" alt="">
                            <span class="ml-5 font-14 font-weight-500">Bài giảng (videos, files):</span>
                        </div>
                        <span class="font-14"><?= $base->info_course($course['id'], $user_email, 'total_lesson'); ?></span>
                    </div>

                    <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                        <div class="d-flex align-items-center">
                            <img src="/assets/default/img/icons/sessions.svg" width="20" alt="">
                            <span class="ml-5 font-14 font-weight-500">Tệp tin:</span>
                        </div>
                        <span class="font-14"><?= $base->info_course($course['id'], $user_email, 'total_files'); ?></span>
                    </div>

                    <div class="mt-20 d-flex align-items-center justify-content-between text-gray">
                        <div class="d-flex align-items-center">
                            <img src="/assets/default/img/icons/sessions.svg" width="20" alt="">
                            <span class="ml-5 font-14 font-weight-500">Được tạo:</span>
                        </div>
                        <span class="font-14"><?= date('d/m/Y', $course['created_at']); ?></span>
                    </div>

                </div>
            </div>



            <div class="rounded-lg shadow-sm mt-35 p-20 course-teacher-card d-flex align-items-center flex-column">


                <div class="teacher-avatar mt-5">
                    <img src="<?= $author['avatar']; ?>" class="img-cover" alt="<?= $author['name']; ?>">

                </div>
                <h3 class="mt-10 font-16 font-weight-bold text-secondary"><?= $author['name']; ?></h3>

                <div class="stars-card d-flex align-items-center  mt-15">

                    <?= StarsRating($author['stars']); ?>
                </div>

                <div class="user-reward-badges d-flex flex-wrap align-items-center mt-20">
                    <!-- <div class="mr-15 mt-10" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Old Membership">
                        <img src="/store/1/default_images/badges/faithful_user.png" width="32" height="32" alt="Faithful User">
                    </div>
                    <div class="mr-15 mt-10" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Has 2 Classes">
                        <img src="/store/1/default_images/badges/senior_vendor.png" width="32" height="32" alt="Senior Vendor">
                    </div>
                    <div class="mr-15 mt-10" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Classes Rating from 4 to 5">
                        <img src="/store/1/default_images/badges/golden_classes.png" width="32" height="32" alt="Golden Classes">
                    </div>
                    <div class="mr-15 mt-10" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Classes Sales from 1 to 2">
                        <img src="/store/1/default_images/badges/best_seller.png" width="32" height="32" alt="Best Seller">
                    </div>
                    <div class="mr-15 mt-10" data-toggle="tooltip" data-placement="bottom" data-html="true" title="Support Rating from 4 to 5">
                        <img src="/store/1/default_images/badges/fantastic_support.png" width="32" height="32" alt="Fantastic Support">
                    </div> -->
                </div>


                <div class="mt-25 d-flex flex-row align-items-center justify-content-center w-100">
                    <a href="/users/profile/<?= $author['id']; ?>" target="_blank" class="btn btn-sm btn-primary teacher-btn-action">Xem thông tin</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="d-none" id="courseShareModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">Chia sẻ</h3>

    <div class="text-center">
        <i data-feather="share-2" width="50" height="50" class="webinar-icon"></i>

        <p class="mt-20 font-14">Chia sẻ khóa học với mọi người</p>

        <div class="position-relative d-flex align-items-center justify-content-between p-15 mt-15 border border-gray250 rounded-sm mt-5">
            <div class="font-weight-bold px-16 text-ellipsis font-14"><?= $actual_link . '?keduid=' . bin2hex(random_bytes(32)); ?></div>

            <button type="button" class="btn btn-primary btn-sm flex-none" data-toggle="tooltip" data-placement="top" title="Copy"><i class="fa fa-clone copyrow" aria-hidden="true" data-clipboard-text="<?= $actual_link . '?keduid=' . bin2hex(random_bytes(32)); ?>" data-toggle="tooltip" title="Copy"></i></button>
        </div>
        <div class="mt-3"></div>
        <!--  -->
        <div class="mt-32 mt-lg-40 row align-items-center font-14">
            <a href="https://telegram.me/share/url?url=<?= $actual_link; ?>" target="_blank" class="col text-center">
                <img src="https://i.imgur.com/stS3VW3.png" width="50" height="50" alt="telegram">
                <span class="mt-10 d-block">Telegram</span>
            </a>

            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $actual_link; ?>" target="_blank" class="col text-center">
                <img src="https://i.imgur.com/abyG8Cz.png" width="50" height="50" alt="facebook">
                <span class="mt-10 d-block">Facebook</span>
            </a>

        </div>
    </div>
</div>
<script src="/assets/default/js/parts/time-counter-down.min.js"></script>
<script src="/assets/default/vendors/barrating/jquery.barrating.min.js"></script>
<script src="/assets/default/vendors/video/video.min.js"></script>
<script src="/assets/default/vendors/video/youtube.min.js"></script>
<script src="/assets/default/vendors/video/vimeo.js"></script>

<script>
    var webinarDemoLang = 'Giới thiệu khóa học';
    // Xử lí nhận khóa học miễn phí
    $('body').on('click', '#get-course-free', function(e) {
        event.preventDefault();
        $('#get-course-free').html('<i class="fa-light fa-spinner-third fa-spin mr-5"></i> Đang gửi yêu cầu...').prop('disabled', true);
        $.ajax({
            url: "<?= $domain; ?>handler/execute/get-course.php?action=free",
            type: 'post',
            data: {
                slug: '<?= $course['slug']; ?>'
            },
            dataType: 'json',
            success: function(response) {
                //console.log(response)
                $('#get-course-free').html('<i data-feather="gift" width="20" height="20" class="mr-5"></i> Nhận khóa học ngay').prop('disabled', false);
                if (response.type == 'success' || response.type == 'error') {
                    Swal.fire(response.title, response.message, response.type).then(function() {
                        if (response.reload) {
                            window.location.href = "";
                        }
                    });
                } else {
                    Swal.fire(response.title, response.message, 'error').then(function() {
                        window.location.href = "/login";
                    });
                }
            },
            error: function(xhr, status, error) {
                alert('Lỗi kết nối mạng!');
                // Xử lý lỗi
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });


    // hiển thị danh sách đánh giá
    course_id = "<?php echo $course["id"]; ?>";

    function load_reviews() {
        $("#loading").show();
        $("#listReviews").hide();
        $.post("<?= $domain; ?>model/course/reviews.php", {
                course_id: course_id,
            })
            .done(function(data) {
                // console.log(data);
                Toastify({
                    text: "Đã tải xong dữ liệu!",
                    duration: 1000,
                    newWindow: true,
                    close: false,
                    gravity: "bottom", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
                $("#loading").hide();
                $("#listReviews").html('');
                $('#listReviews').empty().append(data);
                $("#listReviews").show();
            });
    }
    load_reviews();

    // xử lý chuyển hướng thanh toán
    $('body').on('click', '#payment_submit', function() {
        $('#payment_submit').html('<i class="fa-light fa-spinner-third fa-spin mr-5"></i> Đang chuyển hướng').prop('disabled', true);
        $.ajax({
            url: "<?= $domain; ?>handler/execute/payment.php",
            type: 'post',
            data: {
                method: $('#method').val(),
                webinar_id: <?= $course['id']; ?>

            },
            dataType: 'json',
            success: function(response) {
                console.log(response)
                $('#payment_submit').html('Chuyển hướng').prop('disabled', false);
                if (response.type != "success") {
                    // error
                    Toastify({
                        text: response.message,
                        duration: 2000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "right",
                        stopOnFocus: true,
                        style: {
                            background: "linear-gradient(to right, rgb(246, 60, 60), rgb(205,92,92))",
                        },
                    }).showToast();
                    // Swal.fire(response.title, response.message, response.type);
                } else {
                    window.location.href = response.message
                }
            },
            error: function(xhr, status, error) {
                alert('Lỗi kết nối mạng!')
                // Xử lý lỗi
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });
    // xử lý đăng đánh giá khoá học
    $("#postReviews").on("submit", function(e) {
        if (!$("input[name='star_rating']").is(":checked")) {
            alert("Vui lòng chọn sao đánh giá!");
        }
        $('.review-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span>').prop('disabled', true);
        e.preventDefault();
        $.ajax({
            url: "<?= $domain; ?>handler/execute/review.php?action=create_review",
            type: "post",
            data: $(this).serialize(),
            success: function(res) {
                $('.review-btn').html('Đăng đánh giá').prop('disabled', false);
                var data = JSON.parse(res);
                if (data.type != "success") {
                    // error
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "bottom",
                        position: "center",
                        stopOnFocus: true,
                        style: {
                            background: "linear-gradient(to right, rgb(246, 60, 60), rgb(205,92,92))",
                        },
                    }).showToast();
                } else {
                    Toastify({
                        text: data.message,
                        duration: 2000,
                        newWindow: true,
                        close: true,
                        gravity: "bottom",
                        position: "center",
                        stopOnFocus: true,
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },
                    }).showToast();
                    load_reviews();
                }
            },
        });
    });
</script>

<script src="/assets/default/js/parts/comment.min.js"></script>
<script src="/assets/default/js/parts/video_player_helpers.min.js"></script>
<script src="/assets/default/js/parts/webinar_show.min.js"></script>
<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/layouts/footer.php');
?>