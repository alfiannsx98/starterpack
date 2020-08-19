<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('login_element/header', $data);
        $this->load->view('login_element/topbar', $data);
        $this->load->view('login_element/sidebar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('login_element/footer');
    }
}
