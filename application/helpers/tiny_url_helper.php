<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('tiny_url')) {

	function tiny_url($url, ...$params){
		if(empty($url)) { return false; }
        
        $ch = curl_init(); 		
		$timeout = 5; 		
		curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url); 		
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); 		
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout); 		
		$data = curl_exec($ch); 		
		curl_close($ch); 

		return $data;
    }
}