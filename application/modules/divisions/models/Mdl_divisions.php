<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_divisions extends MY_Model {

	private $p_key = 'division_id';
	private $table = 'divisions';
	private $alias = 'd';
	private $fillable = ['division_name','sender_id'];
    private $column_list = ['Name', 'Sender Id','Date'];
    private $csv_columns = ['Name','Sender Id'];

	function __construct() {
        parent::__construct($this->table, $this->p_key,$this->alias);
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
                'field_label'=> 'Name',
            ],
            [
                'field_name'=>'sender_id',
                'field_label'=> 'Sender Id',
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

	function get_collection( $count = FALSE, $sfilters = [], $rfilters = [], $limit = 0, $offset = 0, ...$params ) {
        
        $q = $this->db->select('*')
        ->from('divisions d');
        
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
                    $this->db->where('DATE(d.insert_dt) >=', date('Y-m-d', strtotime($value)));
                    continue;
                }

                if($key == 'to_date' && !empty($value)) {
                    $this->db->where('DATE(d.insert_dt) <=', date('Y-m-d', strtotime($value)));
                    continue;
                }

                if(!empty($value))
                    $this->db->like($key, $value);
            }
        }

		$user_role = $this->session->get_field_from_session('role','user');

        if(empty($user_role)) {
            $user_role = $this->session->get_field_from_session('role');
		}
		
		if(in_array($user_role, ['MR','ASM','RSM'])) {
			$q->where('insert_user_id', $this->session->get_field_from_session('user_id', 'user'));
		}

		if(! $count) {
			$q->order_by('d.division_id desc');
		}

		if(!empty($limit)) { $q->limit($limit, $offset); }        
        //echo $this->db->get_compiled_select(); die();
        $collection = (! $count) ? $q->get()->result_array() : $q->count_all_results();
		return $collection;
    }	
    
    function validate($type)
	{
		if($type == 'save') {
			return [
                [
					'field' => 'division_name',
					'label' => 'Division Name',
					'rules' => 'trim|required|valid_name|max_length[150]|unique_record[add.table.divisions.division_name.' . $this->input->post('division_name') .']|xss_clean'
                ],
                [
					'field' => 'sender_id',
					'label' => 'Sender Id',
					'rules' => 'trim|required|exact_length[6]|alpha|unique_record[add.table.divisions.sender_id.' . $this->input->post('sender_id') .']|xss_clean'
				],
				
			];
		}

		if($type == 'modify') {
			return [
				[
					'field' => 'division_name',
					'label' => 'Division Name',
					'rules' => 'trim|required|valid_name|max_length[150]|unique_record[edit.table.divisions.division_name.' . $this->input->post('division_name'). '.division_id.'. $this->input->post('division_id') .']|xss_clean'
                ],
                [
					'field' => 'sender_id',
					'label' => 'Sender Id',
					'rules' => 'trim|required|alpha|exact_length[6]|unique_record[edit.table.divisions.sender_id.' . $this->input->post('sender_id'). '.division_id.'. $this->input->post('division_id') .']|xss_clean'
                ],
                
			];
		}
    }

	function save(){
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules($this->validate('save'));
		
		if(! $this->form_validation->run()){
			$errors = array();	        
	        foreach ($this->input->post() as $key => $value)
				$errors[$key] = form_error($key, '<label class="error">', '</label>');
				
	        $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            
            return $response;
		}
		
		$data = $this->process_data($this->fillable, $_POST);
		
/* 
		$user_id = $this->session->get_field_from_session('user_id');
		$data['insert_user_id'] = (int) $user_id; */
		
		$id = $this->_insert($data);
		
        if(! $id){
            $response['message'] = 'Internal Server Error';
            $response['status'] = FALSE;
            return $response;
		}

		/* $to = $data['mobile'];
		$msg = $tiny_url;
		$msg_for = "Invitation"; */

		//$this->sendsms($to, $msg, $msg_for);

        $response['status'] = TRUE;
        $response['message'] = 'Congratulations! Division has been added successfully.';
        $response['redirectTo'] = 'divisions/lists';

        return $response;
	}

	function get_tiny_url($url){

		$this->load->helper('tiny_url');

		$tiny_url = tiny_url($url);
		
		if(empty($tiny_url)){
			$tiny_url = $this->get_tiny_url($url);
		}

		return $tiny_url;

	}

    function random_strings($length_of_string) 
    { 
    
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
    
		$key = substr(str_shuffle($str_result), 0, $length_of_string); 

		$key_record = $this->model->get_records(['key'=> $key], 'doctor', ['key'], '', 1);
		if(count($key_record)) {
			$key = $this->random_strings($length_of_string);
		}else{
			return $key;
		}
    } 
	
	function modify(){
		/*Load the form validation Library*/
		$this->load->library('form_validation');

		$is_Available = $this->check_for_posted_record($this->p_key, $this->table);
		if(! $is_Available['status']){ return $is_Available; }
		
		$this->form_validation->set_rules($this->validate('modify'));

		if(! $this->form_validation->run() ){
			$errors = array();	        
	        foreach ($this->input->post() as $key => $value)
	            $errors[$key] = form_error($key, '<label class="error">', '</label>');
			print_r($errors);
	        $response['errors'] = array_filter($errors); // Some might be empty
            $response['status'] = FALSE;
            
            return $response;
		}		
		
        $data = $this->process_data($this->fillable, $_POST);

        $p_key = $this->p_key;
        $id = (int) $this->input->post($p_key);

        $status = (int) $this->_update([$p_key => $id], $data);
        
        if(! $status){
			$response['message'] = 'Internal Server Error';
			$response['status'] = FALSE;
			return $response;
		}

		$response['status'] = TRUE;
        $response['message'] = 'Congratulations! record was updated.';
        
        return $response;
	}

	function sendsms($to, $msg, $msg_for){

		$this->load->helper('send_sms');

		send_sms($to, $msg, $msg_for);
		//$this->helper->send_sms();

	}

	function download(){

		if(isset($_POST['id'])){
			$doctor_id = (int) $this->input->post('id');
			$insert_user_id = $this->session->get_field_from_session('user_id','user');

			if(!$doctor_id || !$insert_user_id) {
				return;
			}
			
			$response = $this->_insert(
				[
					'doctor_id'=> $doctor_id, 
					'insert_user_id'=> $insert_user_id,
					'share_type'=> 'D'
				], 
				'shared');

			$status = ($response) ? TRUE : FALSE;
			return ['status'=> TRUE];
		}

		return ['msg'=> 'Permission Denied!', 'status'=> FALSE ];
	}

	function whatsapp(){

		if(isset($_POST['id'])){
			$doctor_id = (int) $this->input->post('id');
			$insert_user_id = $this->session->get_field_from_session('user_id','user');

			if(!$doctor_id || !$insert_user_id) {
				return;
			}

			$response = $this->_insert(
				[
					'doctor_id'=> $doctor_id, 
					'insert_user_id'=> $insert_user_id,
					'share_type'=> 'W'
				], 
				'shared');

			$status = ($response) ? TRUE : FALSE;
			return ['status'=> TRUE];
		}

		return ['msg'=> 'Permission Denied!', 'status'=> FALSE ];
	}

	function _format_data_to_export($data){
		
		$resultant_array = [];
		
		foreach ($data as $rows) {
			$records['Doctor Name'] = $rows['name'];
			$records['Doctor Mobile No.'] = $rows['mobile'];
			$records['Date'] = $rows['insert_dt'];

			array_push($resultant_array, $records);
		}
		return $resultant_array;
	}
}
