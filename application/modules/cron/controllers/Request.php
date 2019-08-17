<?php 
class Request extends Generic_Controller{

    private $model_name = 'mdl_request';

	function __construct()
	{
		parent::__construct();
		$this->load->model($this->model_name, 'model');
    }
    
    function process_bulk_sms(){
        $this->load->helper('send_sms');
        $is_cron_active = $this->model->is_cron_active();

        if($is_cron_active){
            echo 'SMS Sending already in progress'; die();
        }

        $update = $this->model->_update(['status'=> 0], ['status'=> 1], 'sms_cron_status'); 

        if(!$update){
            echo 'Unable to start the cron, please check the conditions'; die();
        }

        $sms_collection = $this->model->get_records([], 'sms_queue');

        if(count($sms_collection)){
            
            foreach ($sms_collection as $sms) {
                $sms_queue_id = $sms->sms_queue_id;
                $mobile = $sms->send_to;
				$user_type = $sms->user_group;
				$sms_group = $sms->selection_type;
                $message = $sms->sms_text;
                $sms_type = $user_type . ' ' . $sms_group; 

                /* $insertArr['is_valid_request'] = 1;
				$insertArr['reason'] = $sms_type = $user_type . ' ' . $sms_group .' SMS SENT'; */

				$sms_status = send_sms($mobile, $message, $sms_type);
                //$is_success = $this->model->_insert($insertArr, 'sms_received_log');
                
                if($sms_status){
                    $deleted = $this->model->_delete('sms_queue_id', [$sms_queue_id], 'sms_queue');
                }else{
                    echo 'SMS sending failed for ' . $sms_queue_id;
                }
            }
        }
        $this->model->_update(['status'=> 1], ['status'=> 0], 'sms_cron_status');
    }
}