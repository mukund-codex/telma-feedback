<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Feedback extends Admin_Controller
{
	private $module = 'feedback';
    private $model_name = 'mdl_feedback';
    private $controller = 'feedback';
    private $settings = [
        'permissions'=> ['add', 'edit', 'remove','download','upload'],
    ];
    
    private $scripts = ['doctor.js'];    

	function __construct() {
        $user_role = $this->session->get_field_from_session('role');

        /* $this->settings = in_array(strtoupper($user_role), ['SA', 'A']) ? [
            'permissions'=> ['download'],
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
        $filters = array();
		if($id){ $filters['code'] = $id; }

		$new = array(); $json['results'] = array();

		$_options = $this->model->get_options($s_term, 'code', $filters, $page * $limit, $limit);
		$_opt_count = count($this->model->get_options($s_term, 'code', $filters));

		foreach($_options as $option){
			$new['id'] = $option->id;
			$new['text'] = $option->code;

			array_push($json['results'], $new);
		}
		
		$more = ($_opt_count > count($_options)) ? TRUE : FALSE;
		$json['pagination']['more'] = $more;

		echo json_encode($json);
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
            
                $code = trim($data[0]);
                $insert_dt = trim($data[1]);
                
                if(!empty($code) || !empty($insert_dt)){
                    continue;
                }

                $insert['code'] = $code;
                $insert['insert_dt'] = $insert_dt;

                $this->model->_insert($insert);
                $newrows++;
            
		}
		fclose($handle);

		echo json_encode(['newrows'=> "$newrows record(s) added successfully"]);
	}

	function redirect(){

		$key = $this->input->get('id', TRUE);
		
		if(empty($key)){
			show_404();
		}

		$feedback_record = $this->model->get_records(['key'=> $key], 'doctor', [], '', 1);
		$data['doctor_id'] = $doctor_id = $feedback_record[0]->doctor_id;
		
		if(empty($doctor_id)){
			show_404();
		}
		
		$feedback_records = $this->model->get_records(['doctor_id'=> $doctor_id, 'complete_status' => 1], 'feedback', [], '', 1);
		$data['id'] = $id = $feedback_records[0]->doctor_id;

		if(!empty($id)){
			show_404();
		}

		$this->set_view($data, 'index');
	}

	function question2(){

		$id = $this->input->get('id', TRUE);
		
		if(empty($id)){
			show_404();
		}
		
		$data = array();
		$data['doctor_id'] = $id;

		$this->load->view('question2',$data);
	}

	function question3(){

		$id = $this->input->get('id', TRUE);
		
		if(empty($id)){
			show_404();
		}

		$data = array();
		$data['doctor_id'] = $id;

		$this->load->view('question3',$data);
	}

	function thank_you(){
		$this->load->view('thank-you');
	}

	function save(){
		$result = $this->model->save();
		echo json_encode($result);
	}

}
