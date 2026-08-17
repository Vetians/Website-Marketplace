<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    protected $hiddenFields = ['password'];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
