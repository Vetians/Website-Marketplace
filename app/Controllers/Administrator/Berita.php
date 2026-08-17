<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
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
        $data = [
            'title'  => 'Kelola Berita & Artikel',
            'berita' => $this->beritaModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('administrator/manage_berita', $data);
    }

    public function simpan()
    {
        $rules = [
            'judul'  => 'required',
            'konten' => 'required',
            'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/administrator/berita')->with('errors', $this->validator->getErrors());
        }

        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('assets/uploads', $namaGambar);

        $slug = url_title($this->request->getPost('judul'), '-', true);

        $this->beritaModel->insert([
            'judul'  => $this->request->getPost('judul'),
            'slug'   => $slug,
            'konten' => $this->request->getPost('konten'),
            'status' => $this->request->getPost('status'),
            'gambar' => $namaGambar
        ]);

        return redirect()->to('/administrator/berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function update($id)
    {
        $rules = [
            'judul'  => 'required',
            'konten' => 'required'
        ];

        $fileGambar = $this->request->getFile('gambar');
        if ($fileGambar->getError() != 4) {
            $rules['gambar'] = 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->to('/administrator/berita')->with('errors', $this->validator->getErrors());
        }

        $beritaLama = $this->beritaModel->find($id);
        $namaGambar = $beritaLama['gambar'];

        if ($fileGambar->getError() != 4) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('assets/uploads', $namaGambar);
            if ($beritaLama['gambar'] && file_exists('assets/uploads/' . $beritaLama['gambar'])) {
                unlink('assets/uploads/' . $beritaLama['gambar']);
            }
        }

        $slug = url_title($this->request->getPost('judul'), '-', true);

        $this->beritaModel->update($id, [
            'judul'  => $this->request->getPost('judul'),
            'slug'   => $slug,
            'konten' => $this->request->getPost('konten'),
            'status' => $this->request->getPost('status'),
            'gambar' => $namaGambar
        ]);

        return redirect()->to('/administrator/berita')->with('success', 'Berita berhasil diupdate.');
    }

    public function hapus($id)
    {
        $berita = $this->beritaModel->find($id);
        if ($berita['gambar'] && file_exists('assets/uploads/' . $berita['gambar'])) {
            unlink('assets/uploads/' . $berita['gambar']);
        }
        $this->beritaModel->delete($id);
        return redirect()->to('/administrator/berita')->with('success', 'Berita berhasil dihapus.');
    }
}
