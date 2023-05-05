<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    var $title = "Data Siswa";

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect();
        }

        // load model
        $this->load->model('siswa_model', 'mss');
    }

    private function _index($data, $body)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/' . $body, $data);
        $this->load->view('templates/footer', $data);
        $this->load->view('siswa/script', $data);
    }

    public function index()
    {
        $data = [
            'title' => $this->title,
            'sekolah' => $this->db->get('sekolah')->result_array(),
            'pem_unikal' => $this->db->get('pembimbing_unikal')->result_array()
        ];

        $this->_index($data, 'index');
    }

    public function getData()
    {
        $results = $this->mss->getDataTable();
        $no = $_POST['start'];
        $data = [];

        foreach ($results as $r) {
            $asal = '<span class="d-inline-block text-truncate" style="max-width: 170px;">' . $r['nama_sekolah'] . '</span>';

            //---->||  Sintaks Masa Aktif  ||<----//
            $hari_ini  = new DateTime(date('Y-m-d'));
            $tgl_akhir = new DateTime($r['tgl_keluar']);

            $selisih = date_diff($hari_ini, $tgl_akhir);

            $sisa_bulan = $selisih->m;
            $sisa_hari = $selisih->d;

            if ($tgl_akhir >= $hari_ini && $r['tgl_masuk'] <= date('Y-m-d')) {
                $masa_aktif = $sisa_bulan . " bulan, " . $sisa_hari . " hari";
            } else {
                $masa_aktif = '&ensp;-';
            }

            //---->||  Sintaks Durasi  ||<----//
            $detik = strtotime($r['tgl_keluar']) - strtotime($r['tgl_masuk']);

            //-- hitung jumlah detik dalam satu hari, satu bulan, dan satu tahun
            $detikPerHari = 24 * 60 * 60;
            $detikPerBulan = 30 * $detikPerHari;
            $detikPerTahun = 365 * $detikPerHari;

            //-- hitung jumlah tahun, bulan, dan hari dalam detik
            $tahun = floor($detik / $detikPerTahun);
            $sisaDetik = $detik % $detikPerTahun;
            $bulan = floor($sisaDetik / $detikPerBulan);
            $sisaDetik = $sisaDetik % $detikPerBulan;
            $hari = floor($sisaDetik / $detikPerHari);

            if ($tahun == 0) {
                $durasi = $bulan . ' bulan, ' . $hari . ' hari.';
            } else {
                $durasi = $tahun . ' tahun, ' . $bulan . ' bulan, ' . $hari . ' hari.';
            }

            //---->||  Sintaks Status  ||<----//
            $masuk  = strtotime($r['tgl_masuk']);
            $keluar = strtotime($r['tgl_keluar']);
            $date   = strtotime(date('Y-m-d'));

            if ($date >= $masuk && $date <= $keluar) {
                $lable = "Active";
                $color = "success";
            } elseif ($date <= $masuk && $masuk <= $keluar) {
                $lable = "Pending";
                $color = "warning";
            } elseif ($date >= $keluar && $masuk <= $keluar) {
                $lable = "Alumni";
                $color = "primary";
            } else {
                $lable = "Undifine";
                $color = "dark";
            }

            $status = '<span class="badge badge-' . $color . '">' . $lable . '</span>';

            $tgl_masuk = date('d-m-Y', strtotime($r['tgl_masuk']));
            $tgl_keluar = date('d-m-Y', strtotime($r['tgl_keluar']));
            $aksi = '<div class="div d-flex">
                        <a href="' . base_url("data/siswa/detail/" . $r["id_siswa"]) . '" class="btn btn-outline-primary btn-sm"><i class="fas fa-info-circle mt-1"></i></a>
                        <a href="' . base_url("data/siswa/ubahdata/" . $r["id_siswa"]) . '" class="btn btn-outline-warning mx-1 btn-sm"><i class="far fa-edit"></i></a>
                        <a href="' . base_url("data/siswa/hapusdata/") . '" data-id="' . $r["id_siswa"] . '" class="btn btn-outline-danger btn-sm btn-hapus"><i class="far fa-trash-alt"></i></a>
                    </div>';

            $row = [++$no, $r['nama_siswa'], $asal, $r['nama_pembimbing'], $durasi, $masa_aktif, $status, $aksi];
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mss->count_all_data(),
            "recordsFiltered" => $this->mss->count_filtered_data(),
            "data" => $data
        ];

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function detail($id)
    {
        $data = [
            'title' => $this->title,
            'label' => 'Detail Siswa',
            'siswa' => $this->mss->getSiswaById($id),
        ];

        $masuk  = $data['siswa']['tgl_masuk'];
        $keluar = $data['siswa']['tgl_keluar'];
        $date   = date("Y-m-d");

        if ($date >= $masuk && $date <= $keluar) {
            $data['status'] = "Active";
            $data['color']  = "success";
        } elseif ($date <= $masuk) {
            $data['status'] = "Pending";
            $data['color']  = "warning";
        } elseif ($date >= $keluar) {
            $data['status'] = "Alumni";
            $data['color']  = "info";
        } else {
            $data['status'] = "Undifine";
            $data['color']  = "danger";
        }

        $this->_index($data, 'detail');
    }

    public function tambahData()
    {
        $data = [
            'title'         => $this->title,
            'label'         => 'Tambah Data Siswa',
            'sekolah'       => $this->db->get('sekolah')->result_array(),
            'pem_sekolah'   => $this->db->get('pembimbing_sekolah')->result_array(),
            'pem_unikal'    => $this->db->get('pembimbing_unikal')->result_array()
        ];

        $this->_index($data, 'tambah_data');
    }

    public function tambahdataAction()
    {
        $this->_formRules();

        if ($this->form_validation->run() == true) {

            $masuk = $this->input->post('tgl-masuk');
            $keluar = $this->input->post('tgl-keluar');

            if ($masuk <= $keluar) {

                $foto = $_FILES['foto'];

                if (!empty($foto)) {

                    $config['upload_path']      = '././assets/db_foto';
                    $config['allowed_types']    = 'jpg|jpeg|png';
                    $config['file_ext_tolower'] = true;
                    $config['encrypt_name']     = true;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('foto')) {

                        $input = [
                            'nama_siswa'            => htmlspecialchars($this->input->post('nama')),
                            'nisn'                  => htmlspecialchars($this->input->post('nisn')),
                            'tempat_lahir'          => htmlspecialchars($this->input->post('tempat')),
                            'tanggal_lahir'         => htmlspecialchars($this->input->post('tanggal')),
                            'alamat'                => htmlspecialchars($this->input->post('alamat')),
                            'no_telp'               => htmlspecialchars($this->input->post('telp')),
                            'email'                 => htmlspecialchars($this->input->post('email')),
                            'foto'                  => $this->upload->data('file_name'),
                            'tgl_masuk'             => htmlspecialchars($this->input->post('tgl-masuk')),
                            'tgl_keluar'            => htmlspecialchars($this->input->post('tgl-keluar')),
                            'id_sekolah'            => htmlspecialchars($this->input->post('asalsekolah')),
                            'id_pembimbing_sekolah' => htmlspecialchars($this->input->post('pem-sekolah')),
                            'id_pembimbing_unikal'  => htmlspecialchars($this->input->post('pem-unikal'))
                        ];

                        $this->db->insert('siswa', $input);
                        $this->session->set_flashdata('main', 'data Siswa berhasil ditambahkan!');
                        redirect('data/siswa');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('foto_validation', $error);
                        $this->tambahData();
                    }
                } else {
                    $this->session->set_flashdata('foto_validation', 'Massukan foto terlebih dahulu');
                    $this->tambahData();
                }
            } else {
                $this->session->set_flashdata('tgl_validation', 'Tanggal Keluar tidak boleh lebih kecil dari Tanggal Masuk');
                $this->tambahData();
            }
        } else {
            $this->tambahData();
        }
    }

    public function ajax_asalsekolah()
    {
        $asalsekolah = $this->input->post('id_sekolah');
        $pembimbing = $this->db->get_where('pembimbing_sekolah', ['id_sekolah' => $asalsekolah]);
        $jml = $pembimbing->num_rows();

        if ($jml > 0) {
            foreach ($pembimbing->result_array() as $ps) {
                echo "<option value='" . $ps['id_pembimbing_sekolah'] . "'>" . $ps['nama_pembimbing'] . "</option>";
            }
        } else {
            echo "<option value='' selected>[ pembimbing sekolah belum terdaftar ]</option>";
        }
    }

    public function ubahData($id)
    {
        $data = [
            'title'         => $this->title,
            'label'         => 'Ubah Data Siswa',
            'siswa'         => $this->mss->getSiswaById($id),
            'sekolah'       => $this->db->get('sekolah')->result_array(),
            'pem_sekolah'   => $this->db->get('pembimbing_sekolah')->result_array(),
            'pem_unikal'    => $this->db->get('pembimbing_unikal')->result_array(),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $this->_index($data, 'ubah_data');
    }

    public function ubahDataAction()
    {
        $this->_formRules();

        $id = $this->input->post('id_siswa');

        // Validasi Form
        if ($this->form_validation->run() == true) {

            $masuk = $this->input->post('tgl-masuk');
            $keluar = $this->input->post('tgl-keluar');

            // Jika Tanggal Keluar lebih awal dari tgl masuk
            if ($masuk <= $keluar) {

                $foto = $_FILES['foto']['name'];

                // Jika tidak terdapat foto
                if (!empty($foto)) {

                    $config['upload_path'] = '././assets/db_foto';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['file_ext_tolower'] = true;
                    $config['encrypt_name']     = true;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('foto')) {

                        $foto = $this->upload->data('file_name');
                        $this->db->set('foto', $foto);
                    } else {

                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('foto_validation', $error);
                        redirect('data/siswa/ubahdata/' . $id);
                    }
                }

                $input = [
                    'nama_siswa'            => htmlspecialchars($this->input->post('nama')),
                    'nisn'                  => htmlspecialchars($this->input->post('nisn')),
                    'tempat_lahir'          => htmlspecialchars($this->input->post('tempat')),
                    'tanggal_lahir'         => htmlspecialchars($this->input->post('tanggal')),
                    'alamat'                => htmlspecialchars($this->input->post('alamat')),
                    'no_telp'               => htmlspecialchars($this->input->post('telp')),
                    'email'                 => htmlspecialchars($this->input->post('email')),
                    'tgl_masuk'             => htmlspecialchars($this->input->post('tgl-masuk')),
                    'tgl_keluar'            => htmlspecialchars($this->input->post('tgl-keluar')),
                    'id_sekolah'            => htmlspecialchars($this->input->post('asalsekolah')),
                    'id_pembimbing_sekolah' => htmlspecialchars($this->input->post('pem-sekolah')),
                    'id_pembimbing_unikal'  => htmlspecialchars($this->input->post('pem-unikal'))
                ];

                $this->mss->update($input, $id);
                $this->session->set_flashdata('main', 'data Siswa berhasil diubah!');
                redirect('data/siswa');
            } else {
                $this->session->set_flashdata('tgl_validation', 'Tanggal Keluar tidak boleh lebih kecil dari Tanggal Masuk');
                $this->ubahData($id);
            }
        } else {
            $this->ubahData($id);
        }
    }

    public function hapusData()
    {
        $id = $this->input->post('id');
        $this->mss->delete($id);

        echo json_encode([
            "status" => "success",
            "message" => "data Siswa berhasil dihapus!"
        ]);
    }

    public function laporan_pdf()
    {
        $data = [
            "siswa" => $this->mss->getSiswaByFilter()
        ];

        $flt_bln_awal   = $this->input->post('bln_awal'); // 2023-03
        $flt_bln_akhir  = $this->input->post('bln_akhir'); // 2023-03
        $flt_sekolah    = $this->input->post('flt_sekolah'); // 64
        $flt_pembimbing = $this->input->post('flt_pembimbing'); // 7

        $bln_awal = 'dari ' . $flt_bln_awal;
        $bln_akhir = 'sampai ' . $flt_bln_akhir;

        $data['filter'] = [
            'bln_awal'   => $this->input->post('bln_awal'),
            'bln_akhir'  => $this->input->post('bln_akhir'),
            'sekolah'    => $this->input->post('flt_sekolah'),
            'pembimbing' => $this->input->post('flt_pembimbing')
        ];

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-anakmagang.pdf";
        $this->pdf->load_view('siswa/laporan_pdf', $data);
    }

    private function _formRules()
    {
        $msgKolom = [
            "required"      => "Kolom {field} harus diisi",
            "numeric"       => "Kolom {field} hanya dapat berisi angka",
            "valid_email"   => "Masukkan alamat {field} yang valid"
        ];

        $msgSelect = [
            "required"      => "Pilih {field} terlebih dahulu"
        ];

        $msgDate = [
            "required"      => "Massukkan {field} terlebih dahulu",
        ];

        $this->form_validation->set_rules('nama',   'Nama',         'trim|required',        $msgKolom);
        $this->form_validation->set_rules('nisn',   'NISN',         'trim|numeric',         $msgKolom);
        $this->form_validation->set_rules('telp',   'No Telephone', 'trim|required|numeric', $msgKolom);
        $this->form_validation->set_rules('email',  'E-Mail',       'trim|valid_email',     $msgKolom);
        $this->form_validation->set_rules('tempat', 'Tempat Lahir', 'trim|required',        $msgKolom);
        $this->form_validation->set_rules('alamat', 'Alamat',       'trim|required',        $msgKolom);

        $this->form_validation->set_rules('tanggal',    'Tanggal Lahir',    'trim|required', $msgDate);
        $this->form_validation->set_rules('tgl-masuk',  'Tanggal Masuk',    'trim|required', $msgDate);
        $this->form_validation->set_rules('tgl-keluar', 'Tanggal Keluar',   'trim|required', $msgDate);

        $this->form_validation->set_rules('asalsekolah',    'Asal Sekolah',         'trim|required', $msgSelect);
        $this->form_validation->set_rules('pem-sekolah',    'Pembimbing Sekolah',   'trim|required', $msgSelect);
        $this->form_validation->set_rules('pem-unikal',     'Pembimbing Unikal',    'trim|required', $msgSelect);
    }
}
