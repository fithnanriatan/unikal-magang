<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembimbing_sekolah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect();
        }

        // load model
        $this->load->model('PembimbingSekolah_model', 'mps');
    }

    public function index()
    {
        $data = [
            'title'     => "Pembimbing Sekolah",
            'sekolah'   => $this->db->get('sekolah')->result_array(),
            'psekolah'  => $this->mps->getAll()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pembimbing_sekolah/index', $data);
        $this->load->view('templates/footer', $data);
        $this->load->view('pembimbing_sekolah/script', $data);
    }

    public function getData()
    {
        $results = $this->mps->getDataTable();
        $no = $_POST['start'];
        $data = [];

        foreach ($results as $r) {
            $alamat = '<span class="d-inline-block text-truncate" style="max-width: 170px;">' . $r['alamat'] . '</span>';
            $asal = '<span class="d-inline-block text-truncate" style="max-width: 240px;">' . $r['nama_sekolah'] . '</span>';
            $email = '<span class="d-inline-block text-truncate" style="max-width: 150px;">' . $r['email'] . '</span>';
            $aksi = '<div class="div d-flex">
                        <button id="tombol-ubah" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-pembimbing-sekolah" data-id="' . $r["id_pembimbing_sekolah"] . '"><i class="far fa-edit"></i></button>
                        <a href="' . base_url("data/pembimbing_sekolah/hapusdata/") . '" data-id="' . $r["id_pembimbing_sekolah"] . '" class="btn btn-outline-danger btn-sm ml-1 btn-delete"><i class="far fa-trash-alt"></i></a>
                    </div>';

            $row = [++$no, $r['nama_pembimbing'], $alamat, $asal, $r['no_telp'], $email, $aksi];
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mps->count_all_data(),
            "recordsFiltered" => $this->mps->count_filtered_data(),
            "data" => $data
        ];

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function tambahData()
    {
        $input = [
            'id_sekolah'        => htmlspecialchars($this->input->post('asalsekolah')),
            'nama_pembimbing'   => htmlspecialchars($this->input->post('nama')),
            'alamat'            => htmlspecialchars($this->input->post('alamat')),
            'no_telp'           => htmlspecialchars($this->input->post('telp')),
            'email'             => htmlspecialchars($this->input->post('email')),
            'created_at'        => date('Y-m-d H:i:s')
        ];

        $this->mps->insert($input);

        echo json_encode([
            "success" => true,
            "message" => 'data Pembimbing Sekolah berhasil ditambahkan'
        ]);
    }

    public function UbahData()
    {
        $id = $this->input->post('id');
        
        $input = [
            'nama_pembimbing'   => htmlspecialchars($this->input->post('nama')),
            'alamat'            => htmlspecialchars($this->input->post('alamat')),
            'no_telp'           => htmlspecialchars($this->input->post('telp')),
            'email'             => htmlspecialchars($this->input->post('email')),
            'id_sekolah'        => htmlspecialchars($this->input->post('asalsekolah')),
        ];

        $this->mps->update($input, $id);

        echo json_encode([
            "success" => true,
            "message" => 'data Pembimbing Sekolah berhasil diubah'
        ]);
    }

    public function hapusData()
    {
        $id = $this->input->post('id');
        $siswa = $this->db->get_where('siswa', ['id_pembimbing_sekolah' => $id])->row_array();

        if (!empty($siswa)) {
            echo json_encode([
                "status" => "error",
                "message" => "Data pembimbing tersebut sedang digunakan " . $siswa['nama_siswa'] . " sepagai parent dari table siswa!"
            ]);
        } else {
            $this->mps->delete($id);

            echo json_encode([
                "status" => "success",
                "message"   => "Data Pembimbing Sekolah berhasil dihapus",
            ]);
        }
    }

    // passing data ke javascript
    public function dataPembimbing_json()
    {
        $id = $this->input->post('id');
        echo json_encode($this->mps->get_where($id));
    }
}
