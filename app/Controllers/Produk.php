<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;

class Produk extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
        $this->data['kategori_menu'] = $this->kategoriModel->findAll();
    }

    public function index()
    {
        $kategori_id = $this->request->getGet('kategori');
        $keyword     = $this->request->getGet('q');

        if ($kategori_id) {
            $kategori = $this->kategoriModel->find($kategori_id);
            if ($kategori) {
                return redirect()->to('/produk/kategori/' . $kategori['slug']);
            }
        }

        if ($keyword) {
            $produk = $this->produkModel->searchProduk($keyword);
        } else {
            $produk = $this->produkModel->getProdukDenganKategori();
        }

        $data = $this->data;
        $data['title']          = 'Marketplace | Preloved Ukrida';
        $data['produk']         = $produk;
        $data['kategori_id']    = $kategori_id;
        $data['kategori_slug']  = null;
        $data['keyword']        = $keyword;
        $data['kategori']       = $data['kategori_menu'];

        return view('public/produk', $data);
    }

    public function kategori($slug)
    {
        $kategoriAktif = $this->kategoriModel->where('slug', $slug)->first();

        if (!$kategoriAktif) {
            return redirect()->to('/produk')->with('error', 'Kategori tidak ditemukan.');
        }

        $data = $this->data;
        $data['title']          = $kategoriAktif['nama'] . ' | Marketplace Preloved Ukrida';
        $data['produk']         = $this->produkModel->getProdukByKategoriSlug($slug);
        $data['kategori_id']    = $kategoriAktif['id'];
        $data['kategori_slug']  = $slug;
        $data['kategori_aktif'] = $kategoriAktif;
        $data['keyword']        = null;
        $data['kategori']       = $data['kategori_menu'];

        return view('public/produk', $data);
    }

    public function detail($slug)
    {
        $produk = is_numeric($slug)
            ? $this->produkModel->getProdukDetail($slug)
            : $this->produkModel->getProdukDetailBySlug($slug);

        if (!$produk) {
            return redirect()->to('/produk')->with('error', 'Produk tidak ditemukan.');
        }

        if (is_numeric($slug)) {
            return redirect()->to('/produk/' . $produk['slug']);
        }

        $data = $this->data;
        $data['title']  = $produk['nama'] . ' | Preloved Ukrida';
        $data['produk'] = $produk;
        $data['produk_lain'] = $this->produkModel->getProdukDenganKategori(4);

        return view('public/produk_detail', $data);
    }
}
