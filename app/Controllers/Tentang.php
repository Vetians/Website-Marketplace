<?php

namespace App\Controllers;

class Tentang extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Tentang Kami | Preloved Ukrida';

        return view('public/tentang', $data);
    }
}
