<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends Api_Controller {

    function __construct() {
        parent::__construct();
    }

    public function show_login() {
        $this->format_response(500, 'failure', 'Server Error', 'New Error');
    }
}