<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_users extends MY_Model {

	private $p_key = 'id';
	private $table = 'users';
	private $alias = 'u';
	private $fillable = ['fullname','designation','organisation','profession_id','email','user_type','username','password','referral_code','dob','gender','number','address','state_id','city_id','professions'];
    private $column_list = ['Name','Designation','Organisation','Profession','Email Id','User Type','User Name','Password','Referral Code','Date of Birth','Gender','Number','Address','State','City','Professions','Date'];
    private $csv_columns = ['Name','Sender Id'];

	function __construct() {
        parent::__construct($this->table, $this->p_key, $this->alias);
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
                'field_name'=>'name',
                'field_label'=> 'Name',
            ],
            [
                'field_name'=>'designation',
                'field_label'=> 'Designation',
			],
			[
                'field_name'=>'organisation',
                'field_label'=> 'Organisation',
            ],
			[
                'field_name'=>'profession_id',
                'field_label'=> 'Profession',
            ],
			[
                'field_name'=>'email',
                'field_label'=> 'Email Id',
            ],
			[
                'field_name'=>'user_type',
                'field_label'=> 'User Type',
            ],
			[
                'field_name'=>'username',
                'field_label'=> 'User Name',
            ],
			[
                'field_name'=>'password',
                'field_label'=> 'Password',
            ],
			[
                'field_name'=>'referral_code',
                'field_label'=> 'Referral Code',
            ],
			[
                'field_name'=>'dob',
                'field_label'=> 'Date of Birth',
            ],
			[
                'field_name'=>'gender',
                'field_label'=> 'Gender',
            ],
			[
                'field_name'=>'number',
                'field_label'=> 'Number',
            ],
			[
                'field_name'=>'address',
                'field_label'=> 'Address',
            ],
			[
                'field_name'=>'state_id',
                'field_label'=> 'State',
            ],
			[
                'field_name'=>'city_id',
                'field_label'=> 'City',
            ],
			[
                'field_name'=>'professions',
                'field_label'=> 'Professions',
            ],
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
        
        $q = $this->db->select('u.*, s.name state_name, s.id state_id, c.id city_id, c.name city_name,p.id as professions_id, p.name profession_name')
        ->from('users u')
        ->join('state_master s','s.id = u.state_id', 'left')
        ->join('city_master c','c.id = u.city_id', 'left')
        ->join('profession_master p','p.id = u.profession_id', 'left');
        
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

		// $user_role = $this->session->get_field_from_session('role','user');

        // if(empty($user_role)) {
        //     $user_role = $this->session->get_field_from_session('role');
		// }
		
		// if(in_array($user_role, ['MR','ASM','RSM'])) {
		// 	$q->where('insert_user_id', $this->session->get_field_from_session('user_id', 'user'));
		// }

		if(! $count) {
			$q->order_by('u.id desc');
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
					'field' => 'fullname',
					'label' => 'Name',
					'rules' => 'trim|required|valid_name|max_length[150]'
                ]
				
			];
		}

		if($type == 'modify') {
			return [];
		}
    }

	function save(){
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules($this->validate('save'));
		if (! $this->form_validation->run()) {
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
        $response['message'] = 'Congratulations! Users has been added successfully.';
        $response['redirectTo'] = 'users/lists';

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

        // $this->form_validation->set_rules($this->validate('modify'));
// var_dump($this->form_validation->run()); die;
		// if(! $this->form_validation->run() ){
		// 	$errors = array();	        
	    //     foreach ($this->input->post() as $key => $value)
	    //         $errors[$key] = form_error($key, '<label class="error">', '</label>');
	    //     $response['errors'] = array_filter($errors); // Some might be empty
        //     $response['status'] = FALSE;
            
        //     return $response;
		// }		
		
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
			$records['Division Name'] = $rows['division_name'];
			$records['Sender Id'] = $rows['sender_id'];
			$records['Date'] = $rows['insert_dt'];

			array_push($resultant_array, $records);
		}
		return $resultant_array;
	}
}
