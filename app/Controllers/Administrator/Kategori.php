<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Kelola Kategori',
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('administrator/manage_kategori', $data);
    }

    public function simpan()
    {
        $rules = [
            'nama' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/administrator/kategori')->with('errors', $this->validator->getErrors());
        }

        $slug = url_title($this->request->getPost('nama'), '-', true);

        $this->kategoriModel->insert([
            'nama'      => $this->request->getPost('nama'),
            'slug'      => $slug,
            'deskripsi' => $this->request->getPost('deskripsi')
        ]);

        return redirect()->to('/administrator/kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update($id)
    {
        $rules = [
            'nama' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/administrator/kategori')->with('errors', $this->validator->getErrors());
        }

        $slug = url_title($this->request->getPost('nama'), '-', true);

        $this->kategoriModel->update($id, [
            'nama'      => $this->request->getPost('nama'),
            'slug'      => $slug,
            'deskripsi' => $this->request->getPost('deskripsi')
        ]);

        return redirect()->to('/administrator/kategori')->with('success', 'Kategori berhasil diupdate.');
    }

    public function hapus($id)
    {
        $this->kategoriModel->delete($id);
        return redirect()->to('/administrator/kategori')->with('success', 'Kategori berhasil dihapus.');
    }
}
