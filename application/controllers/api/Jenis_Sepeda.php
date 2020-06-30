<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . 'libraries/REST_Controller.php';

require APPPATH . 'libraries/Format.php';

class Jenis_Sepeda extends REST_Controller{

    public function __construct(){

        parent::__construct();
        
        $this->load->model('Model_Jenis_Sepeda');
    }

    public function index_get(){

        $jenis_sepeda = $this->Model_Jenis_Sepeda->getJenisSepeda();

        if ($jenis_sepeda){

            $this->response([
                'status' => true,
                'data' => $jenis_sepeda
            ], REST_Controller::HTTP_OK);
        }
    }

    public function index_post(){

        $nama_jenis_sepeda = $this->post('nama_jenis_sepeda');

        $data = [
            'nama_jenis_sepeda' => $nama_jenis_sepeda
        ];

        $result = $this->Model_Jenis_Sepeda->createJenisSepeda($data);
    
        if ($result > 0){

            $this->response([
                'status' => true,
                'message' => 'Berhasil menambahkan data Jenis Sepeda',
            ], REST_Controller::HTTP_CREATED);
        }
    }

    public function index_delete(){

        $id = $this->delete('id');

        if ($id === null){

            $this->response([
                'status' => false,
                'message' => 'Id tidak boleh kosong.'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {

            $result = $this->Model_Jenis_Sepeda->deleteJenisSepeda($id);

            if ($result > 0){

                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Data Jenis Sepeda berhasil dihapus.'
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