<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_feedback_records extends MY_Model {

    function __construct() {
        parent::__construct();
    }
    
     function get_filters() {
        return [
            [
                'field_name'=>'name',
                'field_label'=> 'Name',
            ],
            [
                'field_name'=>'mobile',
                'field_label'=> 'Mobile'
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
        
        $q = $this->db->select('d.*, f.*')
        ->from('doctor d')
        ->join('feedback f','f.doctor_id = d.doctor_id', 'left')
        ->where('f.complete_status','1');
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

		$user_role = $this->session->get_field_from_session('role','user');

        if(empty($user_role)) {
            $user_role = $this->session->get_field_from_session('role');
		}
		
		if(in_array($user_role, ['MR','ASM','RSM'])) {
			$q->where('d.insert_user_id', $this->session->get_field_from_session('user_id', 'user'));
		}

		if(! $count) {
			$q->order_by('f.update_dt desc');
		}

		if(!empty($limit)) { $q->limit($limit, $offset); }        
        //echo $this->db->get_compiled_select(); die();
        $collection = (! $count) ? $q->get()->result_array() : $q->count_all_results();
		return $collection;
    }	

	/* function get_collection($count = FALSE, $f_filters = [], $rfilters, $limit = 0, $offset = 0 ) {
        $sql = "SELECT ";
		$sql .= "
            *
            FROM feedback f 
            LEFT JOIN doctor d ON f.doctor_id = d.doctor_id";

        $sql .= " WHERE f.complete_status = 1";

		if(is_array($rfilters) && count($rfilters) ) {
			$field_filters = $this->get_filters_from($rfilters);
			
            foreach($rfilters as $key=> $value) {
                $value = trim($value);
                if(!in_array($key, $field_filters)) {
                    continue;
                }
                
                if(!empty($value)) {
                    $value = $this->db->escape_like_str($value);
                    $sql .= " AND $key LIKE '$value%' ";
                }
            }
        }

        if(! $count) {
            if(!empty($limit)) { $sql .= " LIMIT $offset, $limit"; }        
        }
        
        $q = $this->db->query($sql);
        //echo $this->db->last_query(); die();
        $collection = (! $count) ? $q->result_array() : $q->num_rows();
		return $collection;
    } */	
    
	function _format_data_to_export($data){
		
		$resultant_array = [];
		
		foreach ($data as $rows) {
            if($rows['question1'] == '1' || $rows['question1'] == '2'){
                $answer1 = "Terrible";
            }else if($rows['question1'] == '3' || $rows['question1'] == '4'){
                $answer1 = "Bad";
            }else if($rows['question1'] == '5' || $rows['question1'] == '6'){
                $answer1 = "Okay";
            }else if($rows['question1'] == '7' || $rows['question1'] == '8'){
                $answer1 = "Good";
            }else{
                $answer1 = "Bad";
            }

            if($rows['question2'] == '1'){ $answer2 = "Terrible"; }
            else if($rows['question2'] == '2'){ $answer2 = "Bad"; } 
            else if($rows['question2'] == '3'){ $answer2 = "Okay"; } 
            else if($rows['question2'] == '4'){ $answer2 = "Good"; } 
            else{ $answer2 = "Great"; }
            
            $answer3 = ($rows['question3'] == 'Y' ? "Yes" : "No");

			$records['Doctor Name'] = $rows['name'];
            $records['Doctor Mobile'] = $rows['mobile'];
			$records['How Likely are you to recommend us in sharing therapy related scientific information on daily basic?'] = $answer1;
            $records['Kindly rate us on quality of science information?'] = $answer2;
			$records['Would you like to have full text of the daily alerts?'] = $answer3;
			$records['Date'] = $rows['insert_dt'];
			array_push($resultant_array, $records);
		}
		return $resultant_array;
	}
}