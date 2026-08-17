<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\GaleriModel;

class Galeri extends BaseController
{
    protected $galeriModel;

    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Kelola Galeri Foto',
            'galeri' => $this->galeriModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('administrator/manage_galeri', $data);
    }

    public function simpan()
    {
        $rules = [
            'judul'  => 'required',
            'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/administrator/galeri')->with('errors', $this->validator->getErrors());
        }

        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('assets/uploads', $namaGambar);

        $this->galeriModel->insert([
            'judul'     => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar'    => $namaGambar
        ]);

        return redirect()->to('/administrator/galeri')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function hapus($id)
    {
        $galeri = $this->galeriModel->find($id);
        if ($galeri['gambar'] && file_exists('assets/uploads/' . $galeri['gambar'])) {
            unlink('assets/uploads/' . $galeri['gambar']);
        }
        $this->galeriModel->delete($id);
        return redirect()->to('/administrator/galeri')->with('success', 'Foto galeri berhasil dihapus.');
    }
}
