<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{

    public function index()
    {
        return view('auth/login.php');
    }

    public function login(){

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $this->validation->setRules([
            'username' => ['label' => 'Username', 'rules' => 'required|max_length[255]'],
            'password' => ['label' => 'Password', 'rules' => 'required|max_length[255]'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()){

            return redirect()->back()->withInput()->with('error', $this->validation->listErrors() ); 
        }


        $adminModel = new AdminModel(); 

        $login = $adminModel->login($username, $password);

        if ($login) {
            session()->set($login);
            return redirect()->to('home');
        }else{
            return redirect()->back()->withInput()->with('error', 'Username/Password Salah'); 
        }
    }
}
