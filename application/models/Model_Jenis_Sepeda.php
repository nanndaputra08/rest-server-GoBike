<?php 


class Model_Jenis_Sepeda extends CI_Model{

    public function getJenisSepeda(){

        $result = $this->db->query("SELECT * FROM tbl_jenis_sepeda")->result_array();

        return $result;
    }

    public function createJenisSepeda($data){

        $result = $this->db->insert('tbl_jenis_sepeda', $data);

        return $this->db->affected_rows();
    }

    public function deleteJenisSepeda($id){

        $result = $this->db->query("DELETE FROM tbl_jenis_sepeda WHERE tbl_jenis_sepeda.id='$id'");

        return $this->db->affected_rows();
    }
}