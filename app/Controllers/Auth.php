<?php

namespace App\Controllers;

use App\Models\Employe;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'POST' || $this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $employeModel = new Employe();
            $user = $employeModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                session()->set([
                    'user_id' => $user['id'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'role' => $user['role'],
                    'isLoggedIn' => true
                ]);

                if ($user['role'] === 'rh') {
                    return redirect()->to('/rh');
                } elseif ($user['role'] === 'admin') {
                    return redirect()->to('/admin');
                }
                return redirect()->to('/user');
            } else {
                return redirect()->back()->with('error', 'Email ou mot de passe invalide.');
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
