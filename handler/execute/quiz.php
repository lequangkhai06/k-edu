<?php
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = isset($_GET["action"]) ? $_GET["action"] : "";
    $webinar_id = isset($_POST["webinar_id"]) ? $_POST["webinar_id"] : 0;
    $session_name = isset($_POST["session_name"]) ? $_POST["session_name"] : null;

    if ($action == 'submit') {
        if (!$users) {
            echo swal("Có lỗi", "Bạn chưa đăng nhập!", "error", true);
            return;
        }
        $quizz = $conn->query("SELECT * FROM quizzes WHERE webinar_id = '{$webinar_id}'")->fetch_array();
        if (!$quizz) {
            echo swal("Có lỗi", "Không tìm thấy cuộc thi!", "error", true);
            return;
        }

        $quizzes_questions = $conn->query("SELECT * FROM quizzes_questions WHERE quiz_id = '{$quizz["id"]}'");
        if (!$quizzes_questions) {
            echo swal("Thông báo", "Không tìm thấy bộ câu hỏi!", "error", true);
            return;
        }

        // post: name = question, value = answer
        $results = [];
        $total_grade = 0;

        while ($row = $quizzes_questions->fetch_array()) {
            $user_ans = isset($_POST[$row["id"]]) ? $_POST[$row["id"]] : 0;
            $query_correct_ans = $conn->query("SELECT * FROM quizzes_questions_answers WHERE question_id = '{$row["id"]}' AND correct = 1");
            $status = "false";
            $grade = $row["grade"];
            $correct_ans = "";

            if ($query_correct_ans) {
                $correct_ans = $query_correct_ans->fetch_array()["id"] ?? "";
            }

            if ($user_ans == $correct_ans) {
                $total_grade += $grade;
                $status = "true";
            } else {
                $grade = 0;
            }

            $data = [
                $row["id"] => [
                    "user_ans" => (int)$user_ans,
                    "correct" => (int)$correct_ans,
                    "status" => $status,
                    "grade" => $grade,
                    "total_grade" => $grade
                ],
            ];
            $results[] = $data;
        }

        $passStatus = ($total_grade >= $quizz["pass_mark"]) ? "passed" : "failed";
        $jsonResults = json_encode($results);

        $insertResult = $conn->query(
            "INSERT INTO quizzes_results
            (quiz_id, user_id, results, user_grade, status, created_at) VALUES 
            ('{$quizz["id"]}', '{$user_id}', '{$jsonResults}', '{$total_grade}', '{$passStatus}', '{$date}')"
        );

        if ($insertResult) {
            unset($_SESSION[$session_name]);
            echo swal("Thành công", "Nộp bài thành công!", "success", true);
        } else {
            echo swal("Có lỗi", "Có lỗi khi nộp bài!", "error", false);
        }
    } else if ($action == "getid") {
        $quiz_id = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : 0;
        $latest_id_result = $conn->query("SELECT * FROM quizzes_results WHERE user_id = '{$user_id}' AND quiz_id = '{$quiz_id}' ORDER BY id DESC LIMIT 1");
        if (!$users) {
            echo json_encode([
                "status" => "error",
                "quiz_id" => 0,
                "latest_id" => 0
            ]);
            return false;
        }
        if (!$latest_id_result) {
            echo json_encode([
                "status" => "error",
                "quiz_id" => 0,
                "latest_id" => 0
            ]);
            return false;
        }
        $latest_id = $latest_id_result->fetch_array()["id"];
        echo json_encode([
            "status" => "success",
            "quiz_id" => $quiz_id,
            "latest_id" => $latest_id
        ]);
    } else if ($action == "verify_password") {
        $quiz_id = isset($_POST['quiz_id']) ? $_POST['quiz_id'] : 0;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $quizz_data = $conn->query("SELECT * FROM quizzes WHERE id = '{$quiz_id}'")->fetch_array();
        if (!$users) {
            echo json_encode([
                "status" => "error",
                "message" => "Bạn chưa đăng nhập."
            ]);
            return false;
        }
        if ($password == null) {
            echo json_encode([
                "status" => "error",
                "message" => "Vui lòng nhập mật khẩu."
            ]);
            return false;
        }
        if (!$quizz_data) {
            echo json_encode([
                "status" => "error",
                "message" => "Không tồn tại bài trắc nghiệm này."
            ]);
            return false;
        }
        if (md5($password) == $quizz_data["password"]) {
            // tao session
            $session_namespace = strtolower(SlugURL($quizz_data["title"]) . $quizz_data["id"]);
            $_SESSION[$session_namespace]['password'] = $quizz_data["password"];
            $url = '/quizzes/' . $quizz_data["id"] . '/start';
            echo json_encode([
                "status" => "success",
                "message" => "Mật khẩu hợp lệ.",
                "url" => $url,
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Mật khẩu không hợp lệ.",
                "url" => ""
            ]);
        }
    }
}
