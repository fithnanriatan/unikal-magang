<?php

class Dashboard extends CI_Controller
{
    private function _index($data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer', $data);
    }

    public function index()
    {
        if (!$this->session->userdata('nama')) {
            redirect();
        }

        $user = $this->session->userdata('username');

        $data = [
            "title" => "Dashboard",
            "user"  => $this->db->get_where('user', ['nama_user' => $user])->row_array()
        ];

        $this->_index($data);
    }

    public function alert($flash, $message, $target)
    {
        $mess = str_replace('%20', ' ', $message);

        $this->session->set_flashdata($flash, $mess);
        redirect('data/' . $target);
    }
}
