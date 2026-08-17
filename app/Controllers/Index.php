<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Index extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();

        $data = $this->data;
        $data['title'] = 'Beranda | Preloved Ukrida';
        $data['produk_terbaru'] = $produkModel->getProdukDenganKategori(8);

        return view('public/index', $data);
    }
}
