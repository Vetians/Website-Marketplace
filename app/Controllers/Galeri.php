<?php

namespace App\Controllers;

use App\Models\GaleriModel;

class Galeri extends BaseController
{
    public function index()
    {
        $galeriModel = new GaleriModel();

        $data = $this->data;
        $data['title']  = 'Galeri Foto | Preloved Ukrida';
        $data['galeri'] = $galeriModel->orderBy('created_at', 'DESC')->findAll();

        return view('public/galeri', $data);
    }
}
