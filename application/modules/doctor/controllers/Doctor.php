<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Doctor extends User_Controller
{
	private $module = 'doctor';
    private $model_name = 'mdl_doctor';
    private $controller = 'doctor';
    private $settings = [
        'permissions'=> ['add','edit','remove','download','upload'],
    ];
    
    private $scripts = ['doctor.js'];    

	function __construct() {
        $user_role = $this->session->get_field_from_session('role');

        /* $this->settings = in_array(strtoupper($user_role), ['SA', 'A']) ? [
            'permissions'=> [],
        ] : $this->settings; */
        
        parent::__construct( 
            $this->module, 
            $this->controller, 
            $this->model_name,
            $this->settings,    
            $this->scripts,
            ['jCrop','fancybox']
        );

        $this->set_defaults();
    }

	function options(){
		$this->session->is_Ajax_and_logged_in();

		$limit = $this->dropdownlength;
		$page = intval($_POST['page']) - 1;
		$page = ($page <= 0) ? 0 : $page;

		$s_term = (isset($_POST['search'])) ? $this->db->escape_like_str($_POST['search']) : '';
		$id = (isset($_POST['id'])) ? (int) $this->input->post('id') : 0;

		if($id){ $filters['region_id'] = $id; }

		$new = array(); $json['results'] = array();

		$_options = $this->model->get_options($s_term, 'area_name', $filters, $page * $limit, $limit);
		$_opt_count = count($this->model->get_options($s_term, 'area_name', $filters));

		foreach($_options as $option){
			$new['id'] = $option->area_id;
			$new['text'] = $option->area_name;

			array_push($json['results'], $new);
		}
		
		$more = ($_opt_count > count($_options)) ? TRUE : FALSE;
		$json['pagination']['more'] = $more;

		echo json_encode($json);
    }

	function whatsapp(){
		$this->session->is_Ajax_and_logged_in();

		$response = $this->model->whatsapp();
		echo json_encode($response);
    }

	function uploadcsv(){
        
		$this->session->is_Ajax_and_admin_logged_in();
		/*upload csv file */
        
		if(! is_uploaded_file($_FILES['csvfile']['tmp_name'])){
			echo json_encode(['errors'=> ['csvfile'=> '<label class="error">Please Upload CSV file</label>']]); exit;
		}

		if(!in_array($_FILES['csvfile']['type'], array('application/vnd.ms-excel', 'application/csv', 'text/csv')) ){
			echo json_encode(['errors'=> ['csvfile'=> '<label class="error">Only .CSV files allowed</label>']]); exit;
		}

		$file = $_FILES['csvfile']['tmp_name'];
		$handle = fopen($file, "r");
		$cnt = 0; $newrows = 0;
        
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
            
			if(! $cnt){
                $cnt++; continue;
            }

			if(count($data) !== 3) { continue; }            
			
			$division_name = trim($data[0]);
            $doctor_name = trim($data[1]);
            $doctor_mobile = trim($data[2]);

            if( empty($division_name) || empty($doctor_name) || empty($doctor_mobile)){
                continue;
			}
			
			if(strlen($doctor_mobile) != 10){
				continue;
			}

			if(!is_numeric($doctor_mobile)){
				continue;
			}

			if(!ctype_alnum($division_name)){
				continue;
			}

			if(!ctype_alnum($doctor_name)){
				continue;
			}

			$div_record = $this->model->get_records(['division_name'=> $division_name], 'divisions', ['division_id'], '', 1);	
			
			if(empty($div_record)){
				continue;
			}

			$division_id = $div_record[0]->division_id;		
			
			/* if(count($div_record)) {
				continue;
			} */

			$record = $this->model->get_or_records(['name'=> $doctor_name, 'mobile' => $doctor_mobile], 'doctor', ['key'], '', 1);
			if(count($record)) {
				continue;
			}

			$key = $this->model->random_strings(10);

			$url = base_url("feedback/redirect?id=$key");
		
			$tiny_url = $this->model->get_tiny_url($url);
			
			$insert['division_id'] = $division_id;
            $insert['name'] = $doctor_name;
            $insert['mobile'] = $doctor_mobile;
            $insert['key'] = $key;
			$insert['original_url'] = $url;
			$insert['tiny_url'] = $tiny_url;

			//$this->load->helper('send_sms');

			/* $to = $doctor_mobile;
			$msg = $tiny_url;
			$msg_for = "Invitation";

			$this->model->sendsms($to, $msg, $msg_for); */

            $this->model->_insert($insert);

            $newrows++;
		}

		fclose($handle);

		echo json_encode(['newrows'=> "$newrows record(s) added successfully"]);
	}
}
