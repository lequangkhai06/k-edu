<?php
$login_records = $conn->query("select * from login_records where user_email = '$user_email' or user_id = '{$users["zalo_id"]}' order by id desc");
$history_quiz = $conn->query("select * from quizzes_results where user_id = '{$user_id}'");
$total_send_email = $conn->query("select * from send_email where email = '{$user_email}'")->num_rows;
$total_comment = $conn->query("select * from webinar_reviews where user_id = '{$user_id}'")->num_rows;
?>
<div class="panel-content">
    <section class="">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h1 class="section-title">Dashboard</h1>

        </div>


        <!-- <div class="bg-white dashboard-banner-container position-relative px-15 px-ld-35 py-10 panel-shadow rounded-sm">
            <h2 class="font-30 text-primary line-height-1">
                <span class="d-block">Hi Cameron Schofield,</span>
                <span class="font-16 text-secondary font-weight-bold">You have 59 new events</span>
            </h2>

            <ul class="mt-15 unread-notification-lists">
                <li class="font-14 mt-1 text-gray">- New badge awarded</li>
                <li class="font-14 mt-1 text-gray">- New badge awarded</li>
                <li class="font-14 mt-1 text-gray">- Installment verification request approved</li>
                <li class="font-14 mt-1 text-gray">- New reward point</li>
                <li class="font-14 mt-1 text-gray">- New financial document</li>

                <li>&nbsp;&nbsp;...</li>
            </ul>

            <a href="/panel/notifications" class="mt-15 font-weight-500 text-dark-blue d-inline-block">View all events</a>

            <div class="dashboard-banner">
                <img src="/store/1/dashboard.png" alt="" class="img-cover">
            </div>
        </div> -->
    </section>

    <section class="dashboard">
        <div class="row">
            <div class="col-12 col-lg-3 mt-35">
                <div class="bg-white account-balance rounded-sm panel-shadow py-15 py-md-30 px-10 px-md-20">
                    <div class="text-center">
                        <img src="/assets/default/img/activity/36.svg" class="account-balance-icon" alt="">

                        <h3 class="font-16 font-weight-500 text-gray mt-25">Số dư tài khoản</h3>
                        <span class="mt-5 d-block font-30 text-secondary"><?= number_format($user_coins); ?> Coins</span>
                    </div>

                    <div class="mt-20 pt-30 border-top border-gray300 d-flex align-items-center  justify-content-center ">
                        <a href="#" class="font-16 font-weight-bold text-dark-blue">Rút tiền</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3 mt-35">
                <a href=" /panel/webinars/purchases " class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center">
                    <div class="stat-icon requests">
                        <img src="/assets/default/img/icons/request.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-15">
                        <span class="font-30 text-secondary"><?= $base->getUserCourse($user_id, "total"); ?></span>
                        <span class="font-16 text-gray font-weight-500">Khoá học đã tham gia</span>
                    </div>
                </a>

                <a href=" /panel/meetings/reservation " class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center mt-15 mt-md-30">
                    <div class="stat-icon monthly-sales">
                        <img src=" /assets/default/img/icons/meeting.svg " alt="">
                    </div>
                    <div class="d-flex flex-column ml-15">
                        <span class="font-30 text-secondary">0</span>
                        <span class="font-16 text-gray font-weight-500">Cuộc gặp</span>
                    </div>
                </a>
            </div>

            <div class="col-12 col-lg-3 mt-35">
                <a href="/panel/support" class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center">
                    <div class="stat-icon support-messages">
                        <img src="/assets/default/img/icons/support.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-15">
                        <span class="font-30 text-secondary"><?= $total_send_email; ?></span>
                        <span class="font-16 text-gray font-weight-500">Thông báo email</span>
                    </div>
                </a>

                <a href=" /panel/webinars/my-comments " class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center mt-15 mt-md-30">
                    <div class="stat-icon comments">
                        <img src="/assets/default/img/icons/comment.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-15">
                        <span class="font-30 text-secondary"><?= $total_comment; ?></span>
                        <span class="font-16 text-gray font-weight-500">Bình luận</span>
                    </div>
                </a>
            </div>

            <div class="col-12 col-lg-3 mt-35">
                <a href="/panel/webinars/purchases " class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center">
                    <div class="stat-icon requests">
                        <img src="/assets/default/img/icons/meeting.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-15">
                        <span class="font-30 text-secondary"><?=$history_quiz->num_rows;?></span>
                        <span class="font-16 text-gray font-weight-500">Bài kiểm tra</span>
                    </div>
                </a>

                <a href=" /panel/meetings/reservation " class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center mt-15 mt-md-30">
                    <div class="stat-icon monthly-sales">
                        <img src=" /assets/default/img/icons/meeting.svg " alt="">
                    </div>
                    <div class="d-flex flex-column ml-15">
                        <span class="font-30 text-secondary">0</span>
                        <span class="font-16 text-gray font-weight-500">Cuộc gặp</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 mt-35">
                <div class="bg-white noticeboard rounded-sm panel-shadow py-10 py-md-20 px-15 px-md-30">
                    <h3 class="font-16 text-dark-blue font-weight-bold text-center">LỊCH SỬ LÀM QUIZ</h3>

                    <div class="mt-2"></div>

                    <div class="form-group">
                        <div class="table-responsive">
                            <table id="datatable2" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Bài kiểm tra</th>
                                        <th>Điểm số</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($history_quiz->num_rows > 0) {
                                        function quizz_status($key)
                                        {
                                            if ($key == "passed") {
                                                return "<span class='text-primary'>Đạt</span>";
                                            }
                                            if ($key == "failed") {
                                                return "<span class='text-danger'>Chưa đạt</span>";
                                            }
                                            if ($key == "waiting") {
                                                return "<span class='text-secondary'>Chờ</span>";
                                            }
                                        }
                                        while ($row = $history_quiz->fetch_assoc()) {
                                            $json_string = $row["results"];
                                            $data = json_decode($json_string, true);
                                            $result_array = [];
                                            foreach ($data as $item) {
                                                foreach ($item as $key => $value) {
                                                    $result_array[] = [
                                                        'key' => $key,
                                                        'user_ans' => $value['user_ans'],
                                                        'correct' => $value['correct'],
                                                        'status' => $value['status'],
                                                        'grade' => $value['grade'],
                                                        'total_grade' => $value['total_grade']
                                                    ];
                                                }
                                            }
                                            $quizz_data = $conn->query("select * from quizzes where id = '{$row["quiz_id"]}' order by id desc limit 1")->fetch_assoc();
                                            if (!$quizz_data) {
                                                continue;
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $quizz_data["title"]; ?></td>
                                                <td><?= $row["user_grade"]; ?> / <?= $quizz_data["total_mark"]; ?></td>
                                                <td><?= quizz_status($row['status']); ?></td>
                                                <td><?= date('d/m/Y - H:i:s', $row["created_at"]); ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 mt-35">
                <div class="bg-white monthly-sales-card rounded-sm panel-shadow py-10 py-md-20 px-15 px-md-30">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="font-16 text-dark-blue font-weight-bold">LỊCH SỬ ĐĂNG NHẬP</h3>
                    </div>
                    <div class="mt-2"></div>

                    <div class="form-group">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Thiết bị</th>
                                        <th>Thời gian</th>
                                        <th>Đăng nhập bằng</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if ($login_records->num_rows > 0) {

                                        while ($row = $login_records->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?= $row["device_id"]; ?></td>
                                                <td><?= date('d/m/Y - H:i:s', $row["login_time"]); ?></td>
                                                <td><?= $row["type"]; ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="d-none" id="iNotAvailableModal">
        <div class="offline-modal">
            <h3 class="section-title after-line">Activate offline status</h3>
            <p class="mt-20 font-16 text-gray">If you put your account offline, a message will be displayed in your profile and it will be noticed to users. You can type a personalized message in the following input.</p>

            <div class="form-group mt-15">
                <label>Offline message</label>
                <textarea name="message" rows="4" class="form-control "></textarea>
                <div class="invalid-feedback"></div>
            </div>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button" class="js-save-offline-toggle btn btn-primary btn-sm">Save</button>
                <button type="button" class="btn btn-danger ml-10 close-swl btn-sm">Close</button>
            </div>
        </div>
    </div>

    <div class="d-none" id="noticeboardMessageModal">
        <div class="text-center">
            <h3 class="modal-title font-20 font-weight-500 text-dark-blue"></h3>
            <span class="modal-time d-block font-12 text-gray mt-25"></span>
            <p class="modal-message font-weight-500 text-gray mt-4"></p>
        </div>
    </div>

</div>