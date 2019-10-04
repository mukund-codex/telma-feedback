<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_article extends MY_Model {

	private $p_key = 'article_id';
    private $table = 'article';
    private $tb_alias = 'a';
    private $fillable = ['title', 'description', 'file'];
 	private $column_list = ['Title', 'Description', 'File', 'Original URL', 'Short URL', 'Date'];
    private $csv_columns = ['Title', 'Description', 'File', 'Original URL', 'Short URL', 'Date'];

	function __construct() {
        parent::__construct();
	}

    function get_csv_columns() {
        return $this->csv_columns;
    }

    function get_column_list() {
        return $this->column_list;
    }

    function get_filters() {
        return [
            [],
        ];
    }

    function get_filters_from(array $filters): array {
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
    	$q = $this->db->select('
           a.*
    	')
        ->from('article a');
				
			if(sizeof($sfilters)) { 
			foreach ($sfilters as $key=>$value) { $q->where("$key", $value); }
		}


		if(is_array($rfilters) && count($rfilters) ) {
			$field_filters = $this->get_filters_from($rfilters);
			
			foreach($rfilters as $key=> $value) {
                if(!in_array($key, $field_filters)) {
                    continue;
                }

                $key = str_replace('|', '.', $key);
                
                if($key == 'from_date' && $value) {
                    $this->db->where('DATE('.$this->tb_alias.'.insert_dt) >=', date('Y-m-d', strtotime($value)));
                    continue;
                }

                if($key == 'to_date' && $value) {
                    $this->db->where('DATE('.$this->tb_alias.'.insert_dt) <=', date('Y-m-d', strtotime($value)));
                    continue;
                }

                if(!empty($value))
                    $this->db->like($key, $value);
            }
        }
		
		if(! $count) {
			$q->order_by('a.insert_dt desc');
		}

		if(!empty($limit)) { $q->limit($limit, $offset); }        
		$collection = (! $count) ? $q->get()->result_array() : $q->count_all_results();
		return $collection;
    }	
    
    function validate($type)
	{
        $role = 'ZSM';

		if($type == 'save') {
			return [
                [
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'trim|required|max_length[100]|xss_clean'
                ],
			];
		}

		if($type == 'modify') {
            
            return [
                [
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'trim|required|max_length[100]|xss_clean'
                ],
			];
		}
    }

	function save(){
		
		/*Load Upload Media Helper*/
		$this->load->helper('upload_media');

		/*Load the form validation Library*/
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
		
		if(($_FILES['file']['size']) > 0) {
			$is_doc_file_upload = upload_media('file', 'uploads/articles', ['pdf'], 10000000);

			if(array_key_exists('error', $is_doc_file_upload)) {
				$response['errors'] = [
					"document" => $is_doc_file_upload['error']
				]; 
            	$response['status'] = FALSE;
            	
				return $response;
			}
			if(!$is_doc_file_upload) {
				$response['errors'] = [
					"files" => '<label class="error">Invalid File Selected, Please try again.</label>',
				];
	
				$response['status'] = FALSE;
				
				return $response;
			}	
		}


		$data['file'] = (!empty($is_doc_file_upload[0]['file_name'])) ? $is_doc_file_upload[0]['file_name'] : '';
		$data['original_url'] = '';
		$data['short_url'] = '';
		if(!empty($data['file'])){
			$url = base_url($data['file']);
			$data['original_url'] = $url;
	
			$tiny_url = $this->get_bitly_url($url);
			$data['short_url'] = $tiny_url;
		}

        $id = $this->_insert($data, 'article');
		//echo $this->db->last_query();exit;

        if(! $id){
            $response['message'] = 'Internal Server Error';
            $response['status'] = FALSE;
            return $response;
        }

        $response['status'] = TRUE;
        $response['message'] = 'Congratulations! new record created.';

        return $response;
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
        if(empty($data['users_mobile'])) {
            $data['users_mobile'] = NULL;
        }

        $p_key = $this->p_key;

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

	function _format_data_to_export($data){
		
		$resultant_array = [];
		
		foreach ($data as $rows) {
			$records['Title'] = $rows['title'];
			$records['Description'] = $rows['description'];
			$records['File'] = (!empty($rows['file'])) ? base_url($rows['file']) : '';
			$records['Original URL'] = $rows['original_url'];
			$records['Short URL'] = $rows['short_url'];
			$records['Date'] = $rows['insert_dt'];
			array_push($resultant_array, $records);
		}
		return $resultant_array;
	}

	function get_bitly_url($url){

		$this->load->helper('bitly_url');
		$tiny_url = bitly_url($url);
		return $tiny_url;

	}
}