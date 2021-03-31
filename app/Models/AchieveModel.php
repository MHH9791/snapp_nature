<?php


namespace App\Models;
use CodeIgniter\Model;


class AchieveModel extends Model
{
    protected $table = 'achieve';
    protected $allowedFields = ['user_id', 'task_id'];
}