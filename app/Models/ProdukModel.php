<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kategori_id',
        'user_id',
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'kondisi',
        'gambar',
        'stok',
        'status',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getProdukDenganKategori($limit = null)
    {
        $builder = $this->db->table('produk p')
            ->select('p.*, k.nama as nama_kategori, k.slug as slug_kategori')
            ->join('kategori k', 'k.id = p.kategori_id', 'left')
            ->where('p.status', 'aktif')
            ->orderBy('p.created_at', 'DESC');

        if ($limit) {
            $builder->limit($limit);
        }

        return $builder->get()->getResultArray();
    }

    public function getProdukByKategori($kategori_id)
    {
        return $this->db->table('produk p')
            ->select('p.*, k.nama as nama_kategori, k.slug as slug_kategori')
            ->join('kategori k', 'k.id = p.kategori_id', 'left')
            ->where('p.status', 'aktif')
            ->where('p.kategori_id', $kategori_id)
            ->orderBy('p.created_at', 'DESC')
            ->get()->getResultArray();
    }

    public function getProdukByKategoriSlug($slug)
    {
        return $this->db->table('produk p')
            ->select('p.*, k.nama as nama_kategori, k.slug as slug_kategori')
            ->join('kategori k', 'k.id = p.kategori_id', 'left')
            ->where('p.status', 'aktif')
            ->where('k.slug', $slug)
            ->orderBy('p.created_at', 'DESC')
            ->get()->getResultArray();
    }

    public function getProdukDetail($id)
    {
        return $this->db->table('produk p')
            ->select('p.*, k.nama as nama_kategori, k.slug as slug_kategori')
            ->join('kategori k', 'k.id = p.kategori_id', 'left')
            ->where('p.id', $id)
            ->where('p.status', 'aktif')
            ->get()->getRowArray();
    }

    public function getProdukDetailBySlug($slug)
    {
        return $this->db->table('produk p')
            ->select('p.*, k.nama as nama_kategori, k.slug as slug_kategori')
            ->join('kategori k', 'k.id = p.kategori_id', 'left')
            ->where('p.slug', $slug)
            ->where('p.status', 'aktif')
            ->get()->getRowArray();
    }

    public function searchProduk($keyword)
    {
        return $this->db->table('produk p')
            ->select('p.*, k.nama as nama_kategori')
            ->join('kategori k', 'k.id = p.kategori_id', 'left')
            ->where('p.status', 'aktif')
            ->groupStart()
                ->like('p.nama', $keyword)
                ->orLike('p.deskripsi', $keyword)
            ->groupEnd()
            ->orderBy('p.created_at', 'DESC')
            ->get()->getResultArray();
    }
}
