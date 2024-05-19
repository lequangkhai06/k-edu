<?php
include "../config.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = isset($_GET["action"]) ? $_GET["action"] : "";
    $webinar_id = isset($_POST["webinar_id"]) ? $_POST["webinar_id"] : 0;
    if ($action == 'submit') {
        $quizz = $conn->query("select * from quizzes where webinar_id = '{$webinar_id}'")->fetch_array();
        if (!$quizz) {
            return 0;
        }
        $quizzes_questions = $conn->query("select * from quizzes_questions where quiz_id = '{$quizz["id"]}'");
        if (!$quizzes_questions) {
            return 0;
        }
        // post: name = question
        // value = answer
        $results = [];
        $total_grade = 0;
        while ($row = $quizzes_questions->fetch_array()) {
            $user_ans = isset($_POST[$row["id"]])  ? $_POST[$row["id"]] : 0;
            $query_correct_ans = $conn->query("SELECT * FROM quizzes_questions_answers WHERE question_id = '{$row["id"]}' AND id = '{$user_ans}' AND correct = 1");
            $status = "false";
            $grade = $row["grade"];
            $correct_ans = "";
            if (!$query_correct_ans || $query_correct_ans == null) {
                //pass
                continue;
            } else {
                $correct_ans = $query_correct_ans->fetch_array()["id"] ?? "";
            }
            // 
            if ($user_ans == $correct_ans) {
                $total_grade += $grade;
                $status = "true";
            } else {
                $grade = 0;
            }
            $data = [
                $row["id"] => [
                    "user_ans" => $user_ans,
                    "correct" => $correct_ans,
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
            echo "Dữ liệu đã được chèn thành công!";
        } else {
            echo "Lỗi khi chèn dữ liệu: " . $conn->error;
        }
    }
}
