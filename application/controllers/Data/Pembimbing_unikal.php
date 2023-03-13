<?php

class Pembimbing_unikal extends CI_Controller
{
    var $title = "Pembimbing Unikal";

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect();
        }
        $this->load->model('pembimbingSekolah_model', 'mps');
        $this->load->model('pembimbingUnikal_model', 'mpu');
    }

    private function _index($data, $body)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pembimbing_unikal/' . $body, $data);
        $this->load->view('templates/footer', $data);
        $this->load->view('pembimbing_unikal/script', $data);
    }

    public function index()
    {
        $data = [
            "title"     => $this->title,
            "punikal"   => $this->mpu->getAll()
        ];

        $this->_index($data, 'index');
    }

    public function getData()
    {
        $results = $this->mpu->getDataTable();
        $no = $_POST['start'];
        $data = [];

        foreach ($results as $r) {
            $alamat = '<span class="d-inline-block text-truncate" style="max-width: 170px;">' . $r['alamat'] . '</span>';
            $email = '<span class="d-inline-block text-truncate" style="max-width: 150px;">' . $r['email'] . '</span>';
            $aksi = '<div class="div d-flex">
                            <a href="' . base_url("data/pembimbing_unikal/ubahdata/" . $r["id_pembimbing_unikal"]) . '" class="btn btn-outline-primary btn-sm"><i class="far fa-edit"></i></a>
                            <a href="' . base_url("data/pembimbing_unikal/hapusdata/") . '" data-id="' . $r["id_pembimbing_unikal"] . '" class="btn btn-outline-danger btn-sm ml-1 btn-delete"><i class="far fa-trash-alt"></i></a>
                    </div>';

            $row = [++$no, $r['nama_pembimbing'], $alamat, $r['no_telp'], $email, $aksi];
            $data[] = $row;
        }

        $output = [
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->mpu->count_all_data(),
            "recordsFiltered"   => $this->mpu->count_filtered_data(),
            "data"              => $data
        ];

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function TambahData()
    {
        // $data = [
        //     "title" => $this->title,
        //     "label" => "Tambah Data Pembimbing Unikal",
        // ];

        $date = date('Y-m-d H:i:s');

        $input = [
            "nama_pembimbing"   => $this->input->post('nama'),
            "alamat"            => $this->input->post('alamat'),
            "no_telp"           => $this->input->post('telp'),
            "email"             => $this->input->post('email'),
            "created_at"        => $date
        ];

        $this->mpu->insert($input);

        echo json_encode([
            "success" => true,
            "message" => "data Pembimbing Unikal berhasil ditambahkan",
        ]);

        // $this->_formRules();

        // if ($this->form_validation->run() == false) {
        //     $this->_index($data, 'tambah_data');
        // } else {
        //     $this->mpu->insert($input);
        //     $this->session->set_flashdata('main', 'data Pembimbing Unikal berhasil ditambahkan!');
        //     redirect('data/pembimbing_unikal');
        // }
    }

    public function ubahData($id)
    {
        $data = [
            "title"         => $this->title,
            "label"         => "Ubah Data Pembimbing Unikal",
            "pembimbing"    => $this->mpu->get_where($id)
        ];

        $input = [
            "nama_pembimbing"   => $this->input->post('nama'),
            "alamat"            => $this->input->post('alamat'),
            "no_telp"           => $this->input->post('telp'),
            "email"             => $this->input->post('email'),
        ];

        $this->_formRules();

        if ($this->form_validation->run() == true) {
            $this->mpu->update($input, $id);
            $this->session->set_flashdata('main', 'data Pembimbing Unikal berhasil diubah');
            redirect('data/pembimbing_unikal');
        } else {
            $this->_index($data, 'ubah_data');
        }
    }

    public function hapusData()
    {
        $id = $this->input->post('id');
        $siswa = $this->db->get_where('siswa', ['id_pembimbing_unikal' => $id])->row_array();

        if (!empty($siswa)) {
            echo json_encode([
                "status" => "error",
                "message" => "Data pembimbing tersebut sedang digunakan sebagai parent dari tabel Siswa"
            ]);
        } else {
            $this->mpu->delete($id);

            echo json_encode([
                "status" => "success",
                "message"   => "data Pembimbing Unikal berhasil dihapus",
            ]);
        }
    }

    private function _formRules()
    {
        $message = [
            "required"      => "Kolom {field} harus diisi",
            "numeric"       => "Kolom {field} hanya dapat berisi angka",
            "valid_email"   => "Masukkan alamat {field} yang valid"
        ];

        $this->form_validation->set_rules('nama',   'Nama',         'trim|required',            $message);
        $this->form_validation->set_rules('telp',   'No Telephone', 'trim|required|numeric',    $message);
        $this->form_validation->set_rules('email',  'E-Mail',       'trim|required|valid_email', $message);
        $this->form_validation->set_rules('alamat', 'Alamat',       'trim|required',            $message);
    }
}
