<?php

class Siswa_model extends CI_Model
{

    //*--- Start of Table Serverside ---*//
    var $table = "siswa ss";
    var $order = ['ss.id_siswa', 'ss.nama_siswa', 's.nama_sekolah', 'pu.nama_pembimbing', 'ss.no_telp', 'ss.email'];

    private function _get_data_query()
    {
        $bln_awal   = $this->input->post('bln_awal');
        $bln_akhir  = $this->input->post('bln_akhir');
        $angkatan   = $this->input->post('angkatan');
        $sekolah    = $this->input->post('sekolah');
        $pembimbing = $this->input->post('pembimbing');
        $status     = $this->input->post('status');

        $this->db->select('ss.* , s.nama_sekolah, pu.nama_pembimbing');
        $this->db->from($this->table);
        $this->db->join('sekolah s', 'ss.id_sekolah = s.id_sekolah');
        $this->db->join('pembimbing_unikal pu', 'ss.id_pembimbing_unikal = pu.id_pembimbing_unikal');
        if (!empty($bln_awal) && empty($bln_akhir)) {
            $this->db->where('tgl_masuk >=', $bln_awal . '-00');
            $this->db->or_where('tgl_keluar >=', $bln_awal . '-00');
        }
        if (!empty($bln_akhir) && empty($bln_awal)) {
            $this->db->where('tgl_masuk <=', $bln_akhir . '-32');
            $this->db->or_where('tgl_keluar <=', $bln_akhir . '-32');
        }
        if (!empty($bln_akhir) && !empty($bln_awal)) {
            $this->db->where('tgl_masuk >=', $bln_awal . '-00');
            $this->db->where('tgl_masuk <=', $bln_akhir . '-32');

            $this->db->or_where('tgl_keluar >=', $bln_awal . '-00');
            $this->db->where('tgl_keluar <=', $bln_akhir . '-32');

            $this->db->or_where('tgl_masuk <=', $bln_awal . '-00');
            $this->db->where('tgl_keluar >=', $bln_akhir . '-32');
        }
        if (!empty($angkatan)) {
            $this->db->where('tgl_masuk >=', $angkatan.'-06-00');
            $this->db->where('tgl_masuk <=', 1+$angkatan.'-06-00');
        }
        if (!empty($sekolah)) {
            $this->db->where('ss.id_sekolah', $sekolah);
        }
        if (!empty($pembimbing)) {
            $this->db->where('pu.id_pembimbing_unikal', $pembimbing);
        }
        if (!empty($status)) {
            if ($status == 1) {
                $this->db->where('tgl_masuk >=', date('Y-m-d'));
            } elseif ($status == 3) {
                $this->db->where('tgl_keluar <=', date('Y-m-d'));
            } else {
                $this->db->where('tgl_masuk <=', date('Y-m-d'));
                $this->db->where('tgl_keluar >=', date('Y-m-d'));
            }
        }

        if (isset($_POST['search']['value'])) {
            $this->db->like($this->order[1], $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by($this->order[0], 'DESC');
        }
    }

    public function getDataTable()
    {
        $this->_get_data_query();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered_data()
    {
        $this->_get_data_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    //*--- End of Table Serverside ---*//

    public function getAllSiswa()
    {
        $this->db->select('ss.* , s.nama_sekolah, ps.nama_pembimbing nama_pemsek, pu.nama_pembimbing nama_pemuk');
        $this->db->join('sekolah s', 'ss.id_sekolah = s.id_sekolah');
        $this->db->join('pembimbing_sekolah ps', 'ss.id_pembimbing_sekolah = ps.id_pembimbing_sekolah');
        $this->db->join('pembimbing_unikal pu', 'ss.id_pembimbing_unikal = pu.id_pembimbing_unikal');
        return $this->db->get('siswa ss')->result_array();
    }

    public function getSiswaById($id)
    {
        $this->db->select('ss.* , s.nama_sekolah, ps.nama_pembimbing nama_pemsek, pu.nama_pembimbing nama_pemuk');
        $this->db->join('sekolah s', 'ss.id_sekolah = s.id_sekolah');
        $this->db->join('pembimbing_sekolah ps', 'ss.id_pembimbing_sekolah = ps.id_pembimbing_sekolah');
        $this->db->join('pembimbing_unikal pu', 'ss.id_pembimbing_unikal = pu.id_pembimbing_unikal');
        $this->db->where(['id_siswa' => $id]);
        return $this->db->get('siswa ss')->row_array();
    }

    public function getSiswaPending()
    {
        $this->db->select('ss.* , s.nama_sekolah');
        $this->db->join('sekolah s', 'ss.id_sekolah = s.id_sekolah');
        $this->db->where('tgl_masuk >=', date('Y-m-d'));
        return $this->db->get('siswa ss')->num_rows();
    }

    public function getSiswaActive()
    {
        $this->db->select('ss.* , s.nama_sekolah');
        $this->db->join('sekolah s', 'ss.id_sekolah = s.id_sekolah');
        $this->db->where('tgl_masuk <=', date('Y-m-d'));
        $this->db->where('tgl_keluar >=', date('Y-m-d'));
        return $this->db->get('siswa ss');
    }

    public function getSiswaAlumni()
    {
        $this->db->select('ss.* , s.nama_sekolah');
        $this->db->join('sekolah s', 'ss.id_sekolah = s.id_sekolah');
        $this->db->where('tgl_keluar <=', date('Y-m-d'));
        return $this->db->get('siswa ss')->num_rows();
    }

    public function getSiswaByFilter()
    {
        $flt_bln_awal   = $this->input->post('bln_awal'); // 2023-03
        $flt_bln_akhir  = $this->input->post('bln_akhir'); // 2023-03
        $flt_sekolah    = $this->input->post('flt_sekolah'); // 64
        $flt_pembimbing = $this->input->post('flt_pembimbing'); // 7
        $flt_status     = $this->input->post('flt_status'); // 1 2 3

        $this->db->select('ss.* , s.nama_sekolah, ps.nama_pembimbing nama_pemsek, pu.nama_pembimbing nama_pemuk');
        $this->db->join('sekolah s', 'ss.id_sekolah = s.id_sekolah');
        $this->db->join('pembimbing_sekolah ps', 'ss.id_pembimbing_sekolah = ps.id_pembimbing_sekolah');
        $this->db->join('pembimbing_unikal pu', 'ss.id_pembimbing_unikal = pu.id_pembimbing_unikal');

        if (!empty($flt_sekolah)) {
            $this->db->where('ss.id_sekolah', $flt_sekolah);
        }
        if (!empty($flt_pembimbing)) {
            $this->db->where('pu.id_pembimbing_unikal', $flt_pembimbing);
        }
        if (!empty($flt_bln_awal)) {
            $this->db->where('tgl_masuk >=', $flt_bln_awal . '-00 OR tgl_keluar >=', $flt_bln_awal . '-00');
        }
        if (!empty($flt_bln_akhir)) {
            $this->db->where('tgl_masuk <=', $flt_bln_akhir . '-32 OR tgl_keluar <=', $flt_bln_akhir . '-32');
        }
        if ($flt_status == 1) {
            $this->db->where('tgl_masuk <=', date('Y-m-d'));
        }

        return $this->db->get('siswa ss')->result_array();
    }

    public function update($input, $id)
    {
        $this->db->update('siswa', $input, ['id_siswa' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete('siswa', ['id_siswa' => $id]);
    }
}
