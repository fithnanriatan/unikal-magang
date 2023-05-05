<?php
class User_model extends CI_Model
{
    //*--- Start of Table Serverside ---*//
    var $table = "user";
    var $order = ['id_user', 'nama_lengkap', 'nama_user'];

    private function _get_data_query()
    {
        $this->db->from($this->table);

        if (isset($_POST['search']['value'])) {
            $this->db->like($this->order[1], $_POST['search']['value']);
            $this->db->or_like($this->order[2], $_POST['search']['value']);
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
    //*--- End of Table Serverside ---*//'

    public function get_where($id)
    {
        $this->db->where('id_user', $id);
        $query = $this->db->get('user');
        return $query->row_array();
    }

    public function insert($value)
    {
        $this->db->insert('user', $value);
    }

    public function update($id, $data)
    {
        $this->db->update('user', $data, ['id_user' => $id]);
    }

    public function delete($id)
    {
        $this->db->delete('user', ['id_user' => $id]);
    }
}
