<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Scheduledsms extends Admin_Controller
{
	private $module = 'scheduledsms';
	private $controller = 'scheduledsms';
	private $model_name = 'mdl_scheduledsms';
	private $columns = ['Division Name', 'Message', 'SMS Date Time', 'Processed Status', 'Date Added', 'Date Updated'];
	private $csv_fields = ['Division Name', 'Message', 'SMS Date Time', 'Processed Status', 'Date Added', 'Date Updated'];
	private $settings = [
        'permissions'=> ['add', 'remove','download'],
	];
	
	private $scripts = ['doctor.js'];

	function __construct() {
		parent::__construct(
			$this->module,
			$this->controller,
			$this->model_name,
			$this->settings,
			$this->scripts
		);

		$this->set_defaults();
	}

	function options(){
		$this->session->is_Ajax_and_logged_in();

		$limit = $this->dropdownlength;
		$page = intval($_POST['page']) - 1;
		$page = ($page <= 0) ? 0 : $page;

		$s_term = (isset($_POST['search'])) ? $this->db->escape_like_str($_POST['search']) : '';

		$new = array(); $json['results'] = array();

		$_options = $this->model->get_options($s_term, 'sms_name', [], $page * $limit, $limit);
		$_opt_count = count($this->model->get_options($s_term, 'sms_name'));

		foreach($_options as $option){
			$new['id'] = $option->sms_id;
			$new['text'] = $option->sms_name;

			array_push($json['results'], $new);
		}
		
		$more = ($_opt_count > count($_options)) ? TRUE : FALSE;
		$json['pagination']['more'] = $more;

		echo json_encode($json);
	}

	function addSmsBalance() {
		$title_txt = 'Add SMS Balance';
		$this->data['js'] = ['generic-add.js'];
		$this->set_view($this->data, 'addSmsBalance', '_admin', $title_txt);
	}

	function saveSmsBalance() {
		$this->session->is_Ajax_and_logged_in();
		$result = $this->model->saveSmsBalance();
		echo json_encode($result);
	}

	/* function download(){

		if( ! $this->session->is_logged_in() )
			redirect('admin/login','refresh');

		$this->data['plugins'] = ['paginate'];
		$this->data['listing_url'] = $this->data['controller'] . '/lists';
		$this->data['download_url'] = $this->data['controller'] . '/download';

		$keywords = (isset($_GET['keywords'])) ? $this->db->escape_like_str($_GET['keywords']) : '';

		$from_date = $this->input->get('from');
		$to_date = $this->input->get('to');

		$sfilters = array();

		if($from_date) {
			$sfilters['DATE(msgdata.insert_dt) >='] = $from_date;
		}

		if($to_date) {
			$sfilters['DATE(msgdata.insert_dt) <='] = $to_date;
		}

		$data = $this->model->get_collection($sfilters, $keywords);


		$fields = $this->model->_format_data_to_export($data);

		$this->download_file($this->data['controller'] . '-' . date('Y-m-d'), $fields);
	} */
}
