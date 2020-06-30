<?php 

class Model_Merk extends CI_Model{

    public function getMerk(){

        $result = $this->db->query("SELECT * FROM tbl_merk")->result_array();

        return $result;
    }

    public function createMerk($data){
        $this->db->insert('tbl_merk', $data);

        return $this->db->affected_rows();
    }

    public function deleteMerk($id){

        $result = $this->db->query("DELETE FROM tbl_merk WHERE tbl_merk.id='$id'");

        return $this->db->affected_rows();
    }
}