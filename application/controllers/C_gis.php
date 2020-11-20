<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_gis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_mapping');
        $this->load->helper('url');
    }

    public function home()
    {
        $data['title'] = 'Home GIS';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['cabang'] = $this->db->get('cabang')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('gis/home', $data);
        $this->load->view('templates/footer', $data);
    }
    public function mapping()
    {
        $data['title'] = 'Mapping';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $data['mapping'] = $this->db->get('cabang')->result_array();

        $data['getCabang'] = $this->db->get('cabang')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('gis/mapping', $data);
        $this->load->view('templates/custom-footer', $data);
        $this->load->view('templates/dist-footer', $data);
        $this->load->view('templates/footer', $data);
    }
    public function create_mapping()
    {
        $data['title'] = 'Create Data Mapping';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama_cabang', 'Nama Cabang', 'required');
        $this->form_validation->set_rules('alamat_cabang', 'Alamat Cabang', 'required');
        $this->form_validation->set_rules('status_cabang', 'Status Cabang', 'required');
        $this->form_validation->set_rules('pemilik_cabang', 'Pemilik Cabang', 'required');
        $this->form_validation->set_rules('Latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('Longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        
        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('gis/create-mapping', $data);
            $this->load->view('templates/dist-footer', $data);
            $this->load->view('templates/custom-footer', $data);
            $this->load->view('templates/footer', $data);
        }else{
            $q = $this->db->query("SELECT * FROM cabang");
            $c_q = $q->num_rows();
            if($c_q >= 10){
                $id_cabang = "CB0" . ($c_q + 1);
            }elseif($c_q >= 100){
                $id_cabang = "CB" . ($c_q + 1);
            }else{
                $id_cabang = "CB00" . ($c_q + 1);
            }

            $data = [
                'id_cabang' => $id_cabang,
                'nama_cabang' => htmlspecialchars($this->input->post('nama_cabang')),
                'alamat' => htmlspecialchars($this->input->post('alamat_cabang')),
                'status_cabang' => htmlspecialchars($this->input->post('status_cabang')),
                'pemilik_cabang' => htmlspecialchars($this->input->post('pemilik_cabang')),
                'latitude' => htmlspecialchars($this->input->post('Latitude')),
                'longitude' => htmlspecialchars($this->input->post('Longitude')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan'))
            ];
            $this->db->insert('cabang', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan</div>');
            redirect('C_gis/mapping');
        }
    }
    public function edit_mapping($id_cabang)
    {
        $data['title'] = 'Edit Data Mapping';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['cabang'] = $this->M_mapping->detail($id_cabang);

        $this->form_validation->set_rules('nama_cabang', 'Nama Cabang', 'required');
        $this->form_validation->set_rules('alamat_cabang', 'Alamat Cabang', 'required');
        $this->form_validation->set_rules('status_cabang', 'Status Cabang', 'required');
        $this->form_validation->set_rules('pemilik_cabang', 'Pemilik Cabang', 'required');
        $this->form_validation->set_rules('Latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('Longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        
        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('gis/edit-mapping', $data);
            $this->load->view('templates/footer', $data);
        }else{
            $id_cabang = htmlspecialchars($this->input->post('id_cabang'));
            $nama_cabang = htmlspecialchars($this->input->post('nama_cabang'));
            $alamat = htmlspecialchars($this->input->post('alamat_cabang'));
            $status_cabang = htmlspecialchars($this->input->post('status_cabang'));
            $pemilik_cabang = htmlspecialchars($this->input->post('pemilik_cabang'));
            $latitude = htmlspecialchars($this->input->post('Latitude'));
            $longitude = htmlspecialchars($this->input->post('Longitude'));
            $keterangan = htmlspecialchars($this->input->post('keterangan'));

            $this->M_mapping->edit_mapping($id_cabang, $nama_cabang, $alamat, $status_cabang, $pemilik_cabang, $latitude, $longitude, $keterangan);
            $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Data Berhasil Disimpan</div>');
            redirect('C_gis/mapping');
        }
    }
    public function hapus_mapping()
    {
        $id = htmlspecialchars($this->input->post('id_cabang'));
        $this->M_mapping->hapus_mapping($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Berhasil Dihapus</div>');
        redirect('C_gis/mapping');
    }
}

?>