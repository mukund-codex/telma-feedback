<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_doctor extends MY_Model {

	private $p_key = 'doctor_id';
	private $table = 'doctor';
	private $alias = 'd';
	private $fillable = ['name','mobile','division_id'];
    private $column_list = ['Division Name', 'Name', 'Mobile', 'Original URL', 'Tiny URL','Date'];
    private $csv_columns = ['Division Name', 'Doctor Name','Doctor Mobile No.'];

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
				'field_name' => 'division_name',
				'field_label' => 'Division Name',
			],
            [
                'field_name'=>'name',
                'field_label'=> 'Name',
            ],
            [
                'field_name'=>'mobile',
                'field_label'=> 'Mobile No.',
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
        
        $q = $this->db->select('d.*, div.*')
        ->from('doctor d')
        ->join('divisions div','d.division_id = div.division_id','left');
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
			$q->where('d.insert_user_id', $this->session->get_field_from_session('user_id', 'user'));
		}

		if(! $count) {
			$q->order_by('d.doctor_id desc');
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
					'field' => 'name',
					'label' => 'Doctor Name',
					'rules' => 'trim|required|valid_name|max_length[150]|xss_clean'
                ],
                [
					'field' => 'mobile',
					'label' => 'Doctor Mobile No.',
					'rules' => 'trim|required|exact_length[10]|valid_mobile|unique_record[add.table.doctor.mobile.' . $this->input->post('mobile') .']|xss_clean'
				],
				[
					'field' => 'division_id',
					'label' => 'Division Name',
					'rules' => 'trim|required|xss_clean',
				]
				
			];
		}

		if($type == 'modify') {
			return [
				[
					'field' => 'name',
					'label' => 'Doctor Name',
					'rules' => 'trim|required|valid_name|max_length[150]|xss_clean'
                ],
                [
					'field' => 'mobile',
					'label' => 'Doctor Mobile No.',
					'rules' => 'trim|required|exact_length[10]|valid_mobile|unique_record[edit.table.doctor.mobile.' . $this->input->post('mobile'). '.doctor_id.'. $this->input->post('doctor_id') .']|xss_clean'
                ],
				[
					'field' => 'division_id',
					'label' => 'Division Name',
					'rules' => 'trim|required|xss_clean',
				]
                
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
		$key = $this->random_strings(10);

		$data = $this->process_data($this->fillable, $_POST);

		//$url = urlencode("localhost/quiz/redirect?id=".$key);
		$url = base_url("feedback/redirect?id=$key");
		
		$tiny_url = $this->get_tiny_url($url);

		$user_id = $this->session->get_field_from_session('user_id', 'user');
		$data['insert_user_id'] = (int) $user_id;
		$data['key'] = $key;
		$data['original_url'] = $url;
		$data['tiny_url'] = $tiny_url;
		
		$id = $this->_insert($data);

        if(! $id){
            $response['message'] = 'Internal Server Error';
            $response['status'] = FALSE;
            return $response;
		}

		$to = $data['mobile'];
		$msg = $tiny_url;
		$msg_for = "Invitation";

		//$this->sendsms($to, $msg, $msg_for);

        $response['status'] = TRUE;
        $response['message'] = 'Congratulations! Doctor has been added successfully.';
        $response['redirectTo'] = 'doctor/lists';

        return $response;
	}

	function get_tiny_url($url){

		$this->load->helper('tiny_url');

		$tiny_url = tiny_url($url);
		
		/* if(empty($tiny_url)){
			$tiny_url = $this->get_tiny_url($url);
		} */

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

	function _format_data_to_export($data){
		
		$resultant_array = [];
		
		foreach ($data as $rows) {
			$records['Doctor Name'] = $rows['name'];
			$records['Doctor Mobile No.'] = $rows['mobile'];
			$records['Original URL'] = $rows['original_url'];
			$records['Tiny URL'] = $rows['tiny_url'];
			$records['Date'] = $rows['insert_dt'];

			array_push($resultant_array, $records);
		}
		return $resultant_array;
	}
}
