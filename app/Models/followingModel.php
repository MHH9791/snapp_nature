<?php

namespace App\Models;
use CodeIgniter\Model;


class followingModel extends Model{

    protected $table      = 'follow';
    protected $primaryKey = 'user_id';

    protected $allowedFields = ['target_id'];

}
