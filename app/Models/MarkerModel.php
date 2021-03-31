<?php

namespace App\Models;
use CodeIgniter\Model;


class MarkerModel extends Model{

    protected $table      = 'upload';
    protected $primaryKey = 'idupload';

    protected $allowedFields = ['user_id', 'common_name', 'picture', 'comment',
        'location_city', 'coordinate', 'time', 'scientific_name', 'score'];

}
