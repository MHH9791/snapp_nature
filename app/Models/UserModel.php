<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class UserModel extends Model{
//    protected $db;
    protected $table = 'users';
    protected $primaryKey = 'iduser';
    protected $allowedFields = ['username', 'email', 'password','icon','bio'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

//    public function __construct()
//    {
//        $this->db = \Config\Database::connect();
//    }


    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data){
        if(isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }


}