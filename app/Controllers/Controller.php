<?php

namespace NeosoftApi\Controllers;

use NeosoftApi\Models\UserModel;

abstract class  Controller
{

    /**
     * Get json request
     * @var array
     */
    protected array $postParams;

    public function __construct()
    {
        $this->postParams = json_decode(file_get_contents('php://input'), true) ?? [];
    }


    /**
     * Send response from controller
     * @param  array  $data
     * @param  int  $code
     * @return void
     */
    public function response(array|string $data, int $code = 200): void
    {
        http_response_code($code);
        if (is_array($data)) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } else {
            echo $data;
        }
    }


    public function checkAuthToken($userModel): bool
    {
        $authorization_header = getallheaders()['Authorization'] ?? null;
        if ($authorization_header) {
            $bearer_token = str_replace('Bearer ', '', $authorization_header);
            if ($userModel->getUserByToken($bearer_token)) {
                return true;
            }
            return false;
        }
        return false;


    }

}
