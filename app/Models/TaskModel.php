<?php

namespace App\Models;
use CodeIgniter\Model;


class TaskModel extends Model{

    protected $table      = 'task';
    protected $primaryKey = 'idtask';

    protected $allowedFields = ['name', 'location', 'duetime', 'description', 'active','progress'];

}