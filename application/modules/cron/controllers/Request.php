<?php 
class Request extends Generic_Controller{

    private $model_name = 'mdl_request';

	function __construct()
	{
		parent::__construct();
		$this->load->model($this->model_name, 'model');
    }
    
    function process_bulk_sms(){
        $current_datetime = date('Y-m-d H:i:00');

        $this->load->helper('send_sms');
        $is_cron_active = $this->model->is_cron_active();

        if($is_cron_active){
            echo 'SMS Sending already in progress'; 
            die();
        }

        $update = $this->model->_update(['status'=> 0], ['status'=> 1], 'sms_cron_status'); 

        if(!$update){
            echo 'Unable to start the cron, please check the conditions'; 
            die();
        }

        $sms_collection = $this->model->get_doctors();
        
        if(count($sms_collection)){
            
            foreach ($sms_collection as $sms) {
                
                $sms_data_id = $sms['sms_data_id'];
                $name = $sms['name'];
                $mobile = $sms['mobile'];
                $email = (!empty($sms['email'])) ? $sms['email'] : '';
				$division_name = $sms['division_name'];
				$sender_id = $sms['sender_id'];
                $sms_type = $division_name; 
                $message = $sms['message']; 
                $sms_date_time = $sms['sms_date_time']; 
                $original_url = $sms['original_url'];
                $short_url = $sms['short_url'];

                if(empty($short_url)){
                    $short_url = $original_url;
                }
               
                if(!empty($short_url) && empty($email)){
                    $message .= PHP_EOL."Link to access full text article : $short_url";
                }
               
                if(empty($name) || empty($mobile) || empty($sender_id) || empty($message) || empty($sms_date_time) ) {
                    
                    continue;
                }
                
                if(strtotime($current_datetime) == strtotime($sms_date_time)) {
                    $sms_status = send_sms($mobile, $message, $sms_type, '', '', $sender_id);
                    
                    if($sms_status){
                        $update = $this->model->_update(['sms_data_id' => $sms_data_id], ['is_processed' => 1], 'sms_data');
                    }else{
                        echo 'SMS sending failed for ' . $sms_data_id;
                    }
                }

            }
        }
        $this->model->_update(['status'=> 1], ['status'=> 0], 'sms_cron_status');

        echo 'Success';
        exit;
    }

    function send_article_email(){
        $this->load->helper('send_email');
        $this->load->helper('send_sms');

        $is_cron_active = $this->model->is_mail_cron_active();

        if($is_cron_active){
            echo 'Email Sending already in progress'; 
            die();
        }

        $records = $this->model->get_email_data();

        if(empty($records)){
            echo 'No Records Found.'; 
            die();
        }

        $update = $this->model->_update(['status'=> 0], ['status'=> 1], 'sms_cron_status'); 

        if(!$update){
            echo 'Unable to start the cron, please check the conditions'; 
            die();
        }

        foreach($records as $key => $values){
            $content = "";
            $message = "";
            
            $data = [];
            $email_data_id = $values['email_data_id'];
            $data['doctor_id'] = $values['doctor_id'];
            $division_name = $sms_type = $values['division_name'];
            $sender_id = $values['sender_id'];
            $doctor_name = $values['doctor_name'];
            $doctor_mobile = $values['doctor_mobile'];
            $data['doctor_email'] = $doctor_email = $values['doctor_email'];
            $doctor_want_article = ($values['question3'] == 'Y') ? 'yes' : 'no';
            $doctor_article_title = $values['article_title'];
            $original_url = $values['original_url'];
            $short_url = $values['short_url'];
            $article_file = $values['file'];
            
            $data['subject'] = $subject = "TelmaSendSMS - Testing Mails";

            $content .= "Dear $doctor_name,";

            $data['content'] = $content;
                
            $email = send_email([$doctor_email], $subject, $content, [$article_file]);
            
            $data['is_success'] = ($email) ?? 0;

            $insert = $this->model->_insert($data, 'email_log');
            
            $update = $this->model->_update(['email_data_id' => $email_data_id], ['is_processed' => 1], 'email_data');
                
        }

        echo "Success";
        exit;

    }
}