<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('model_auth');
        $this->load->helper('url');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {

            // Jika validasi berhasil dilakukan
            $this->_login();
        }
    }
    private function _sendEmail($token)
    {
        // Config Setting 
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'emailpass49@gmail.com',
            'smtp_pass' => 'IndowebsteR9',
            'smtp_port' => 587,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        // Send Token Password
        $emailAkun = $this->input->post('email');
        $aktivasi_akun = "
                                <html>
                                <head>
                                    <title>Kode Aktivasi Akun + Isi Password</title>
                                </head>
                                <body>
                                    <h2>Silahkan Klik Link Dibawah Ini!!</h2>
                                    <p>Akun Anda</p>
                                    <p>Email : " . $emailAkun . "</p>
                                    <p>Tolong Klik Link Dibawah ini untuk Aktivasi Akun Anda!</p>
                                    <h4><a href='" . base_url() . "auth/activation?email=" . $emailAkun . "&token=" . urlencode($token) . "'>Aktivasi Akun!!</a></h4>
                                </body>
                                </html>
        ";
        $this->load->library('email', $config);
        $this->email->from('alfiannsx98@gmail.com', 'Aktivasi Akun');
        $this->email->to($this->input->post('email'));
        
        $this->email->subject('Aktivasi Akun');
        $this->email->message($aktivasi_akun);
        $this->email->set_mailtype('html');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                //cek Password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                    redirect('user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Ini Belum Di Aktivasi!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf Email belum terdaftar!</div>');
            redirect('auth');
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('token_user', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 72)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('token_user', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' User Telah di Aktivasi!!Silahkan Login</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);

                    $this->db->delete('token_user', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token Kadaluarsa!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token Salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi Gagal</div>');
            redirect('auth');
        }
    }

    public function lupaPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupapassword');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('token_user', $user_token);
                $this->_sendEmail($token, 'Lupa');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">Silahkan Cek Email Anda Untuk Reset Password!!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Anda Belum Terdaftar! Atau Akun Belum Aktif</div>');
                redirect('auth/lupapassword');
            }
        }
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('token_user', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->gantiPassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal! Email/Token Salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal!Email Salah!</div>');
            redirect('auth');
        }
    }

    public function gantiPassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required|min_length[8]|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ganti Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/ganti-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->model_auth->hapus_token($email);
            $this->session->unset_userdata('reset_email');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil Diubah! Silahkan Login</div>');
            redirect('auth');
        }
    }
    public function verify_akun_admin()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('token_user', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 72)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    // $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' User Telah di Aktivasi!!Silahkan Masukkan data Password Anda</div>');
                    redirect("auth/resetpassword?email=" . $email . "&token=" . urlencode($token));
                } else {
                    $this->db->delete('user', ['email' => $email]);

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token Kadaluarsa!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token Salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi Gagal</div>');
            redirect('auth');
        }
    }

    // Auth -> Activation (Untuk aktivasi Akun) + Isi Password untuk akun baru + Set is_active->1

    public function activated()
    {
        if (!$this->session->userdata('email_aktivasi')) {
            redirect('auth');
        }
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'trim|required|min_length[8]|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Aktivasi Akun';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/activated');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('email_aktivasi');
            $active = 1;
            $this->db->set('password', $password);
            $this->db->set('is_active', $active);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->model_auth->hapus_token($email);
            $this->session->unset_userdata('email_aktivasi');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Berhasil Diaktivasi! Silahkan Login</div>');
            redirect('auth');
        }
    }

    public function activation()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('token_user', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('email_aktivasi', $email);
                $this->activated();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal! Email/Token Salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal!Email Salah!</div>');
            redirect('auth');
        }
    }
    // Ganti email akun
    public function ganti_email_akun_activated()
    {
        if (!$this->session->userdata('account')) {
            redirect('auth');
        }else{
            $email_baru = $this->session->userdata('ganti_email_baru');
            $account = $this->session->userdata('account');

            $this->db->set('email', $email_baru);
            $this->db->where('id_user', $account);
            $this->db->update('user');

            $this->model_auth->hapus_token($email_baru);
            $this->session->unset_userdata('ganti_email_baru');
            $this->session->unset_userdata('account');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Berhasil Diaktivasi! Silahkan Login</div>');
            redirect('auth');
        } 
    }
    // Function untuk ganti email ketika edit data
    public function gantiemail()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $account = $this->input->get('account');

        $user = $this->db->get_where('user', ['id_user' => $account])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('token_user', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('account', $account);
                $this->session->set_userdata('ganti_email_baru', $email);
                $this->ganti_email_akun_activated();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset Password Gagal! Email/Token Salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User gagal diaktivasi, user tidak ditemukan</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda Telah Keluar!</div>');
        redirect('auth');
    }
    public function blocked()
    {
        $this->load->view('templates/404_header');
        $this->load->view('auth/blocked');
    }
    public function register()
    {
        $data['title'] = 'Register User';
        
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]',
            array(
                'is_unique' => 'This Email already Exist'
            )
        );
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[10]|max_length[64]');
        $this->form_validation->set_rules('about', 'About', 'trim|required');
        $this->form_validation->set_rules('notelp', 'Nomor Telepon', 'trim|required|numeric|min_length[8]|max_length[14]',
            array(
                'numeric' => 'This contain not number'
            )
        );
        $this->form_validation->set_rules('password', 'Password Baru', 'required|trim|min_length[8]');

        if($this->form_validation->run() == false){
            $data['title'] = 'Register User';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        }else{
            
            // Function untuk create data + autonumber

            $q_count = $this->db->get('user')->num_rows();

            $id_user = "USR" . ($q_count + 1) . date('Hdyims', time());
            $password_baru = htmlspecialchars($this->input->post('password'));
            $password = password_hash($password_baru, PASSWORD_DEFAULT);
            $data = [
                'id_user' => htmlspecialchars($id_user),
                'nama' => htmlspecialchars($this->input->post('nama')),
                'alamat' => htmlspecialchars($this->input->post('alamat')),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'email' => htmlspecialchars($this->input->post('email')),
                'username' => '-',
                'notelp' => htmlspecialchars($this->input->post('notelp')),
                'profile_image' => 'default.jpg',
                'about' => htmlspecialchars($this->input->post('about')),
                'password' => $password,
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => htmlspecialchars(time()),
                'update_at' => 0
            ];

            // Function untuk send email ketika berhasil registrasi

            $email = $this->input->post('email');
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('token_user', $user_token);
            $this->_sendEmail($token);

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan</div>');
            redirect('auth');
        }
    }
}
