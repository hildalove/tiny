<?php

namespace Tiny\Model;

use Tiny\Service\Factory;

class Model
{
    public $db;
    public function __construct()
    {
        $this->db = Factory::getDatabase();
    }

}