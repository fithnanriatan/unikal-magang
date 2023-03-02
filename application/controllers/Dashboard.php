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
            "user"  => $this->db->get_where('user', ['nama_user' => $user])->row_array(),
            "data"  => $this->_jml_data()
        ];

        $this->_index($data);
    }

    private function _jml_data()
    {
        $data = [
            'sekolah'       => $this->db->get('sekolah')->num_rows(),
            'pem_sekolah'   => $this->db->get('pembimbing_sekolah')->num_rows(),
            'pem_unikal'    => $this->db->get('pembimbing_unikal')->num_rows(),
            'siswa'         => $this->db->get('siswa')->num_rows()
        ];

        return $data;
    }

    public function alert($flash, $message, $target)
    {
        $mess = str_replace('%20', ' ', $message);

        $this->session->set_flashdata($flash, $mess);
        redirect('data/' . $target);
    }
}
