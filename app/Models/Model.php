<?php

namespace NeosoftApi\Models;

use NeosoftApi\Database\Database;

abstract class Model
{

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

}