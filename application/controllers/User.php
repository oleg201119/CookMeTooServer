<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index_get($id = null)
    {
        $headers = $this->input->request_headers();

        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken(Authorization::tokenInHeader($headers));

            if ($token != false) {
                $todo = ($id != null)
                    ? $this->user_model->get($id)
                    : $this->user_model->all($token->id);
                $this->set_response($todo, REST_Controller::HTTP_OK);
                return;
            }
        }
        $response = [
            'status' => REST_Controller::HTTP_FORBIDDEN,
            'message' => 'Forbidden',
        ];
        $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
    }


}
