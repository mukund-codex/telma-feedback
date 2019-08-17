<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Divisions extends User_Controller
{
	private $module = 'divisions';
    private $model_name = 'mdl_divisions';
    private $controller = 'divisions';
    private $settings = [
        'permissions'=> ['add','edit','remove','download','upload'],
    ];
    
    private $scripts = ['doctor.js'];    

	function __construct() {
        $user_role = $this->session->get_field_from_session('role');
        
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

		$filters = array();

		$limit = $this->dropdownlength;
		$page = intval($_POST['page']) - 1;
		$page = ($page <= 0) ? 0 : $page;
		
		$s_term = (isset($_POST['search'])) ? $this->db->escape_like_str($_POST['search']) : '';
		$id = (isset($_POST['id'])) ? (int) $this->input->post('id') : 0;

		if($id){ $filters['division_id'] = $id; }

		$new = array(); $json['results'] = array();

		$_options = $this->model->get_options($s_term, 'division_name', $filters, $page * $limit, $limit);
		$_opt_count = count($this->model->get_options($s_term, 'division_name', $filters));

		foreach($_options as $option){
			$new['id'] = $option->division_id;
			$new['text'] = $option->division_name;

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

			if(count($data) !== 2) { continue; }            
            
            $division_name = trim($data[0]);
            $sender_id = trim($data[1]);

            if( empty($division_name) || empty($sender_id)){
                continue;
            }

			$record = $this->model->get_or_records(['division_name'=> $division_name, 'sender_id' => $sender_id], 'divisions', ['division_id'], '', 1);
			if(count($record)) {
				continue;
			}

            $insert['division_name'] = $division_name;
            $insert['sender_id'] = $sender_id;

            $this->model->_insert($insert);

            $newrows++;
		}

		fclose($handle);

		echo json_encode(['newrows'=> "$newrows record(s) added successfully"]);
	}
}
