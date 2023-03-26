<?php

class Pembimbing_sekolah extends CI_Controller
{
    var $title = "Pembimbing Sekolah";

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect();
        }
        $this->load->model('PembimbingSekolah_model', 'mps');
    }

    private function _index($data, $body)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pembimbing_sekolah/' . $body, $data);
        $this->load->view('templates/footer', $data);
        $this->load->view('pembimbing_sekolah/script', $data);
    }

    public function index()
    {
        $data = [
            'title'     => $this->title,
            'psekolah'  => $this->mps->getAll()
        ];

        $this->_index($data, 'index');
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
                        <a href="' . base_url("data/pembimbing_sekolah/ubahdata/" . $r["id_pembimbing_sekolah"]) . '" class="btn btn-outline-primary btn-sm"><i class="far fa-edit"></i></a>
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

    public function TambahData()
    {
        $data = [
            "title"     => $this->title,
            "label"     => "Tambah Data Pembimbing Sekolah",
            "sekolah"   => $this->db->get('sekolah')->result_array()
        ];


        $input = [
            'id_sekolah'        => htmlspecialchars($this->input->post('asalsekolah')),
            'nama_pembimbing'   => htmlspecialchars($this->input->post('nama')),
            'alamat'            => htmlspecialchars($this->input->post('alamat')),
            'no_telp'           => htmlspecialchars($this->input->post('telp')),
            'email'             => htmlspecialchars($this->input->post('email')),
            'created_at'        => date('Y-m-d H:i:s')
        ];

        $this->_formRules();

        if ($this->form_validation->run() == false) {
            $this->_index($data, 'tambah_data');
        } else {
            $this->mps->insert($input);
            $this->session->set_flashdata('main', 'data Pembimbing Sekolah berhasil ditambahkan!');
            redirect('data/pembimbing_sekolah');
        }
    }

    public function UbahData($id)
    {
        $data = [
            'title'         => $this->title,
            'label'         => 'Ubah Data Pembimbing Sekolah',
            'sekolah'       => $this->db->get('sekolah')->result_array(),
            'pembimbing'    => $this->mps->get_where($id)
        ];

        $data['value'] = [
            'nama'       => !empty(set_value('nama')) ? set_value('nama') : $data['pembimbing']['nama_pembimbing'],
            'telp'       => !empty(set_value('telp')) ? set_value('telp') : $data['pembimbing']['no_telp'],
            'email'      => !empty(set_value('email')) ? set_value('email') : $data['pembimbing']['email'],
            'alamat'     => !empty(set_value('alamat')) ? set_value('alamat') : $data['pembimbing']['alamat'],
            'sekolah'    => !empty(set_value('asalsekolah')) ? set_value('asalsekolah') : $data['pembimbing']['id_sekolah'],
        ];

        $input = [
            'nama_pembimbing'   => htmlspecialchars($this->input->post('nama')),
            'alamat'            => htmlspecialchars($this->input->post('alamat')),
            'no_telp'           => htmlspecialchars($this->input->post('telp')),
            'email'             => htmlspecialchars($this->input->post('email')),
            'id_sekolah'        => htmlspecialchars($this->input->post('asalsekolah')),
        ];

        $this->_formRules();

        if ($this->form_validation->run() == true) {
            $this->mps->update($input, $id);
            $this->session->set_flashdata('main', 'data Pembimbing Sekolah berhasil diubah!');
            redirect('data/pembimbing_sekolah');
        } else {
            $this->_index($data, 'ubah_data');
        }
    }

    public function hapusData()
    {
        $id = $this->input->post('id');
        $siswa = $this->db->get_where('siswa', ['id_pembimbing_sekolah' => $id])->row_array();

        if (!empty($siswa)) {
            echo json_encode([
                "status" => "error",
                "message" => "Data pembimbing tersebut sedang digunakan ".$siswa['nama_siswa']." sepagai parent dari table siswa!"
            ]);
        } else {
            $this->mps->delete($id);

            echo json_encode([
                "status" => "success",
                "message"   => "Data Pembimbing Sekolah berhasil dihapus",
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
        $this->form_validation->set_rules('email',  'E-Mail',       'trim|valid_email', $message);
        $this->form_validation->set_rules('alamat', 'Alamat',       'trim',            $message);
        $this->form_validation->set_rules('asalsekolah', 'Asal Sekolah', 'trim|required', [
            "required" => "Pilih {field} terlebih dahulu"
        ]);
    }
}
