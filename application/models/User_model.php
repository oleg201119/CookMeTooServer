<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model
{
    public function login($username, $password)
    {
        $condition = [
            'username' => $username,
            'password' => $password,
        ];

        $user = $this->db
            ->get_where('users', $condition)
            ->row();
        return $user;
    }

    public function all($id)
    {
        return $this->db
            ->get_where('users', [])
            ->result();
    }

    public function get($id) {
        return $this->db
            ->get_where('users', ['id' => $id])
            ->row();
    }
}
