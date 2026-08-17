<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola User',
            'users' => $this->userModel->orderBy('created_at', 'DESC')->findAll()
        ];
        return view('administrator/manage_user', $data);
    }

    public function hapus($id)
    {
        // Hindari hapus akun sendiri
        if ($id == session()->get('id')) {
            return redirect()->to('/administrator/user')->with('error', 'Tidak dapat menghapus akun Anda sendiri yang sedang login.');
        }

        $this->userModel->delete($id);
        return redirect()->to('/administrator/user')->with('success', 'User berhasil dihapus.');
    }
}
