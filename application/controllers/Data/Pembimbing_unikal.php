<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembimbing_unikal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect();
        }

        // load model
        $this->load->model('pembimbingUnikal_model', 'mpu');
    }
        
    public function index()
    {
        $data = [
            "title"     => "Pembimbing Unikal",
            "punikal"   => $this->mpu->getAll()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pembimbing_unikal/index', $data);
        $this->load->view('templates/footer', $data);
        $this->load->view('pembimbing_unikal/script', $data);
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
                            <a id="tombol-ubah" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-pembimbing-unikal" data-id="' . $r["id_pembimbing_unikal"] . '"><i class="far fa-edit"></i></a>
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

    public function tambahData()
    {
        $input = [
            "nama_pembimbing"   => $this->input->post('nama'),
            "alamat"            => $this->input->post('alamat'),
            "no_telp"           => $this->input->post('telp'),
            "email"             => $this->input->post('email'),
            "created_at"        => date('Y-m-d H:i:s')
        ];

        $this->mpu->insert($input);

        echo json_encode([
            "success" => true,
            "message" => "data Pembimbing Unikal berhasil ditambahkan",
        ]);
    }

    public function ubahData()
    {
        $id = $this->input->post('id');
        
        $input = [
            "nama_pembimbing"   => $this->input->post('nama'),
            "alamat"            => $this->input->post('alamat'),
            "no_telp"           => $this->input->post('telp'),
            "email"             => $this->input->post('email')
        ];

        $this->mpu->update($input, $id);

        echo json_encode([
            "success" => true,
            "message" => "data Pembimbing Unikal berhasil diubah"
        ]);
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

    // passing data ke javascript
    public function editDataPemuk_json()
    {
        $id = $this->input->post('id');
        echo json_encode($this->mpu->get_where($id));
    }
}