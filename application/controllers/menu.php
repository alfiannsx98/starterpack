<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_menu');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Management Menu';
        $data['user'] = $this->db->get_where('user', [
            'email' => 
            $this->session->userdata('email')
        ])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/custom-footer', $data);
            $this->load->view('templates/dist-footer', $data);
            $this->load->view('templates/footer', $data);
        }else{
            $data = [
                'menu' => $this->input->post('menu'),
                'icon' => $this->input->post('icon')
            ];
            $this->db->insert('user_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan</div>');
            redirect('menu');
        }
    }
    public function edit_menu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('icon', 'Ienu', 'required');

        if($this->form_validation->run() == false){
            redirect('menu');
        }else{
            $id = $this->input->post('id_menu');
            $menu = $this->input->post('menu');
            $icon = $this->input->post('icon');
            $this->model_menu->edit_menu($id, $menu, $icon);
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Data Berhasil Diubah</div>');
            redirect('menu');
        }
    }
    public function hapus_menu()
    {
        $id = $this->input->post('id_menu');
        $this->model_menu->hapus_menu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Berhasil Dihapus</div>');
        redirect('menu');
    }
    public function submenu()
    {
        $data['title'] = 'Sub Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>

        $this->session->userdata('email')])->row_array();

        $data['subMenu'] = $this->model_menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/custom-footer', $data);
            $this->load->view('templates/dist-footer', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'menu_id' => $this->input->post('menu_id'),
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('submenu_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan</div>');
            redirect('menu/submenu');
        };
    }
    public function edit_submenu()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');

        if($this->form_validation->run() == false){
            redirect('menu/submenu');
        }else{
            $id = $this->input->post('id_submenu');
            $menu_id = $this->input->post('menu_id');
            $title = $this->input->post('title');
            $url = $this->input->post('url');
            $is_active = $this->input->post('is_active');
            $this->model_menu->edit_submenu($id,  $menu_id, $title, $url, $is_active);
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Data Berhasil Diubah</div>');
            redirect('menu/submenu');
        }
    }
    public function hapus_submenu()
    {
        $id = $this->input->post('id_menu');
        $this->model_menu->hapus_submenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Berhasil Dihapus</div>');
        redirect('menu/submenu');
    }
}


?>