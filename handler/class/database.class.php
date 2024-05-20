<?php
// class database query
class KHAIDZ
{

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function exists($table, $array)
    {
        $params = "";
        foreach ($array as $key => $value) {
            $params .= $key . " = '" . $value . "' AND ";
        }
        $params = rtrim($params, "AND ");
        return $this->conn->query("SELECT * FROM `{$table}` WHERE {$params}")->num_rows > 0;
    }

    function insert($table, $array)
    {
        $params = "";
        foreach ($array as $key => $value) {
            $params .= $key . " = '" . $value . "', ";
        }
        $params = rtrim($params, ", ");
        return $this->conn->query("INSERT INTO `{$table}` SET {$params}");
    }

    function insert_if_not_exists($table, $params_to_check, $params_to_insert)
    {
        $params_exists = "";
        foreach ($params_to_check as $key => $value) {
            $params_exists .= $key . " = '" . $value . "' AND ";
        }
        $params_exists = rtrim($params_exists, "AND ");

        if ($this->conn->query("SELECT * FROM `{$table}` WHERE {$params_exists}")->num_rows <= 0) {
            $params_insert = "";
            foreach ($params_to_insert as $key => $value) {
                $params_insert .= $key . " = '" . $value . "', ";
            }
            $params_insert = rtrim($params_insert, ", ");
            return $this->conn->query("INSERT INTO `{$table}` SET {$params_insert}");
        } else {
            return false;
        }
    }

    function update($table, $params_to_check, $params_to_update)
    {
        $params_exists = "";
        foreach ($params_to_check as $key => $value) {
            $params_exists .= $key . " = '" . $value . "' AND ";
        }
        $params_exists = rtrim($params_to_check, "AND ");

        $params = "";
        foreach ($params_to_update as $key => $value) {
            $params .= $key . " = '" . $value . "', ";
        }
        $params = rtrim($params, ", ");
        return $this->conn->query("UPDATE `{$table}` SET {$params} WHERE {$params_exists}");
    }

    function delete($table, $params_to_delete)
    {
        $params_delete = "";
        foreach ($params_to_delete as $key => $value) {
            $params_delete .= $key . " = '" . $value . "' AND ";
        }
        $params_delete = rtrim($params_delete, "AND ");
        return $this->conn->query("DELETE FROM `{$table}` WHERE {$params_delete}");
    }

    function Count_Rows($table, $params)
    {
        $res = $this->conn->query("SELECT * FROM `{$table}` WHERE {$params}")->num_rows;
        return $res;
    }

    // trả thông tin: tổng bài học, tổng bài học video, text, % đã học
    function info_course($course_id, $email, $act)
    {
        $total_TextLessons = $this->conn->query("SELECT * FROM text_lessons WHERE webinar_id = '{$course_id}'")->num_rows;
        $total_Files = $this->conn->query("SELECT * FROM files WHERE webinar_id = '{$course_id}'")->num_rows;
        $totalPassed = $this->conn->query("SELECT * FROM user_passed_lesson WHERE webinar_id = '{$course_id}' AND email = '{$email}'")->num_rows;
        $total_Users = $this->conn->query("SELECT * FROM order_items WHERE webinar_id  = '{$course_id}'")->num_rows;
        $totalLesson = $total_TextLessons + $total_Files;
        if ($totalLesson == 0) {
            $progress = 0;
        } else {
            $progress = ($totalPassed / $totalLesson) * 100;
        }
        if ($act == 'total_lesson') {
            return $totalLesson;
        }
        if ($act == 'total_files') {
            return $total_Files;
        }
        if ($act == 'total_text_lesson') {
            return $total_TextLessons;
        }
        if ($act == 'progress') {
            return round($progress, 2);
        }
        if ($act == 'total_users') {
            return $total_Users;
        }
    }
    // hàm kiểm tra người dùng đã tham gia khóa học hay chưa
    function checkUserCourse($course_id, $user_id)
    {
        $course = $this->conn->query("SELECT * FROM webinars WHERE id = '{$course_id}'", 1)->fetch_array();
        if (!$course) {
            return false;
        }
        $orderItem = $this->conn->query("SELECT * FROM order_items WHERE webinar_id = '{$course['id']}' AND user_id = '{$user_id}' ", 1)->fetch_array();
        if (!$orderItem) {
            return false;
        }
        $orderID = $this->conn->query("SELECT * FROM orders WHERE trans_id =  '{$orderItem['trans_id']}' AND status = 'success'")->fetch_array();
        if (!$orderID) {
            return false;
        }
        return true;
    }
    // lấy thông tin người dùng qua id
    function getUserInfo($user_id)
    {
        if ($user_id == "" || $user_id == 0) {
            return false;
        }
        $query = $this->conn->query("select * from users where id = '{$user_id}'");
        if (!$query) {
            return false;
        }
        return $query->fetch_array();
    }

    // Lấy số lượng khoá học người dùng đã thanh toán
    function getUserCourse($user_id, $act)
    {
        if ($user_id == "" || $user_id == 0) {
            return false;
        }
        $query = $this->conn->query("select * from users where id = '{$user_id}'");
        if (!$query) {
            return false;
        }
        $query_orders = $this->conn->query("select * from orders where user_id = '{$user_id}' and status = 'success'");
        $total = $query_orders->num_rows;
        if ($act == "total") {
            return $total;
        }
        return 0;
    }
}
/* CONTACT: // LEQUANGKHAI  - FB.COM/KHAIDEVELOPER - ZALO.ME/0387290231 */