<?php

namespace App\Controllers;

use App\Models\JualModel;
use App\Models\BeliModel;
use App\Models\KategoriModel;
use App\Models\ProdukModel;
use App\Models\SatuanModel;
use App\Models\PelangganModel;
use App\Models\AdminModel;

class Home extends BaseController
{
    public function __construct()
    {
         $this->data['menu'] = 'home';
    }

    public function index()
    {
        $jualModel = new JualModel();
        $beliModel = new BeliModel();
        $kategoriModel = new KategoriModel();
        $produkModel = new ProdukModel();
        $satuanModel = new SatuanModel();
        $pelangganModel = new PelangganModel();
        $adminModel = new AdminModel();

        $this->data['count_jual'] = $jualModel->all()->countAllResults();
        $this->data['count_beli'] = $beliModel->all()->countAllResults();
        $this->data['count_kategori'] = $kategoriModel->all()->countAllResults();
        $this->data['count_produk'] = $produkModel->all()->countAllResults();
        $this->data['count_satuan'] = $satuanModel->all()->countAllResults();
        $this->data['count_admin'] = $adminModel->all()->countAllResults();

        return view('home', $this->data);
    }
}
