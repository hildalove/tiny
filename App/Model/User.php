<?php

namespace App\Model;


use Tiny\Model\Model;

class User extends  Model
{
    public function getUserById($id)
    {
        $sql = "SELECT * FROM user
                WHERE id = ?";
        return $this->db->getRow($sql, $id);
    }
}