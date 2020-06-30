<?php 

class Model_Customer extends CI_Model{

    public function getCustomer( $id = null){

        if ($id === null){

            // Return semua data Customer
            $result = $this->db->query("SELECT * FROM tbl_customer")->result_array();
            
            return $result;

        } else {

            // Return data Customer berdasarkan nilai pada parameter '$id'
            $result = $this->db->query("SELECT * FROM tbl_customer WHERE tbl_customer.id='$id'")->result_array();

            return $result;
        }
    }

    public function deleteCustomer($id){

        $result = $this->db->query("DELETE FROM tbl_customer WHERE tbl_customer.id='$id'");

        // $this->db->delete('tbl_customer',['id' => $id]);

        return $this->db->affected_rows();;
    }

    public function createCustomer($data){

        $this->db->insert('tbl_customer', $data);

        return $this->db->affected_rows();
    }


    public function updateCustomer($data,$id){
        $this->db->update('tbl_customer', $data, ['id' => $id]);

        return $this->db->affected_rows();
    }
}