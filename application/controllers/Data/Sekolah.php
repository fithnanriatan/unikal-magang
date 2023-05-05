<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('nama')) {
            redirect();
        }

        // load model
        $this->load->model('Sekolah_model', 'ms');
    }

    public function index()
    {
        $data = [
            "title" => "Data Sekolah",
            "sekolah" => $this->ms->getAll()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('sekolah/index', $data);
        $this->load->view('templates/footer', $data);
        $this->load->view('sekolah/script', $data);
    }

    public function getData()
    {
        $results = $this->ms->getDataTable();
        $no = $_POST['start'];
        $data = [];

        foreach ($results as $r) {
            $nama = '<span class="text-truncate">' . $r['nama_sekolah'] . '</span>';
            $kota = '<span class="text-truncate">' . $r['kota'] . '</span>';
            $aksi = '<div class="div d-flex">
                        <a class="btn btn-outline-primary btn-sm tombolUbahSekolah" data-toggle="modal" data-target="#modal-sekolah" data-id="' . $r['id_sekolah'] . '"><i class="far fa-edit"></i></a>
                        <a href="' . base_url("data/sekolah/hapusData") . '" class="btn btn-outline-danger btn-sm ml-1 btn-delete" data-id="' . $r["id_sekolah"] . '"><i class="far fa-trash-alt"></i></a>
                    </div>';
            $row = [++$no, $nama, $kota, $r['alamat'], $aksi];
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ms->count_all_data(),
            "recordsFiltered" => $this->ms->count_filtered_data(),
            "data" => $data
        ];

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function tambahData()
    {
        $input = [
            "nama_sekolah"  => $this->input->post('nama'),
            "kota"          => $this->input->post('kota'),
            "alamat"        => $this->input->post('alamat'),
            "created_at"    => date("Y-m-d H:i:s")
        ];

        $this->ms->insert($input);

        echo json_encode([
            "success" => true,
            "message" => "data sekolah berhasil ditambahkan"
        ]);
    }

    public function ubahData()
    {
        $id = $this->input->post('id');

        $input = [
            "nama_sekolah"  => $this->input->post('nama'),
            "kota"          => $this->input->post('kota'),
            "alamat"        => $this->input->post('alamat')
        ];

        $this->ms->update($input, $id);

        echo json_encode([
            "success" => true,
            "message" => "data sekolah berhasil diubah"
        ]);
    }

    public function hapusData()
    {
        $id = $this->input->post('id');

        $pembimbing = $this->ms->get_pembimbing($id);
        $siswa      = $this->ms->get_siswa($id);

        if (!empty($pembimbing) && !empty($siswa)) {

            echo json_encode([
                "status" => "error",
                "message" => "Data sekolah tersebut sedang digunakan sebagai parent dari data Pembimbing Sekolah atau Siswa",
            ]);
        } else {

            $this->ms->delete($id);

            echo json_encode([
                "status" => "success",
                "message" => "data sekolah berhasil dihapus",
            ]);
        }
    }

    // Passing data ke JavaScript
    public function editDataSekolah_json()
    {
        $id = $this->input->post('id');
        echo json_encode($this->ms->get_where($id));
    }
}
