<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_sms extends Generic_Controller
{
	private $model_name = 'mdl_sms';

	function __construct()
	{
		parent::__construct();
		$this->load->model($this->model_name, 'model');
	}

	public function index()
	{
		/*$this->load->helper('send_sms');
		$doctors = $this->model->get_collection();
		if(!empty($doctors))
		{
			foreach($doctors as $doc)
			{
				if(!empty($doc->expected_dt)){
					$previous_date = date('Y-m-d', strtotime($doc->expected_dt .' -1 day'));
					$todaydate = date("Y-m-d");
					if($previous_date == $todaydate)
					{
						$doctor_msg = "Dear Dr. ".$doc->doctor_name.",\nGentle reminding about your Bioflash documents which will be collected by our AFM ".$doc->asm_name." tomorrow.\nRegards,\nTeam Ridacne";
						// send_sms($doc->doctor_mobile, $doctor_msg, 'DOCTOR REMINDER');

						$afm_msg = "Dear ".$doc->asm_name." , \nGentle reminding about Bioflash documents.Please collect the documents of bioflash of Dr. ".$doc->doctor_name." tomorrow .\nRegards,\nTeam Ridacne";
						// send_sms($doc->users_mobile, $afm_msg, 'AFM REMINDER');
					}
				}
			}
			exit;
		}*/
	}

	public function send_therapy_pdf_link() {
		$this->load->helper('send_sms');

		$result = $this->model->sms_data_link();
		echo json_encode($result);
	}

	public function sendTemplate() {
		$this->load->helper('send_sms');
		$patientsForTemplate = $this->model->getPatientsForTemplate();
		if(!empty($patientsForTemplate)) {
			foreach($patientsForTemplate as $patientRow) {
				send_sms($patientRow->patient_mobile, trim($patientRow->message), 'Health Tip');
			}
		}
		echo "Done";exit;
	}

	public function voiceCall_one(){
		$this->load->helper('send_voice_call');
		$month = date('m');
		$year = date('Y');
		$doctor_group = ['55'];
		$patients = $this->model->get_patient_collection('','',$doctor_group);
		
		if(!empty($patients))
		{
			foreach($patients as $pat)
			{
				if(!empty($pat->doctor_ivr) && !empty($pat->patient_mobile) ){
					send_voice_call($pat->patient_mobile, $pat->doctor_ivr, 'PATIENT VOICE CALL');
				}
			}
		}

		$doctor_manpower_mr = $this->model->get_collection('MR',$doctor_group);
		if($doctor_manpower_mr){
			foreach ($doctor_manpower_mr as $mr) {
				if(!empty($mr->doctor_ivr) && !empty($mr->mr_mobile)){
					send_voice_call($mr->mr_mobile, $mr->doctor_ivr, 'MR VOICE CALL');
				}
			}
		}

		$doctor_manpower_asm = $this->model->get_collection('ASM',$doctor_group);
		if($doctor_manpower_asm){
			foreach ($doctor_manpower_asm as $asm) {
				if(!empty($asm->doctor_ivr) && !empty($asm->asm_mobile)){
					send_voice_call($asm->asm_mobile, $asm->doctor_ivr, 'ASM VOICE CALL');
				}
			}
		}
		
		exit;
	}

	public function voiceCall_two(){
		$this->load->helper('send_voice_call');
		$from = "06/11/2018";
		$to = "06/11/2018";
		$limit = 5000;
		//check campaign
		$curl ="http://obd.solutionsinfini.com/api/v1/?api_key=54c3f83cfc3ece41716676e9bdd5e0b6&method=voice.campaign&format=json&fromdate=".$from."&todate=".$to."&limit=$limit";
		
		$cch = curl_init();
		curl_setopt($cch, CURLOPT_URL, $curl);
		curl_setopt($cch, CURLOPT_RETURNTRANSFER, 1);
		$coutput = curl_exec($cch);
		curl_close($cch);
		
		$camp_userdata = json_decode($coutput, true);
		
		$camp_data = $camp_userdata['data'];
		if(!empty($camp_data))
		{
			foreach($camp_data as $c_data)
			{
				$campaign = $c_data['campaign'];
				$added = $c_data['added'];
				if(empty($campaign))
				{
					$camp_id = $c_data['id'];
					//now check camp records
					$url ="http://obd.solutionsinfini.com/api/v1/?api_key=54c3f83cfc3ece41716676e9bdd5e0b6&method=voice.reports&format=json&fromdate=".$from."&todate=".$to."&limit=20000&campaign=".$camp_id."";
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$output = curl_exec($ch);
					curl_close($ch);
					
					$userdata = json_decode($output, true);

					$datas = $userdata['data'];
					
					// echo '<pre>';print_r($datas);exit;
					// $mobile = array_column($datas, 'mobile');
					// echo '<pre>';print_r($mobile);exit;

					$cron1 = $cron_one_status = [];
					foreach ($datas as $key => $value) {
						$cron1[$value['mobile']][] = $value;
					}
					$mobile_called = array_keys($cron1);
					// echo '<pre>';print_r($mobile_called);exit;

					$failed_voice_call = $failed_calls = [];
					$call_processed = FALSE;
					
					if(count($cron1)){
						
						foreach ($cron1 as $k1 => $v1) {
							foreach ($v1 as $k2 => $v2) {
								if($v2['finalstatus'] == 'COMPLETED'){
									$call_processed = TRUE;
									$v2['mobile'] = $k1;
									array_push($failed_voice_call, $v2);
									break;
								}else{
									$v2['mobile'] = $k1;
									array_push($failed_voice_call, $v2);
								}
							}

							if($call_processed){
								$completed_calls[] = $k1;
							}

							$call_processed = FALSE;

						}

						$failed_calls = array_diff($mobile_called, $completed_calls);
					}

					// echo '<pre>';print_r($failed_voice_call);exit;
					if(count($failed_voice_call)){
						$voice_cron_one_log = $this->model->_insert_batch($failed_voice_call,'status_log');
					}

					print_r($this->db->last_query());exit;
	
					// ==================
					$doctor_id = ['24','32','34','36'];
					$patients = $this->model->get_patient_collection('','',$doctor_id,$failed_calls);

					if(!empty($patients))
					{
						foreach($patients as $pat)
						{
							if(!empty($pat->doctor_ivr) && !empty($pat->patient_mobile) ){
								// send_voice_call($pat->patient_mobile, $pat->doctor_ivr, 'PATIENT VOICE CALL');
							}
						}
					}				

					if(count($failed_calls)){
						$ff['8318592045'] = '335980';
						$ff['9896027252'] = '336787';
						$ff['9569286643'] = '336328';
						$ff['9255559595'] = '336304';

						$ff['7376620057'] = '335980';
						$ff['8956777328'] = '336328';
						foreach ($failed_calls as $value) {
							if(array_key_exists($value, $ff)){
								// send_voice_call($value, $ff[$value], 'VOICE CALL');
								unset($ff[$value]);
							}
						}
					}				

					
				}
			}
		}
	}

	public function voiceCall_three(){
		$this->load->helper('send_voice_call');
		$from = "06/11/2018";
		$to = "06/11/2018";
		$limit = 5000;
		//check campaign
		$curl ="http://obd.solutionsinfini.com/api/v1/?api_key=54c3f83cfc3ece41716676e9bdd5e0b6&method=voice.campaign&format=json&fromdate=".$from."&todate=".$to."&limit=$limit";
		
		$cch = curl_init();
		curl_setopt($cch, CURLOPT_URL, $curl);
		curl_setopt($cch, CURLOPT_RETURNTRANSFER, 1);
		$coutput = curl_exec($cch);
		curl_close($cch);
		
		$camp_userdata = json_decode($coutput, true);
		
		$camp_data = $camp_userdata['data'];
		if(!empty($camp_data))
		{
			foreach($camp_data as $c_data)
			{
				$campaign = $c_data['campaign'];
				$added = $c_data['added'];
				if(empty($campaign))
				{
					$camp_id = $c_data['id'];
					//now check camp records
					$url ="http://obd.solutionsinfini.com/api/v1/?api_key=54c3f83cfc3ece41716676e9bdd5e0b6&method=voice.reports&format=json&fromdate=".$from."&todate=".$to."&limit=20000&campaign=".$camp_id."";
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$output = curl_exec($ch);
					curl_close($ch);
					
					$userdata = json_decode($output, true);

					$datas = $userdata['data'];
					
					// echo '<pre>';print_r($datas);exit;
					// $mobile = array_column($datas, 'mobile');
					// echo '<pre>';print_r($mobile);exit;

					$cron1 = $cron_one_status = [];
					foreach ($datas as $key => $value) {
						$cron1[$value['mobile']][] = $value;
					}
					$mobile_called = array_keys($cron1);
					// echo '<pre>';print_r($mobile_called);exit;

					$failed_voice_call = $failed_calls = [];
					$call_processed = FALSE;
					
					if(count($cron1)){
						
						foreach ($cron1 as $k1 => $v1) {
							foreach ($v1 as $k2 => $v2) {
								if($v2['finalstatus'] == 'COMPLETED'){
									$call_processed = TRUE;
									$v2['cron_voice_status'] = '2';
									$v2['mobile'] = $k1;
									array_push($failed_voice_call, $v2);
									break;
								}else{
									$v2['mobile'] = $k1;
									$v2['cron_voice_status'] = '2';
									array_push($failed_voice_call, $v2);
								}
							}

							if($call_processed){
								$completed_calls[] = $k1;
							}

							$call_processed = FALSE;

						}

						$failed_calls = array_diff($mobile_called, $completed_calls);
					}

					// echo '<pre>';print_r($failed_voice_call);exit;
					if(count($failed_voice_call)){
						$voice_cron_one_log = $this->model->_insert_batch($failed_voice_call,'status_log');
					}
	
					// ==================
					$doctor_id = ['24','32','34','36'];
					$patients = $this->model->get_patient_collection('','',$doctor_id,$failed_calls);

					if(!empty($patients))
					{
						foreach($patients as $pat)
						{
							if(!empty($pat->doctor_ivr) && !empty($pat->patient_mobile) ){
								send_voice_call($pat->patient_mobile, $pat->doctor_ivr, 'PATIENT VOICE CALL');
							}
						}
					}				

					if(count($failed_calls)){
						$ff['8318592045'] = '335980';
						$ff['9896027252'] = '336787';
						$ff['9569286643'] = '336328';
						$ff['9255559595'] = '336304';

						$ff['7376620057'] = '335980';
						$ff['8956777328'] = '336328';
						foreach ($failed_calls as $value) {
							if(array_key_exists($value, $ff)){
								send_voice_call($value, $ff[$value], 'VOICE CALL');
								unset($ff[$value]);
							}
						}
					}				

					
				}
			}
		}
	}
}