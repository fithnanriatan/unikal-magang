<?php

class Auth extends CI_Controller
{
    public function index()
    {
        if ( $this->session->userdata('username') ) {
            redirect('dashboard');
        }

        $data['title'] = "Login Page";

        $un = htmlspecialchars($this->input->post('username'), TRUE);
        $pw = htmlspecialchars($this->input->post('password'), TRUE);
        $user = $this->db->get_where('user', ['nama_user' => $un])->row_array();

        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

        if ( $this->form_validation->run() == false ) {

            $this->load->view('login', $data);

        } else {

            if ($user && $user['password'] == $pw) {

                $data = [
                    'nama' => $user['nama_lengkap'],
                    'username' => $user['nama_user']
                ];

                $this->session->set_userdata($data);
                $this->session->set_flashdata('auth', 'Anda berhasil Login!');
                redirect('dashboard');

            } else {

                $this->mf->flash_login('danger', '<b>username</b> atau <b>password</b> salah');
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
