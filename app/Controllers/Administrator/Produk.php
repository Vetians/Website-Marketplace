<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KategoriModel;

class Produk extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Kelola Produk',
            'produk' => $this->produkModel->getProdukDenganKategori(),
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('administrator/manage_produk', $data);
    }

    public function tambah()
    {
        // This can be a modal in the index view, or a separate page.
        // We will implement it via a modal in index for simplicity and UX.
        return redirect()->to('/administrator/produk');
    }

    public function simpan()
    {
        $rules = [
            'nama'        => 'required',
            'kategori_id' => 'required',
            'harga'       => 'required|numeric',
            'kondisi'     => 'required',
            'stok'        => 'required|numeric',
            'gambar'      => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/administrator/produk')->with('errors', $this->validator->getErrors());
        }

        // Handle File Upload
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('assets/uploads', $namaGambar);

        $slug = url_title($this->request->getPost('nama'), '-', true);

        $this->produkModel->insert([
            'kategori_id' => $this->request->getPost('kategori_id'),
            'user_id'     => session()->get('id'),
            'nama'        => $this->request->getPost('nama'),
            'slug'        => $slug,
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'kondisi'     => $this->request->getPost('kondisi'),
            'stok'        => $this->request->getPost('stok'),
            'status'      => $this->request->getPost('status'),
            'gambar'      => $namaGambar
        ]);

        return redirect()->to('/administrator/produk')->with('success', 'Data produk berhasil ditambahkan.');
    }

    public function update($id)
    {
        $rules = [
            'nama'        => 'required',
            'kategori_id' => 'required',
            'harga'       => 'required|numeric',
            'kondisi'     => 'required',
            'stok'        => 'required|numeric'
        ];

        $fileGambar = $this->request->getFile('gambar');
        if ($fileGambar->getError() != 4) {
            $rules['gambar'] = 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->to('/administrator/produk')->with('errors', $this->validator->getErrors());
        }

        $produkLama = $this->produkModel->find($id);
        $namaGambar = $produkLama['gambar'];

        if ($fileGambar->getError() != 4) {
            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('assets/uploads', $namaGambar);
            if ($produkLama['gambar'] && file_exists('assets/uploads/' . $produkLama['gambar'])) {
                unlink('assets/uploads/' . $produkLama['gambar']);
            }
        }

        $slug = url_title($this->request->getPost('nama'), '-', true);

        $this->produkModel->update($id, [
            'kategori_id' => $this->request->getPost('kategori_id'),
            'nama'        => $this->request->getPost('nama'),
            'slug'        => $slug,
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'kondisi'     => $this->request->getPost('kondisi'),
            'stok'        => $this->request->getPost('stok'),
            'status'      => $this->request->getPost('status'),
            'gambar'      => $namaGambar
        ]);

        return redirect()->to('/administrator/produk')->with('success', 'Data produk berhasil diubah.');
    }

    public function hapus($id)
    {
        $produk = $this->produkModel->find($id);
        if ($produk['gambar'] && file_exists('assets/uploads/' . $produk['gambar'])) {
            unlink('assets/uploads/' . $produk['gambar']);
        }
        $this->produkModel->delete($id);
        return redirect()->to('/administrator/produk')->with('success', 'Data produk berhasil dihapus.');
    }
}
