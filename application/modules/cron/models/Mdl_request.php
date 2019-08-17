<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_request extends MY_Model {

	public $p_key = 'sms_queue_id';
	public $table = 'sms_queue';

	function __construct() {
		parent::__construct($this->table);
	}

	function is_cron_active(){
		$cron_record = $this->get_records(['status'=> 1], 'sms_cron_status', ['status']);
		return (count($cron_record)) ? TRUE : FALSE;
	}
}
?>