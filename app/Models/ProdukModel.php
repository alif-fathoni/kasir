<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{

    protected $table = 'produk';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'code',
        'nama',
        'jumlah',
        'harga_beli',
        'harga_jual',
        'satuan_id',
        'kategori_id',
        'input_waktu',
        'input_admin_id'
    ];

    public function all(){

        $query = $this->table($this->table);
        $query->select(' produk.*, satuan.nama as "nama_satuan", kategori.nama as "nama_kategori" ');
        $query->join('kategori', 'kategori.id=produk.kategori_id', 'LEFT');
        $query->join('satuan', 'satuan.id=produk.satuan_id');
        $query->orderBy('input_waktu', 'desc');
        return $query;
    }


    public function add($data){
        $query = $this->table($this->table);
        $query->insert($data);
        $result = $this->insertID();

        return $result;
    }

    public function edit($data, $id){

        $query = $this->table($this->table);
        $query->update($id, $data);

        $result = $this->all()->where('produk.id', $id)->get()->getRow();
        return $result;
    }

    public function remove($id){

       return $this->table($this->table)->where('id',$id)->delete();
    }

}
