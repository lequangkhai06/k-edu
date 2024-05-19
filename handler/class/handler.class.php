<?php
class KHAIDZHANDLER
{
	//private $conn;

	// function __construct($conn)
	// {
	// 	$this->conn = $conn;
	// }

	function check($string)
	{
		$allow_char = "QWERTYUIOPASDFGHJKLZXCVBNM@qwertyuiopasdfghjklzxcvbnm1234567890_-.";
		$arr = str_split($allow_char);
		$char = str_split($string);
		$bool = true;
		foreach ($char as $c) {
			if (!in_array($c, $arr)) {
				$bool = false;
				break;
			}
		}
		return $bool;
	}

	function hashPassword($value)
	{
		return md5($value);
	}

	function char25($value)
	{
		if (strlen($value) > 25) {
			$str = substr($value, 0, 25);
			$str .= "...";
		} else {
			$str = $value;
		}
		return $str;
	}

	function char50($value)
	{
		if (strlen($value) > 50) {
			$str = substr($value, 0, 50);
			$str .= "...";
		} else {
			$str = $value;
		}
		return $str;
	}

	function char70($value)
	{
		if (strlen($value) > 70) {
			$str = substr($value, 0, 70);
			$str .= "...";
		} else {
			$str = $value;
		}
		return $str;
	}

	function format_s($str)
	{
		$unicode = array(
			'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
			'd' => 'đ',
			'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
			'i' => 'í|ì|ỉ|ĩ|ị',
			'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
			'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
			'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
			'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			'D' => 'Đ',
			'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
			'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		);

		foreach ($unicode as $nonUnicode => $uni) {
			$str = preg_replace("/($uni)/i", $nonUnicode, $str);
		}
		$str = str_replace(' ', '_', $str);
		return $str;
	}

	function curl_post($url, $data)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);

		return json_decode($response, true);
	}

	function curl_post_form($url, $data)
	{
		$data_query = http_build_query($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, preg_replace('/\s+/', '', $url));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 50);
		$headers = array();
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return json_decode($response, true);
	}
}
/* CONTACT: // LEQUANGKHAI  - FB.COM/KHAIDEVELOPER - ZALO.ME/0387290231 */