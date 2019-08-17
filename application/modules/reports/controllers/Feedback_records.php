<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Feedback_records extends Reports_Controller
{
	private $module = 'feedback_records';
	private $controller = 'reports/feedback_records';
    private $model_name = 'mdl_feedback_records';
    private $columns = ['Doctor Name', 'Doctor Mobile','How Likely are you to recommend us in sharing therapy related scientific information on daily basic?', 'Kindly rate us on quality of science information?', 'Would you like to have full text of the daily alerts?', 'Date'];
    
	function __construct() {
		parent::__construct(
            $this->module, 
            $this->controller, 
            $this->model_name, 
            $this->columns
        );
	}
}
