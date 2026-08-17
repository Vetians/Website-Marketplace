<?php

namespace App\Controllers;

use App\Models\BeritaModel;

class Berita extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

    public function index()
    {
        $data = $this->data;
        $data['title']  = 'Berita & Artikel | Preloved Ukrida';
        $data['berita'] = $this->beritaModel->getBeritaPublish();

        return view('public/berita', $data);
    }

    public function detail($slug)
    {
        $berita = $this->beritaModel->getBeritaBySlug($slug);

        if (!$berita) {
            return redirect()->to('/berita')->with('error', 'Artikel tidak ditemukan.');
        }

        $data = $this->data;
        $data['title']       = $berita['judul'] . ' | Preloved Ukrida';
        $data['berita']      = $berita;
        $data['berita_lain'] = $this->beritaModel->getBeritaPublish(3);

        return view('public/berita_detail', $data);
    }
}
