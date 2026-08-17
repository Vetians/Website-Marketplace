<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table      = 'berita';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'status',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getBeritaPublish($limit = null)
    {
        $builder = $this->where('status', 'publish')
            ->orderBy('created_at', 'DESC');

        if ($limit) {
            $builder->limit($limit);
        }

        return $builder->findAll();
    }

    public function getBeritaBySlug($slug)
    {
        return $this->where('slug', $slug)
            ->where('status', 'publish')
            ->first();
    }
}
