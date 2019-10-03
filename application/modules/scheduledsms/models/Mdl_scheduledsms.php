<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_scheduledsms extends MY_Model {

	public $p_key = 'sms_data_id';
	public $table = 'sms_data';
	private $alias = 'msgdata';
	private $column_list = ['Division Name', 'Article Title', 'Article Link', 'Message', 'SMS Date Time', 'Processed Status', 'Date Added'];
    private $csv_columns = ['Division Name', 'Article Title', 'Article Link', 'Message', 'SMS Date Time', 'Processed Status', 'Date Added'];

	function __construct() {
		parent::__construct($this->table, $this->p_key);
	}

    function get_csv_columns() {
        return $this->csv_columns;
    }

    function get_column_list() {
        return $this->column_list;
    }

	function get_filters() {
        return [
            [
                'field_name'=>'division_name',
                'field_label'=> 'Division Name',
            ],
            [
                'field_name'=>'message',
                'field_label'=> 'Message',
            ]
        ];
	}
	
	function get_filters_from($filters) {
        $new_filters = array_column($this->get_filters(), 'field_name');
        
        if(array_key_exists('from_date', $filters))  {
            array_push($new_filters, 'from_date');
        }

        if(array_key_exists('to_date', $filters))  {
            array_push($new_filters, 'to_date');
        }

        return $new_filters;
    }

	function get_records_of($field = '', $id_arr = [], $select = [], $table = ''){
		$table = (! empty($table)) ? $table : $this->get_table();

		if(sizeof($select) > 0){
			$this->db->select($select);
		}

		if(sizeof($id_arr) > 0){
			$this->db->where_in($field, $id_arr);
		}

		$this->db->from($table);
		
		$query = $this->db->get();
		return $query->result();
	}

	function get_sms_balance(){
		$this->db->select("ifnull(sum(ceil(length(message)/160)),0) netconsump",false);
		$this->db->from("sms_log"); //define record from which table
		$query = $this->db->get();
		$r = $query->row();
		$netconsump = $r->netconsump;
		
		$this->db->select("ifnull(sum(balance),0 ) netbal",false);
		$this->db->from("sms_balance bal"); //define record from which table
		$query = $this->db->get();
		$r = $query->row();
		$netbal = $r->netbal;
		return $totbal =  $netbal - $netconsump;

	}

	function get_collection( $count = FALSE, $sfilters = [], $rfilters = [], $limit = 0, $offset = 0, ...$params ) {
		
    	$q = $this->db->select(" ar.title as title,
    		msgdata.sms_data_id, msgdata.division_id, msgdata.article_link, msgdata.message, msgdata.sms_date_time, msgdata.is_processed, msgdata.insert_dt, msgdata.update_dt,div.division_name,
    		case when msgdata.is_processed = 0 then 'Pending' 
				when msgdata.is_processed = 1 then 'SMS Sent' end as sms_sts
    	")
		->from('sms_data msgdata')
		->join('divisions div', 'div.division_id = msgdata.division_id', 'left')
		->join('article ar', 'ar.article_id = msgdata.article_id');
				
		$where_condition = " 1=1 ";

		if(sizeof($sfilters)) { 
            
            foreach ($sfilters as $key=>$value) { 
                $q->where("$key", $value); 
			}
		}
        
		if(is_array($rfilters) && count($rfilters) ) {
			$field_filters = $this->get_filters_from($rfilters);
			
            foreach($rfilters as $key=> $value) {
                if(!in_array($key, $field_filters)) {
                    continue;
                }
                
                if($key == 'from_date' && !empty($value)) {
                    $this->db->where('DATE('.$this->alias.'.insert_dt) >=', date('Y-m-d', strtotime($value)));
                    continue;
                }

                if($key == 'to_date' && !empty($value)) {
                    $this->db->where('DATE('.$this->alias.'.insert_dt) <=', date('Y-m-d', strtotime($value)));
                    continue;
                }

                if(!empty($value))
                    $this->db->like($key, $value);
            }
        }

		$q->order_by('msgdata.update_dt desc');

		if(!empty($limit)) { $q->limit($limit, $offset); }
		//echo $this->db->get_compiled_select(); die();
		$collection = (! $count) ? $q->get()->result_array() : $q->count_all_results();
		return $collection;
	}	

	function save(){
		/*Load the form validation Library*/
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('division_id','Division Name','trim|required|xss_clean');

		if(!empty($this->input->post('article_id'))){
			$this->form_validation->set_rules('article_link','Article Link','trim|required|xss_clean');
		}
		
		if($this->input->post('sendsmsnowtest') != 1) {
			$this->form_validation->set_rules('sms_date', 'SMS Date', 'trim|required');
		}
		
		$this->form_validation->set_rules('message','Message','trim|max_length[1000]|required|xss_clean');

		if(!$this->form_validation->run()) {

			$errors = array();	        
	        foreach ($this->input->post() as $key => $value)
	            $errors[$key] = form_error($key, '<label class="error">', '</label>');			

	        $response['errors'] = array_filter($errors); // Some might be empty
	        $response['status'] = FALSE;

		} else {

			$data = array();
			$is_success = '';

			$division_id = $this->input->post('division_id');
			if(!empty($this->input->post('sms_date'))) {
				$smsDate = $this->input->post('sms_date');
			} else {
				$smsDate = date("Y-m-d H:i:00");
			}
			
			$sender = $this->get_records(['division_id'=> $division_id], 'divisions', ['sender_id']);
			$sender_id = $sender[0]->sender_id;

			$message = $this->input->post('message');
			$article_id = !empty($this->input->post('article_id')) ? $this->input->post('article_id') : '';
			$article_link = !empty($this->input->post('article_link')) ? $this->input->post('article_link') : '';

			$smsnewdateforchk = date("Y-m-d",strtotime($smsDate));
			
			$smsnewdate = date("Y-m-d H:i:00",strtotime($smsDate.' + 2 minute'));				

			$records = $this->get_records(['division_id'=> $division_id,'sms_date_time like'=>"$smsnewdate%"], 'sms_data', ['sms_data_id']);

			if(count($records) > 0) {

				$response['errors'] = [
					'message' => '<label class="error">SMS Already scheduled for the Division selected on the date selected. </label>'
				]; // Some might be empty
				$response['status'] = FALSE;
				
				
			} else {

				$data['division_id'] = $division_id;
				$data['article_id'] = $article_id;
				$data['article_link'] = $article_link;
				$data['message'] 	= $message;
				$data['sms_date_time']  = $smsnewdate;						

				$articledata['division_id'] = $division_id;
				$articledata['article_id'] = $article_id;

				$sms_data_id = $this->_insert($data);

				$email_data_id = $this->_insert($articledata, 'email_data');

				$response['status'] = TRUE;
			}		
		}
			
		return $response;
    }
    
    function total_sms() {
        $q = $this->db->select('SUM(balance) AS balance')
            ->from('sms_balance')
            ->get()->result();

        return $q;
    }

	function saveSmsBalance() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sms_balance','SMS Balance','trim|required|numeric');

		if(!$this->form_validation->run()) {
			$errors = array();
	        foreach ($this->input->post() as $key => $value)
	            $errors[$key] = form_error($key, '<label class="error">', '</label>');

	        $response['errors'] = array_filter($errors); // Some might be empty
	        $response['status'] = FALSE;
		} else {
			$data['balance'] = $this->input->post('sms_balance');
            $balance_id = $this->_insert($data, 'sms_balance');

            // echo $this->db->last_query(); die();
			$response['status'] = ((int) ($balance_id)) ? TRUE : FALSE;
		}
		return $response;
	}
	
	function modify(){
		/*Load the form validation Library*/
		$this->load->library('form_validation');

		$is_Available = $this->check_for_posted_record($this->p_key, $this->table);
		if(! $is_Available['status']){ return $is_Available; }
		
		$sms_name = trim($this->input->post('sms_name'));

		if( strtolower($sms_name) != strtolower($is_Available['data'][0]->sms_name) ){
			$this->form_validation->set_rules('sms_name','Zone Name','trim|required|valid_name|unique_key[sms.sms_name]|max_length[150]|xss_clean');
		}
		else{
			$this->form_validation->set_rules('sms_name','Zone Name','trim|required|valid_name|max_length[150]|xss_clean');
		}

		if(! $this->form_validation->run() ){
			$errors = array();	        
	        foreach ($this->input->post() as $key => $value)
	            $errors[$key] = form_error($key, '<label class="error">', '</label>');

	        $response['errors'] = array_filter($errors); // Some might be empty
	        $response['status'] = FALSE;
		}		
		else{
			$data = array();
			$data['sms_name'] = $this->input->post('sms_name');

			$p_key = $this->p_key;
			$sms_id = (int) $this->input->post('sms_id');

			$status = (int) $this->_update([$p_key => $sms_id], $data);
			$response['status'] = ($status) ? TRUE : FALSE;
		}
		return $response;
	}

	function remove(){
		
		if(isset($_POST['ids']) && sizeof($_POST['ids']) > 0){
			$ids = $this->input->post('ids');
			$response = $this->_delete($this->p_key, $ids, $this->table);

			$msg = ($response) ? "Record(s) Successfully deleted" : 'Error while deleting record(s)';
			return ['msg'=> $msg];
		}

		return ['msg'=> 'No Records Selected'];
	}

	function _format_data_to_export($data){
		
		$resultant_array = [];
		
		foreach ($data as $rows) {
			$msg = $rows['message'];
			$records['Division Name'] = $rows['division_name'];
			$records['Article Title'] = $rows['title'];
			$records['Article Link'] = $rows['article_link'];
			$records['Message'] = "$msg";
			$records['SMS Date Time'] = $rows['sms_date_time'];
			$records['Processed Status'] = $rows['sms_sts'];
			$records['Date Added'] = $rows['insert_dt'];
			array_push($resultant_array, $records);
		}

		return $resultant_array;
	}
}