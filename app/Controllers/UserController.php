<?php

namespace NeosoftApi\Controllers;

use NeosoftApi\Models\UserModel;


class UserController extends Controller
{

    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();

    }

    /**
     * @return void
     */
    public function authUser()
    {
        $username = isset($this->postParams['username']) ? $this->postParams['username'] : null;
        $password = isset($this->postParams['password']) ? $this->postParams['password'] : null;

        if ($username && $password) {
            $token = $this->userModel->authUser($username, $password);
            if ($token) {
                $this->response(['token' => $token]);
            } else {
                $this->response("Invalid credentials", 422);
            }
        } else {
            $this->response("Missing login credentials", 422);
        }
    }


    /**
     * Get all users, protected by user token!
     * @return void
     */
    public function getUsers()
    {
        if ($this->checkAuthToken($this->userModel)) {
            $format = function (array $user): array {
                $user = $this->userModel::outputFormatter($user);
                return $user;
            };
            $this->response(["users" => array_map($format, $this->userModel->getAllUser())]);
        } else {
            $this->response('Missing or invalid Bearer token!', 401);
        }
    }
}
