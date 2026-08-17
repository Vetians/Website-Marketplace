<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, arahkan ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/administrator/dashboard');
        }

        $data = $this->data;
        $data['title'] = 'Login Administrator | Preloved Ukrida';
        
        return view('administrator/login', $data);
    }

    public function processLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->getUserByEmail($email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $ses_data = [
                    'id'         => $user['id'],
                    'nama'       => $user['nama'],
                    'email'      => $user['email'],
                    'role'       => $user['role'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/administrator/dashboard');
            } else {
                $session->setFlashdata('error', 'Password salah.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Email tidak ditemukan.');
            return redirect()->to('/login');
        }
    }

    public function register()
    {
        $data = $this->data;
        $data['title'] = 'Daftar Akun Baru | Preloved Ukrida';
        
        return view('administrator/register', $data);
    }

    public function processRegister()
    {
        $rules = [
            'nama'            => 'required|min_length[3]',
            'email'           => 'required|valid_email|is_unique[users.email]',
            'password'        => 'required|min_length[6]',
            'password_verify' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/register')->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->insert([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'admin' // by default set as admin based on requirements "mengakses menu administrator"
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
