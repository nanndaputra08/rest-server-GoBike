<?php 


class Model_Jenis_Sepeda extends CI_Model{

    public function getJenisSepeda(){

        $result = $this->db->query("SELECT * FROM tbl_jenis_speda")->result_array();

        return $result;
    }
}