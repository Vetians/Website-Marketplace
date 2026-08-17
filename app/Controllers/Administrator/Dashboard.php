<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\BeritaModel;
use App\Models\PesanModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $beritaModel = new BeritaModel();
        $pesanModel  = new PesanModel();
        $userModel   = new UserModel();

        $data = [
            'title'        => 'Dashboard Administrator',
            'total_produk' => $produkModel->countAllResults(),
            'total_berita' => $beritaModel->countAllResults(),
            'total_pesan'  => $pesanModel->countAllResults(),
            'total_user'   => $userModel->countAllResults()
        ];

        return view('administrator/dashboard', $data);
    }
}
