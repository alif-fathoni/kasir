<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\SatuanModel;

class Produk extends BaseController
{
    public $data;

    public function __construct()
    {
         $this->data['menu'] = 'produk';
    }

    public function index()
    {
        $produkModel = new ProdukModel();

        $this->data['data'] = $produkModel->all()->get()->getResult();

        return view('produk/index', $this->data);
    }

    public function tambah()
    {
        $kategoriModel = new KategoriModel();
        $satuanModel = new SatuanModel();

        $this->data['data_kategori'] = $kategoriModel->all()->get()->getResult();
        $this->data['data_satuan'] = $satuanModel->all()->get()->getResult();

        return view('produk/tambah', $this->data);
    }

    public function tambah_simpan()
    {
        $this->validation->setRules([
            'code' => ['label' => 'Kode Produk', 'rules' => 'required|max_length[255]|is_unique[produk.code]'],
            'nama' => ['label' => 'Nama Produk', 'rules' => 'required|max_length[255]'],
            'harga_beli' => ['label' => 'Harga Beli', 'rules' => 'required|max_length[50]'],            
            'harga_jual' => ['label' => 'Harga Jual', 'rules' => 'required|max_length[50]'],
            'satuan_id' => ['label' => 'Satuan', 'rules' => 'required|max_length[11]'],
            'kategori_id' => ['label' => 'Kategori', 'rules' => 'required|max_length[11]'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('error', $this->validation->listErrors() ); 
        }

        $produkModel = new ProdukModel();

        $data = [
            'code' => $this->request->getPost('code'),
            'nama' => $this->request->getPost('nama'),
            'jumlah' => 0,
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'satuan_id' => $this->request->getPost('satuan_id'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'input_waktu' => date('Y-m-d H:i:s'),
            'input_admin_id' => session()->get('id')
        ];

        $result = $produkModel->add($data);

        if ($result) {
            return redirect()->to('produk');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah'); 
        }
    }


    public function edit($id)
    {

        $kategoriModel = new KategoriModel();
        $satuanModel = new SatuanModel();
        $produkModel = new ProdukModel();

        $this->data['data_kategori'] = $kategoriModel->all()->get()->getResult();
        $this->data['data_satuan'] = $satuanModel->all()->get()->getResult();
        $this->data['data'] = $produkModel->all()->where('produk.id', $id)->get()->getRow();

        return view('produk/edit', $this->data);
    }
    
    public function edit_simpan($id)
    {


        $this->validation->setRules([
            'nama' => ['label' => 'Nama Produk', 'rules' => 'required|max_length[255]'],
            'harga_beli' => ['label' => 'Harga Beli', 'rules' => 'required|max_length[50]'],            
            'harga_jual' => ['label' => 'Harga Jual', 'rules' => 'required|max_length[50]'],
            'satuan_id' => ['label' => 'Satuan', 'rules' => 'required|max_length[11]'],
            'kategori_id' => ['label' => 'Kategori', 'rules' => 'required|max_length[11]'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()){

            return redirect()->back()->withInput()->with('error', $this->validation->listErrors() ); 
        }


        $produkModel = new ProdukModel();

        $data = [
            'nama' => $this->request->getPost('nama'),
            'jumlah' => 0,
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'satuan_id' => $this->request->getPost('satuan_id'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'input_waktu' => date('Y-m-d H:i:s'),
            'input_admin_id' => session()->get('id')
        ];

        $result = $produkModel->edit($data, $id);

        if ($result) {
            return redirect()->to('produk');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Edit'); 
        }
    }


    public function hapus($id){

        $produkModel = new ProdukModel();
        $result = $produkModel->remove($id);

        if ($result) {
            return redirect()->to('produk')->with('success', 'Berhasil Hapus');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Edit'); 
        }

    }


}
