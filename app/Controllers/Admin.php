<?php

namespace App\Controllers;

use App\Models\AdminModel; 

class Admin extends BaseController
{
    public $data;

    public function __construct()
    {
         $this->data['menu'] = 'admin';
    }

    public function index()
    {
        $adminModel = new AdminModel();

        $this->data['data'] = $adminModel->all()->get()->getResult();

        return view('admin/index', $this->data);
    }

    public function tambah()
    {
        return view('admin/tambah', $this->data);
    }

    public function tambah_simpan()
    {
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $this->validation->setRules([
            'nama' => ['label' => 'Nama', 'rules' => 'required|max_length[255]'],
            'username' => ['label' => 'Username', 'rules' => 'required|max_length[255]|is_unique[admin.username]'],
            'password' => ['label' => 'Password', 'rules' => 'required|max_length[255]'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()){

            return redirect()->back()->withInput()->with('error', $this->validation->listErrors() ); 
        }


        $adminModel = new AdminModel();

        $password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'ijinkan_login' => 1, 
            'input_waktu' => date('Y-m-d H:i:s'),
            'input_admin_id' => session()->get('id')
        ];

        $result = $adminModel->add($data);

        if ($result) {
            return redirect()->to('admin');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah'); 
        }
    }


    public function edit($id)
    {
        $adminModel = new AdminModel();

        $this->data['data'] = $adminModel->all()->where('id', $id)->get()->getRow();

        return view('admin/edit', $this->data);
    }
    
    public function edit_simpan($id)
    {
        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $this->validation->setRules([
            'nama' => ['label' => 'Nama', 'rules' => 'required|max_length[255]'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()){

            return redirect()->back()->withInput()->with('error', $this->validation->listErrors() ); 
        }


        $adminModel = new AdminModel();

        $data = [
            'nama' => $nama,
            'ijinkan_login' => 1, 
            'input_waktu' => date('Y-m-d H:i:s'),
            'input_admin_id' => session()->get('id')
        ];

        if ($password != '') {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $data['password'] = $password; 
        }


        $result = $adminModel->edit($data, $id);

        if ($result) {
            return redirect()->to('admin');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Edit'); 
        }
    }


    public function hapus($id){

        $adminModel = new AdminModel();
        $result = $adminModel->remove($id);

        if ($result) {
            return redirect()->to('admin')->with('success', 'Berhasil Hapus');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Edit'); 
        }

    }


}
