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

	function get_doctors($sfilters = [], $limit = 0, $offset = 0) {
		$q = $this->db->select('sd.sms_data_id, sd.message, sd.sms_date_time, sd.is_processed,
		d.division_name, d.sender_id, doc.doctor_id, doc.name, doc.mobile,
		fd.question3, fd.email_id as email, 
		ar.title as article_title, ar.file as file, 
		ar.original_url as original_url, ar.short_url as short_url')
        ->from('sms_data sd')
        ->join('divisions d', 'd.division_id = sd.division_id')
		->join('doctor doc', 'doc.division_id = d.division_id')
		->join('feedback fd', 'fd.doctor_id = doc.doctor_id', 'left')
		->join('article ar', 'ar.article_id = sd.article_id')
        ->where('sd.is_processed', 0);
        
		if(sizeof($sfilters)) { 
            
            foreach ($sfilters as $key=>$value) { 
                $q->where("$key", $value); 
			}
		}
        
		if(!empty($limit)) { $q->limit($limit, $offset); }        
        echo $this->db->get_compiled_select(); die();
        $collection = $q->get()->result_array();
		return $collection;
	}

	function get_doctors_articles($sfilters = [], $limit = 0, $offset = 0){
		$q = $this->db->select('
			sd.sms_data_id, 
		    dr.doctor_id, dr.name as doctor_name, dr.mobile as doctor_mobile, di.division_id,
			di.division_name as division_name, di.sender_id as sender_id,
			fd.question3, fd.email_id as doctor_email, 
			ar.title as article_title, ar.file as file, 
			ar.original_url as original_url, ar.short_url as short_url
		')
		->from('doctor dr')
		->join('divisions di', 'di.division_id = dr.division_id')
		->join('feedback fd', 'fd.doctor_id = dr.doctor_id', 'LEFT')
		->join('sms_data sd', 'sd.division_id = di.division_id', 'LEFT')
		->join('article ar', 'ar.article_id = sd.article_id')
		->group_by('dr.doctor_id');

		if(sizeof($sfilters)) { 
            
            foreach ($sfilters as $key=>$value) { 
                $q->where("$key", $value); 
			}
		}
        
		if(!empty($limit)) { $q->limit($limit, $offset); }        
        //echo $this->db->get_compiled_select(); die();
        $collection = $q->get()->result_array();
		return $collection;
	}
}
?>