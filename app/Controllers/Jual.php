<?php

namespace App\Controllers;

use App\Models\JualModel;
use App\Models\JualDetailModel;
use App\Models\ProdukModel;
use App\Models\SatuanModel;
use App\Models\PelangganModel;

class Jual extends BaseController
{
    public $data;

    public function __construct()
    {
         $this->data['menu'] = 'jual';
    }

    public function index()
    {
        $jualModel = new JualModel();

        $this->data['data'] = $jualModel->all()->get()->getResult();

        return view('jual/index', $this->data);
    }

    public function tambah()
    {
        $satuanModel = new SatuanModel();
        $this->data['data_satuan'] = $satuanModel->all()->get()->getResult();

        $pelangganModel = new PelangganModel();
        $this->data['data_pelanggan'] = $pelangganModel->all()->get()->getResult();

        return view('jual/tambah', $this->data);
    }

    public function tambah_simpan()
    {

        $rules = [
            'nota' => ['label' => 'Nama', 'rules' => 'required|max_length[255]'],
            'description' => ['label' => 'Nama', 'rules' => 'max_length[255]'],
        ];

        $this->validation->setRules($rules);

        if (!$this->validation->withRequest($this->request)->run()){

            return redirect()->back()->withInput()->with('error', $this->validation->listErrors() ); 
        }


        $jualModel = new JualModel();
        $jualDetailModel = new jualDetailModel();
        $produkModel = new ProdukModel();
        $pelangganModel = new PelangganModel();

        $pelangganID = $this->request->getPost('pelanggan_id');
        if ($pelangganID == '-') {
            $pelangganNama = $this->request->getPost('pelanggan_nama');
            $pelangganNoTelp = $this->request->getPost('pelanggan_no_telp');
            $pelangganID = $pelangganModel->add([
                'nama' => $pelangganNama,
                'no_telp' => $pelangganNoTelp,
                'input_waktu' => date('Y-m-d H:i:s'),
                'input_admin_id' => session()->get('id')
            ]);
        }else{
            $pelangganData = $pelangganModel->all()->where('id', $pelangganID)->get()->getRow();

            $pelangganNama = $pelangganData->nama;
            $pelangganNoTelp = $pelangganData->no_telp;
        }

        $data = [
            'nota' => $this->request->getPost('nota'),
            'tanggal' => date('Y-m-d'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'pelanggan_id' => $pelangganID,
            'pelanggan_nama' => $pelangganNama,
            'pelanggan_no_telp' => $pelangganNoTelp,
            'input_waktu' => date('Y-m-d H:i:s'),
            'input_admin_id' => session()->get('id')
        ];

        $jualID = $jualModel->add($data);

        $data2 = [];

        $produkArray = $this->request->getPost('produk_id');
        $jumlahArray = $this->request->getPost('jumlah');
        $hargaArray = $this->request->getPost('harga');
        $satuanArray = $this->request->getPost('satuan_id');

        $namaArray = $this->request->getPost('nama');
        $codeArray = $this->request->getPost('code');

        foreach ($produkArray as $key => $value) {

            $produkID = $produkArray[$key];

            if ($value == 'new') {
                $data1 = [
                    'code' => $codeArray[$key],
                    'nama' => $namaArray[$key],
                    'jumlah' => 0,
                    'harga_jual' => $hargaArray[$key],
                    'harga_jual' => NULL,
                    'satuan_id' => $satuanArray[$key],
                    'kategori_id' => NULL,
                    'input_waktu' => date('Y-m-d H:i:s'),
                    'input_admin_id' => session()->get('id')
                ];

                $produkID = $produkModel->add($data1);

            }

            $data2[] = [
                'jual_id' => $jualID,
                'produk_id' => $produkID,
                'harga' => $hargaArray[$key],
                'jumlah' => $jumlahArray[$key],
                'satuan_id' => $satuanArray[$key],
                'input_waktu' => date('Y-m-d H:i:s'),
                'input_admin_id' => session()->get('id')
            ];
        }


        $jualDetail = $jualDetailModel->addBulk($data2);

        if ($jualID && $jualDetail) {
            return redirect()->to('jual');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Tambah'); 
        }
    }


    public function produk(){

        $produkCode = $this->request->getVar('produk_code');

        $produkModel = new ProdukModel();

        $produk = $produkModel->all()->where('code', $produkCode)->get()->getRow();

        echo json_encode($produk);

    }


    public function hapus($id){

        $jualModel = new JualModel();
        $jualDetailModel = new jualDetailModel();

        $result = $jualModel->remove($id);

        $result2 = $jualDetailModel->removeByjual($jualID);

        if ($result) {
            return redirect()->to('jual')->with('success', 'Berhasil Hapus');
        }else{
            return redirect()->back()->withInput()->with('error', 'Gagal Edit'); 
        }

    }

    public function nota($id){
        $jualModel = new JualModel();
        $jualDetailModel = new jualDetailModel();

        $this->data['data'] = $jualModel->all()->where('jual.id', $id)->get()->getRow();
        $this->data['data_detail'] = $jualDetailModel->all()->where('jual_id', $id)->get()->getResult();

        return view('jual/nota', $this->data);
    }


}
