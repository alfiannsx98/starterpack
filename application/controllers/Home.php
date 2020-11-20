<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'YBM - BRI Kanwil Malang Blog';
        $this->load->view('templates/landing_header', $data);
        $this->load->view('templates/landing_topbar', $data);
        $this->load->view('landing_home/index');
        $this->load->view('templates/landing_footer');
    }
    public function register()
    {
        if($this->session->userdata('email_pembeli')){
            redirect('home');
        }

        $query1 = $this->db->query("SELECT * FROM pembeli");
        $tabel1 = $query1->num_rows();
        $date = date('dm', time());
        $id_pembeli = "ID-P" . $tabel1 . $date;

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama harus diisi']);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[pembeli.email]', ['required' => 'Email harus diisi', 'is_unique' => 'Email telah terdaftar!']);

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]matches[password1]', ['required' => 'Password harus diisi', 'matches' => 'Password tidak sama!', 'min_length' => 'Password Terlalu Pendekk']);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password]', ['required' => 'Password harus diisi', 'matches' => 'Password tidak sama!']);

        if($this->form_validation->run() == false){
            $data['title'] = 'Register Akun Anda';
            $this->load->view('templates/landing_header', $data);
            $this->load->view('templates/landing_topbar', $data);
            $this->load->view('landing_home/register', $data);
            $this->load->view('templates/landing_footer', $data);
        }elsE{
            
        } 
    }
}