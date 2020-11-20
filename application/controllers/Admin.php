<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('model_admin');
        $this->load->model('m_dashboard');
        $this->load->model('m_data');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['title1'] = 'Data User Aktif';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();
        $data['jml_aktif'] = $this->m_dashboard->select_by_user();
        $data['aktif'] = $this->m_dashboard->select_by_role();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/custom-footer', $data);
        $this->load->view('templates/dist-footer', $data);
        $this->load->view('templates/footer', $data);
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        $data['role'] = $this->db->get('user_role')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/custom-footer', $data);
            $this->load->view('templates/dist-footer', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = ['role' => $this->input->post('role')];
            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan</div>');
            redirect('admin/role');
        }
    }
    public function roleaccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id_role' => $role_id])->row_array();

        $this->db->where('id_menu !=', 1);

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('templates/custom-footer', $data);
        $this->load->view('templates/dist-footer', $data);
        $this->load->view('templates/footer', $data);
    }
    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('access_user', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('access_user', $data);
        } else {
            $this->db->delete('access_user', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses Diubah!</div>');
    }
    public function edit_role()
    {
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            redirect('admin/role');
        } else {
            $id = $this->input->post('id');
            $role = $this->input->post('role');
            $this->model_admin->edit_role($id, $role);
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Data Berhasil Diubah</div>');
            redirect('admin/role');
        }
    }
    public function hapus_role()
    {
        $id = $this->input->post('id_role');
        $this->model_admin->hapus_role($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Berhasil Dihapus</div>');
        redirect('admin/role');
    }
}
