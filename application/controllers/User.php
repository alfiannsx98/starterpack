<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('model_admin');
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/custom-footer', $data);
        $this->load->view('templates/dist-footer', $data);
        $this->load->view('templates/footer', $data);
    }
    function alpha_dash_space($str)
    {
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    } 
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' =>
            $this->session->userdata('email')
        ])->row_array();

        $this->form_validation->set_rules('nama', 'Name', 'required|trim|callback_alpha_dash_space', 
            ['required' => 'Nama tidak boleh kosong']
        );
        $this->form_validation->set_rules('about', 'About', 'required|trim',    
            ['required' => 'Masukkan Bio Anda']
        );

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/custom-footer', $data);
            $this->load->view('templates/dist-footer', $data);
            $this->load->view('templates/footer', $data);
        }else{
            $nama = $this->input->post('nama');
            $about = $this->input->post('about');
            $email = $this->input->post('email');

            //cek jika ada gambar/foto
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/dist/img/user/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/dist/img/user/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('nama', $nama);
            $this->db->set('about', $about);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="text-center alert alert-success" role="alert">Selamat Data telah diperbarui</div>');
            redirect('user');
        }
    }
    public function edit_password()
    {
        $data['title'] = 'Edit Password';
        $data['user'] = $this->db->get_where('user', ['email' =>

        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('passwordSkrg', 'PasswordSkrg', 'required|trim');
        $this->form_validation->set_rules('passwordBaru1', 'Password Baru', 'required|trim|min_length[8]|matches[passwordBaru2]');
        $this->form_validation->set_rules('passwordBaru2', 'Pengulangan Password Baru', 'required|trim|min_length[8]|matches[passwordBaru1]');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_password', $data);
            $this->load->view('templates/custom-footer', $data);
            $this->load->view('templates/dist-footer', $data);
            $this->load->view('templates/footer', $data);
        }else{
            $passwordSkrg = $this->input->post('passwordSkrg');
            $passwordBaru = $this->input->post('passwordBaru1');
            if (!password_verify($passwordSkrg, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="text-center alert alert-danger" role="alert"><i class="far fa-window-close"></i> Password Lama Salah</div>');
                redirect('user/edit_password');
            }else{
                if ($passwordSkrg == $passwordBaru) {
                    $this->session->set_flashdata('message', '<div class="text-center alert alert-danger" role="alert"><i class="far fa-window-close"></i> Password Tidak Boleh Sama!</div>');
                    redirect('user/edit_password');
                }else{
                    //Sudah OKE!
                    $passwordHash = password_hash($passwordBaru, PASSWORD_DEFAULT);
                    $date_pass = time();

                    $this->db->set('password', $passwordHash);
                    $this->db->set('change_pass', $date_pass);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="text-center alert alert-success" role="alert"><i class="far fa-check-square"></i> Password Telah Berhasil Diganti</div>');
                    redirect('user');
                }
            }
        }
    }
}
