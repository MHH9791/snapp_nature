<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class leaderboardModel{
    private $db;

    public function __construct()
    {
        $this->db=\Config\Database::connect();
    }

    public function getTopten()
    {
        $query_text="SELECT username from users";
        $query =$this->db->query($query_text);
        return $query->getResult();
    }


}