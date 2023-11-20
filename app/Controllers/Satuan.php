<?php

namespace App\Controllers;

use App\Models\SatuanModel;

class Satuan extends BaseController
{
    public $data;

    public function __construct()
    {
         $this->data['menu'] = 'satuan';
    }

    public function index()
    {
        $satuanModel = new SatuanModel();

        $this->data['data'] = $satuanModel->all()->get()->getResult();

        return view('satuan/index', $this->data);
    }

    public function tambah()
    {
        return view('satuan/tambah', $this->data);
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


        $satuanModel = new SatuanModel();

        $data = [
            'nama' => $nama,
            'input_waktu' => date('Y-m-d H:i:s'),
            'input_admin_id' => session()->get('id')
        ];

        $result = $satuanModel->add($data);

        if ($result) {
            return redirect()->to('satuan');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah'); 
        }
    }


    public function edit($id)
    {
        $satuanModel = new SatuanModel();

        $this->data['data'] = $satuanModel->all()->where('id', $id)->get()->getRow();

        return view('satuan/edit', $this->data);
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


        $satuanModel = new SatuanModel();

        $data = [
            'nama' => $nama, 
            'input_waktu' => date('Y-m-d H:i:s'),
            'input_admin_id' => session()->get('id')
        ];

        $result = $satuanModel->edit($data, $id);

        if ($result) {
            return redirect()->to('satuan');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Edit'); 
        }
    }


    public function hapus($id){

        $satuanModel = new SatuanModel();
        $result = $satuanModel->remove($id);

        if ($result) {
            return redirect()->to('satuan')->with('success', 'Berhasil Hapus');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Edit'); 
        }

    }


}
