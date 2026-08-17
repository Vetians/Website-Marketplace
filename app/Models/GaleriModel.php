<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table      = 'galeri';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'judul',
        'gambar',
        'deskripsi',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
}
