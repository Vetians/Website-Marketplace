<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\PesanModel;

class Pesan extends BaseController
{
    protected $pesanModel;

    public function __construct()
    {
        $this->pesanModel = new PesanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pesan Masuk',
            'pesan' => $this->pesanModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('administrator/manage_pesan', $data);
    }

    public function hapus($id)
    {
        $this->pesanModel->delete($id);
        return redirect()->to('/administrator/pesan')->with('success', 'Pesan berhasil dihapus.');
    }
}
