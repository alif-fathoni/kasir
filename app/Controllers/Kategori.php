<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public $data;

    public function __construct()
    {
         $this->data['menu'] = 'kategori';
    }

    public function index()
    {
        $kategoriModel = new KategoriModel();

        $this->data['data'] = $kategoriModel->all()->get()->getResult();

        return view('kategori/index', $this->data);
    }

    public function tambah()
    {
        return view('kategori/tambah', $this->data);
    }

    public function tambah_simpan()
    {
        $nama = $this->request->getPost('nama');

        $this->validation->setRules([
            'nama' => ['label' => 'Nama', 'rules' => 'required|max_length[255]'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()){

            return redirect()->back()->withInput()->with('error', $this->validation->listErrors() ); 
        }


        $kategoriModel = new KategoriModel();

        $data = [
            'nama' => $nama,
            'input_waktu' => date('Y-m-d H:i:s'),
            'input_admin_id' => session()->get('id')
        ];

        $result = $kategoriModel->add($data);

        if ($result) {
            return redirect()->to('kategori');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah'); 
        }
    }


    public function edit($id)
    {
        $kategoriModel = new KategoriModel();

        $this->data['data'] = $kategoriModel->all()->where('id', $id)->get()->getRow();

        return view('kategori/edit', $this->data);
    }
    
    public function edit_simpan($id)
    {
        $nama = $this->request->getPost('nama');

        $this->validation->setRules([
            'nama' => ['label' => 'Nama', 'rules' => 'required|max_length[255]'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()){

            return redirect()->back()->withInput()->with('error', $this->validation->listErrors() ); 
        }


        $kategoriModel = new KategoriModel();

        $data = [
            'nama' => $nama, 
            'input_waktu' => date('Y-m-d H:i:s'),
            'input_admin_id' => session()->get('id')
        ];

        $result = $kategoriModel->edit($data, $id);

        if ($result) {
            return redirect()->to('kategori');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Edit'); 
        }
    }


    public function hapus($id){

        $kategoriModel = new KategoriModel();
        $result = $kategoriModel->remove($id);

        if ($result) {
            return redirect()->to('kategori')->with('success', 'Berhasil Hapus');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Edit'); 
        }

    }


}
