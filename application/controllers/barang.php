<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('model_barang');
        is_logged_in();
    }
    public function index()
    {
        $data['title'] = 'Management Barang';
        $data['user'] = $this->db->get_where('user', [
            'email' => 
            $this->session->userdata('email')
        ])->row_array();

        $data['barang'] = $this->db->get('dt_brg')->result_array();
        $data['get_brg'] = $this->model_barang->get_barang();
    
        $this->form_validation->set_rules('nama_brg', 'Nama Barang', 'required');
        $this->form_validation->set_rules('id_ktg', 'Kategori', 'required');
        $this->form_validation->set_rules('harga_brg', 'Harga Barang', 'required');
        $this->form_validation->set_rules('stok', 'Stok Barang', 'required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/index', $data);
            $this->load->view('templates/footer');
        }else{
            $q = $this->db->query("SELECT * FROM dt_brg");
            $c_q = $q->num_rows();
            if($c_q >= 10){
                $id_brg = "BR0" . ($c_q + 1);
            }elseif($c_q >= 100){
                $id_brg = "BR" . ($c_q + 1);
            }else{
                $id_brg = "BR00" . ($c_q + 1);
            }
            // Configuration for upload image
            $upload_image = $_FILES['gambar']['name'];

            if($upload_image){
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '4096';
                $config['upload_path'] = './assets/dist/img/barang/';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('gambar')){
                    $new_image = $this->upload->data('file_name');
                    $gambar = $new_image;
                }else{
                    echo $this->upload->display_errors();
                    $gambar = 'default.jpg';
                }
            }else{
                $gambar = 'default.jpg';
            }
            // End of Configuration for upload image

            $data = [
                'id_brg' => $id_brg,
                'nama_brg' => $this->input->post('nama_brg'),
                'id_ktg' => $this->input->post('id_ktg'),
                'gambar' => $gambar,
                'harga_brg' => $this->input->post('harga_brg'),
                'stok' => $this->input->post('stok')
            ];
            $this->db->insert('dt_brg', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan</div>');
            redirect('barang');
        }
    }
    public function edit_brg()
    {
        $this->form_validation->set_rules('nama_brg', 'Nama Barang', 'required');
        $this->form_validation->set_rules('harga_brg', 'Harga Barang', 'required');
        $this->form_validation->set_rules('stok_brg', 'Stok Barang', 'required');

        if($this->form_validation->run() == false){
            redirect('barang');
        }else{
            $id_brg = $this->input->post('id_brg');
            $nama_brg = $this->input->post('nama_brg');
            $id_ktg = $this->input->post('id_ktg');
            $harga_brg = $this->input->post('harga_brg');
            $stok_brg = $this->input->post('stok_brg');

            $upload_gambar = $_FILES['gambar']['name'];

            if($upload_gambar){
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '4096';
                $config['upload_path'] = './assets/dist/img/barang/';

                $this->load->library('upload', $config);

                $new_image = $this->upload->do_upload('gambar');
                if($new_image){
                    unlink(FCPATH . 'assets/dist/img/barang/' . $new_image);
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('gambar', $gambar_baru);
                }else{
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama_brg', $nama_brg);
            $this->db->set('id_ktg', $id_ktg);
            $this->db->set('harga_brg', $harga_brg);
            $this->db->set('stok', $stok_brg);
            $this->db->where('id_brg', $id_brg);
            $this->db->update('dt_brg');
            // $this->model_barang->edit_barang($id_brg, $nama_brg, $id_ktg, $harga_brg, $stok_brg);
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Data Berhasil Diubah</div>');
            redirect('barang');
        }
    }
    public function hapus_brg()
    {
        $id_brg = $this->input->post('id_brg');
        $gmbr_brg = $this->input->post('gambar');
        unlink(FCPATH . 'assets/dist/img/barang/' . $gmbr_brg);
        $this->model_barang->hapus_barang($id_brg);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Berhasil Dihapus</div>');
        redirect('barang');
    }

    // CRUD Kategori Barang

    public function kategori()
    {
        $data['title'] = 'Management Kategori';
        $data['user'] = $this->db->get_where('user', [
            'email' => 
            $this->session->userdata('email')
        ])->row_array();

        $data['kategori'] = $this->db->get('kategori')->result_array();
        // $data['get_kategori'] = $this->model_barang->get_barang();
    
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/kategori/index', $data);
            $this->load->view('templates/footer');
        }else{
            $data = [
                'kategori' => $this->input->post('nama_kategori')
            ];
            $this->db->insert('kategori', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan</div>');
            redirect('barang/kategori');
        }
    }
    public function edit_kategori()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if($this->form_validation->run() == false){
            redirect('barang/kategori');
        }else{
            $id_kategori = $this->input->post('id_kategori');
            $nama_kategori = $this->input->post('nama_kategori');

            $this->db->set('kategori', $nama_kategori);
            $this->db->where('id_kategori', $id_kategori);
            $this->db->update('kategori');
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Data Berhasil Diubah</div>');
            redirect('barang/kategori');
        }
    }
    public function hapus_kategori()
    {
        $id_kategori = $this->input->post('id_kategori');
        $this->model_barang->hapus_kategori($id_kategori);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Berhasil Dihapus</div>');
        redirect('barang/kategori');
    }

    // Akhir CRUD Kategori Barang
}
?>