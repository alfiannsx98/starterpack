<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	public function index()
	{
		$this->load->view('login_element/login_header');
		$this->load->view('login');
		$this->load->view('login_element/login_footer');
	}
}
