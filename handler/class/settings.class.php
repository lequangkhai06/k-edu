<?php
class KHAIDZSettings
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
        $this->conn->query("CREATE TABLE IF NOT EXISTS settings (id int(11) PRIMARY KEY AUTO_INCREMENT,`key` varchar(255) NOT NULL, `value` text NOT NULL)");
    }

    function add($key, $value)
    {
        $get = $this->conn->query("SELECT * FROM settings WHERE `key` = '{$key}'");
        if ($get->num_rows > 0) {
            return;
        } else {
            $this->conn->query("INSERT INTO settings SET `value` = '{$value}', `key` = '{$key}'");
        }
    }

    function remove($key)
    {
        if ($this->conn->query("SELECT * FROM settings WHERE `key` = '{$key}'")->num_rows > 0) {
            $this->conn->query("DELETE FROM settings WHERE `key` = '{$key}'");
        } else {
            return;
        }
    }

    function change($key, $value)
    {
        if ($this->conn->query("SELECT * FROM settings WHERE `key` = '{$key}'")->num_rows > 0) {
            $this->conn->query("UPDATE settings SET `value` = '{$value}' WHERE `key` = '{$key}'");
        } else {
            $this->conn->query("INSERT INTO settings SET `value` = '{$value}', `key` = '{$key}'");
        }
    }

    function get($key)
    {
        $get = $this->conn->query("SELECT * FROM settings WHERE `key` = '{$key}'");
        if ($get->num_rows > 0) {
            return $get->fetch_array()["value"];
        } else {
            return "";
        }
    }
}

/* CONTACT: // LEQUANGKHAI  - FB.COM/KHAIDEVELOPER - ZALO.ME/0387290231 */