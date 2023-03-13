<?php

class PembimbingUnikal_model extends CI_Model{

    //*--- Start of Table Serverside ---*//
    var $table = "pembimbing_unikal";
    var $order = ['id_pembimbing_unikal', 'nama_pembimbing', 'alamat', 'no_telp', 'email'];

    private function _get_data_query()
    {
        $this->db->from($this->table);

        if (isset($_POST['search']['value'])) {
            $this->db->like($this->order[1], $_POST['search']['value']);
            $this->db->or_like($this->order[2], $_POST['search']['value']);
            $this->db->or_like($this->order[3], $_POST['search']['value']);
            $this->db->or_like($this->order[4], $_POST['search']['value']);
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by($this->order[0], 'ASC');
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


    public function getAll()
    {
        $data = $this->db->get('pembimbing_unikal')->result_array(); 
        return $data;
    }

    public function get_where($id)
    {
        $query = $this->db->get_where('pembimbing_unikal', ['id_pembimbing_unikal' => $id])->row_array();
        return $query;
    }

    public function insert($input)
    {
        $this->db->insert('pembimbing_unikal', $input);
    }

    public function update($input, $id)
    {
        $this->db->update('pembimbing_unikal', $input, ['id_pembimbing_unikal' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete('pembimbing_unikal', ['id_pembimbing_unikal' => $id]);
    }
}