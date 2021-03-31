<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class uploadModel extends Model{
//    protected $db;
    protected $table = 'upload';
    protected $allowedFields = ['user_id', 'common_name', 'scientific_name','picture','comment','time','location_city','coordinate','score','only_in_diary','wiki_url'];

}