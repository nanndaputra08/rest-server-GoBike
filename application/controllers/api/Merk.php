<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

require APPPATH . 'libraries/Format.php';

class Merk extends REST_Controller{

    public function __construct(){

        parent::__construct();

        $this->load->model('Model_Merk');
    }

    public function index_get(){

        $merk = $this->Model_Merk->getMerk();

        if ($merk){

            $this->response([
                'status' => true,
                'data' => $merk
            ], REST_Controller::HTTP_OK);
        }
    }

    public function index_post(){

        $nama_merk = $this->post('nama_merk');

        $data = [
            'nama_merk' => $nama_merk
        ];

        $result = $this->Model_Merk->createMerk($data);

        if ($result > 0){

            $this->response([
                'status' => true,
                'message' => 'Berhasil menambahkan data Merk.'
            ], REST_Controller::HTTP_CREATED);
        }
    }

    public function index_delete(){

        $id = $this->delete('id');

        if ($id === null){

            $this->response([
                'status' => false,
                'message' => 'Id tidak boleh kosong'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $result = $this->Model_Merk->deleteMerk($id);

            if ($result > 0){

                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data Merk berhasil dihapus'
                ], REST_Controller::HTTP_OK);
            } else {

                $this->response([
                    'status' => false,
                    'id' => $id,
                    'message' => 'Id tidak ditemukan.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    
}