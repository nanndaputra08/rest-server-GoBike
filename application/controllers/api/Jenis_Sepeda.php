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
}