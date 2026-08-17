<?php

namespace App\Controllers;

use App\Models\PesanModel;

class Kontak extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Hubungi Kami | Preloved Ukrida';

        return view('public/kontak', $data);
    }

    public function kirim()
    {
        $rules = [
            'nama'   => 'required|min_length[3]',
            'email'  => 'required|valid_email',
            'subjek' => 'required|min_length[5]',
            'pesan'  => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/kontak')->withInput()->with('errors', $this->validator->getErrors());
        }

        $pesanModel = new PesanModel();
        $pesanModel->insert([
            'nama'   => $this->request->getPost('nama'),
            'email'  => $this->request->getPost('email'),
            'subjek' => $this->request->getPost('subjek'),
            'pesan'  => $this->request->getPost('pesan'),
        ]);

        return redirect()->to('/kontak')->with('success', 'Pesan Anda berhasil dikirim! Kami akan segera merespons.');
    }
}
