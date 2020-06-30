<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';

require APPPATH . 'libraries/Format.php';

class Customer extends REST_Controller{

    public function __construct(){
        
        parent::__construct();
        
        //Load Model
        $this->load->model('Model_Customer');
    }

    // Request Method GET
    public function index_get(){

        // Untuk mengecek pada method GET apakah ada parameter yang dikirimkan
        $id = $this->get('id');
        
        if ( $id === null){
            $customer = $this->Model_Customer->getCustomer();
            
        } else {
            $customer = $this->Model_Customer->getCustomer($id);
        }

        if ($customer){

            // Menggunakan method 'response' agar data yang dikembalikan adalah JSON 
            
            // Response data berhasil didapatkan
            $this->response([
                'status' => true,
                'data'   => $customer,
            ], REST_Controller::HTTP_OK);

        } else {

            //Response data tidak ditemukan berdasarkan Nilai yang dikirim pada paramater '$id'
            $this->response([
                'status' => false,
                'message' => 'Id tidak ditemukan.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // Request Method DELETE
    public function index_delete(){

        $id = $this->delete('id');

        if ($id === null){

            // Response apabila tidak ada nilai yang dikirimkan pada parameter '$id'
            $this->response([
                'status' => false,
                'message' => 'Id tidak boleh kosong.',
            ], REST_Controller::HTTP_BAD_REQUEST);

        } else {

            // Menyimpan nilai dari return data oleh function 'deleteCustomer'
            $result = $this->Model_Customer->deleteCustomer($id);

            if ( $result > 0) {

                 
                /**
                 * Response apabila nilai pada parameter '$id' lebih besar dari angka 0 
                 * dan nilai pada parameter '$id' terdapat pada tabel 'tbl_customer'
                 */
                
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data Customer berhasil dihapus.'
                ], REST_Controller::HTTP_OK);

            } else {

                //Respon, apabila nilai pada parameter '$id' tidak ditemukan pada data Customer
                $this->response([
                    'status' => false,
                    'id' => $id,
                    'message' => 'Id tidak ditemukan.'
                ], REST_Controller::HTTP_NOT_FOUND);

            }
        }
    }

    // Request Method POST
    public function index_post(){

        /**
         * 
         * Menyimpan nilai nama,email,username,password 
         * pada variabel
         * $nama, $email, $username, $password
         */
        $nama = $this->post('nama');
        $email = $this->post('email');
        $username = $this->post('username');
        $password = $this->post('password');

        /**
         * 
         * Menyimpan semua nilai pada variabel $data
         * untuk dikirimkan ke function 'createCustomer' pada 'Model_Customer'
         */
        $data = [
            'nama' => $nama,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'point' => 5
        ];

        // Menyimpan return data dari function 'createCustomer'
        $result = $this->Model_Customer->createCustomer($data);

        if ($result > 0){

            // Respon berhasil menambahkan data Customer baru
            $this->response([
                'status' => true,
                'message' => 'Berhasil menambahkan data Customer.'

            ], REST_Controller::HTTP_CREATED);
        } 
    }

    public function index_put(){

        $id = $this->put('id');

        $nama = $this->put('nama');
        $email = $this->put('email');
        $username = $this->put('username');
        $password = $this->put('password');
        $point = $this->put('point');

        /**
         * 
         * Menyimpan semua nilai pada variabel $data
         * untuk dikirimkan ke function 'updateCustomer' pada 'Model_Customer'
         */
        $data = [
            'nama' => $nama,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'point' => $point
        ];

        // Menyimpan return data dari function 'editCustomer'
        $result = $this->Model_Customer->updateCustomer($data, $id);

        if ($result > 0){

            // Respon berhasil merubah data Customer, berdasarkan nilai pada parameter '$id'
            $this->response([
                'status' => true,
                'message' => 'Berhasil merubah data Customer.'

            ], REST_Controller::HTTP_OK);
        } else {

            // Respon gagal menambahkan data Customer baru
            $this->response([
                'status' => false,
                'message' => 'Gagal merubah data Customer.',
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }


}