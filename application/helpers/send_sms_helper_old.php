<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('send_sms')) {

	function send_sms($to, $message = '', $msg_for = ''){
		$ci = &get_instance();
		$path = 'uploads/';
		
		$ci->load->database();

		$sender_id = "USVRTW";
		//$sender_id = "DRLINK";
		$msg = urlencode($message);
		
		$url = "http://alerts.sinfini.com/api/web2sms.php?workingkey=79205ve7suw5bj1odtr5&sender=".$sender_id."&to=$to&message=$msg";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		
		$pos = strpos($output,"GID=");
		$is_success = ($pos == true) ? 1 : 0;
		curl_close($ch);		

		$is_success = 1;
		// $output = '';
		
		$data = [
				'mobile' => $to,
				'message' => $message,
				'msg_for' => $msg_for,
				'is_success' => $is_success,
				'output' => $output,
				'insertdatetime' => date("Y-m-d H:i:s")
			];

		$ci->db->insert('sms_log', $data);

		return true;
	}	
}