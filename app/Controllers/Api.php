<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\BeritaModel;
use App\Models\GaleriModel;
use CodeIgniter\API\ResponseTrait;

class Api extends BaseController
{
    use ResponseTrait;

    public function produk()
    {
        $produkModel = new ProdukModel();
        
        $kategori_id   = $this->request->getGet('kategori');
        $kategori_slug = $this->request->getGet('kategori_slug');
        
        if ($kategori_slug) {
            $data = $produkModel->getProdukByKategoriSlug($kategori_slug);
        } elseif ($kategori_id) {
            $data = $produkModel->getProdukByKategori($kategori_id);
        } else {
            $data = $produkModel->getProdukDenganKategori();
        }

        if ($data) {
            return $this->respond([
                'status' => 200,
                'message' => 'Data produk berhasil diambil',
                'data' => $data
            ]);
        } else {
            return $this->failNotFound('Tidak ada produk yang ditemukan.');
        }
    }

    public function produkDetail($slug)
    {
        $produkModel = new ProdukModel();
        $data = $produkModel->getProdukDetailBySlug($slug);

        if ($data) {
            return $this->respond([
                'status' => 200,
                'message' => 'Data produk berhasil diambil',
                'data' => $data
            ]);
        } else {
            return $this->failNotFound('Produk tidak ditemukan.');
        }
    }

    public function beritaDetail($slug)
    {
        $beritaModel = new BeritaModel();
        $data = $beritaModel->getBeritaBySlug($slug);

        if ($data) {
            return $this->respond([
                'status' => 200,
                'message' => 'Data berita berhasil diambil',
                'data' => $data
            ]);
        } else {
            return $this->failNotFound('Berita tidak ditemukan.');
        }
    }

    public function kategori()
    {
        $kategoriModel = new KategoriModel();
        $data = $kategoriModel->findAll();

        if ($data) {
            return $this->respond([
                'status' => 200,
                'message' => 'Data kategori berhasil diambil',
                'data' => $data
            ]);
        } else {
            return $this->failNotFound('Tidak ada kategori yang ditemukan.');
        }
    }

    public function berita()
    {
        $beritaModel = new BeritaModel();
        $data = $beritaModel->getBeritaPublish();

        if ($data) {
            return $this->respond([
                'status' => 200,
                'message' => 'Data berita berhasil diambil',
                'data' => $data
            ]);
        } else {
            return $this->failNotFound('Tidak ada berita yang ditemukan.');
        }
    }

    public function galeri()
    {
        $galeriModel = new GaleriModel();
        $data = $galeriModel->orderBy('created_at', 'DESC')->findAll();

        if ($data) {
            return $this->respond([
                'status' => 200,
                'message' => 'Data galeri berhasil diambil',
                'data' => $data
            ]);
        } else {
            return $this->failNotFound('Tidak ada galeri yang ditemukan.');
        }
    }
}
