<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\BeritaModel;
use App\Models\GaleriModel;
use App\Models\PesanModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Admin extends BaseController
{
    use ResponseTrait;

    public function dashboard()
    {
        $produkModel = new ProdukModel();
        $beritaModel = new BeritaModel();
        $pesanModel  = new PesanModel();
        $userModel   = new UserModel();

        return $this->respond([
            'status' => 200,
            'data' => [
                'total_produk' => $produkModel->countAllResults(),
                'total_berita' => $beritaModel->countAllResults(),
                'total_pesan'  => $pesanModel->countAllResults(),
                'total_user'   => $userModel->countAllResults(),
            ]
        ]);
    }

    public function produk()
    {
        $produkModel = new ProdukModel();
        $data = $produkModel->db->table('produk p')
            ->select('p.*, k.nama as nama_kategori')
            ->join('kategori k', 'k.id = p.kategori_id', 'left')
            ->orderBy('p.created_at', 'DESC')
            ->get()->getResultArray();

        if ($data) {
            return $this->respond(['status' => 200, 'data' => $data]);
        }
        return $this->failNotFound('Tidak ada produk.');
    }

    public function kategori()
    {
        $kategoriModel = new KategoriModel();
        $data = $kategoriModel->findAll();
        return $this->respond(['status' => 200, 'data' => $data]);
    }

    public function berita()
    {
        $beritaModel = new BeritaModel();
        $data = $beritaModel->orderBy('created_at', 'DESC')->findAll();
        return $this->respond(['status' => 200, 'data' => $data]);
    }

    public function galeri()
    {
        $galeriModel = new GaleriModel();
        $data = $galeriModel->orderBy('created_at', 'DESC')->findAll();
        return $this->respond(['status' => 200, 'data' => $data]);
    }

    public function pesan()
    {
        $pesanModel = new PesanModel();
        $data = $pesanModel->orderBy('created_at', 'DESC')->findAll();
        return $this->respond(['status' => 200, 'data' => $data]);
    }

    public function user()
    {
        $userModel = new UserModel();
        $data = $userModel->findAll();
        return $this->respond(['status' => 200, 'data' => $data]);
    }

    public function produkDetail($id)
    {
        $produkModel = new ProdukModel();
        $data = $produkModel->db->table('produk p')
            ->select('p.*, k.nama as nama_kategori')
            ->join('kategori k', 'k.id = p.kategori_id', 'left')
            ->where('p.id', $id)
            ->get()->getRowArray();

        if ($data) {
            return $this->respond(['status' => 200, 'data' => $data]);
        }
        return $this->failNotFound('Produk tidak ditemukan.');
    }

    public function beritaDetail($id)
    {
        $beritaModel = new BeritaModel();
        $data = $beritaModel->find($id);

        if ($data) {
            return $this->respond(['status' => 200, 'data' => $data]);
        }
        return $this->failNotFound('Berita tidak ditemukan.');
    }
}
