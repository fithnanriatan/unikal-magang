<?php
class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect();
        }
        $this->load->model('user_model', 'mu');
    }

    private function _index($data, $body)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('account/' . $body, $data);
        $this->load->view('templates/footer', $data);
        $this->load->view('account/script', $data);
    }

    public function index()
    {
        $user = $this->session->userdata('username');

        $data = [
            'title' => 'Account',
            'label' => 'Account Setting',
            'user'  => $this->db->get_where('user', ['nama_user' => $user])->row_array()
        ];

        $this->_index($data, 'index');
    }

    public function getData()
    {
        $results = $this->mu->getDataTable();
        $no = $_POST['start'];
        $data = [];

        foreach ($results as $r) {
            $nama = '<span class="text-truncate">' . $r['nama_lengkap'] . '</span>';
            $username = '<span class="text-truncate">' . $r['nama_user'] . '</span>';
            $aksi = '<div class="div d-flex">
                        <a class="btn btn-outline-primary btn-sm tombolUbahUser" data-toggle="modal" data-target="#modal-ubah-user" data-id="' . $r['id_user'] . '"><i class="far fa-edit"></i></a>
                        <a class="btn btn-outline-warning btn-sm mx-1 tombolGantiPass" data-toggle="modal" data-target="#modal-ganti-pass" data-id="' . $r['id_user'] . '"><i class="fas fa-unlock-alt"></i></a>
                        <a href="' . base_url("account/dropDataAccount") . '" class="btn btn-outline-danger btn-sm btn-delete" data-id="' . $r["id_user"] . '"><i class="far fa-trash-alt"></i></a>
                    </div>';
            $row = [++$no, $nama, $username, $aksi];
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mu->count_all_data(),
            "recordsFiltered" => $this->mu->count_filtered_data(),
            "data" => $data
        ];

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function tambahData()
    {
        $password   = $this->input->post('password');
        $hash       = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'nama_lengkap'  => $this->input->post('nama'),
            'nama_user'     => $this->input->post('username'),
            'password'      => $hash
        ];

        $this->db->insert('user', $data);
        
        echo json_encode([
            'success' => true,
            'message' => 'data Account berhasil ditambahkan'
        ]);
    }

    public function ubahData()
    {
        $id = $this->input->post('id');

        $data = [
            'nama_lengkap'  => $this->input->post('ubah_nama'),
            'nama_user'     => $this->input->post('ubah_username')
        ];

        $this->db->update('user', $data, ['id_user' => $id]);

        echo json_encode([
            'success' => true,
            'message' => 'data Account berhasil diubah'
        ]);
    }

    public function gantiPassword()
    {
        $id = $this->input->post('id');

        $pass = $this->input->post('ubah_password');
        $hash = password_hash($pass, PASSWORD_BCRYPT);

        $data = [
            'password' => $hash
        ];

        $this->db->update('user', $data, ['id_user' => $id]);

        echo json_encode([
            'success' => true,
            'message' => 'Password berhasil diubah!'
        ]);
    }

    public function dropDataAccount()
    {
        $id = $this->input->post('id');

        $this->db->delete('user', ['id_user' => $id]);

        echo json_encode([
            'message' => 'Data Account berhasill dihapus'
        ]);
    }

    //---- Passing data edit ke JavaScript ----//
    public function getUserById()
    {
        $id = $this->input->post('id');
        $user = $this->db->get_where('user', ['id_user' => $id])->row_array();

        echo json_encode($user);
    }

    //---->||  Validasi Password  ||<----//
    public function validasiPassLama()
    {
        $id = $this->input->post('id');
        $user = $this->db->get_where('user', ['id_user' => $id])->row_array();
        $pass = $this->input->post('password_lama');

        if ( password_verify($pass, $user['password']) ){
            json_encode([
                'success' => true,
                'password' => $pass
            ]);
        } else {
            json_encode([
                'password' => 'salah gan'
            ]);
        }
    }
}
