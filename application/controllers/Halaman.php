<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Halaman extends CI_Controller {


	public function index()
	{
		$this->load->view('panel/header');
		$this->load->view('panel/nav_top');
		$this->load->view('panel/sidebar');
		$this->load->view('panel/footer');
	}
}
