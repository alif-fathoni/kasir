<?php

namespace App\Models;

use CodeIgniter\Model;

class BeliDetailModel extends Model
{

    protected $table = 'beli_detail';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'beli_id',
        'produk_id',
        'harga',
        'jumlah',
        'satuan_id',
        'input_waktu',
        'input_admin_id'
    ];

    public function all(){

        $query = $this->table($this->table);
        $query->select(' beli_detail.*, produk.nama as "nama_produk", produk.code as "code_produk", satuan.nama as "nama_satuan", kategori.nama as "nama_kategori" ');
        $query->join('satuan', 'satuan.id=beli_detail.satuan_id', 'left');
        $query->join('produk', 'produk.id=beli_detail.produk_id', 'left');
        $query->join('kategori', 'kategori.id=produk.kategori_id', 'left');
        $query->orderBy('input_waktu', 'desc');
        return $query;
    }


    public function add($data){
        $query = $this->table($this->table);
        $query->insert($data);
        $result = $this->insertID();

        return $result;
    }

    public function addBulk($data){
        $query = $this->table($this->table);
        $result = $query->insertBatch($data);

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

    public function removeByBeli($beliID){

       return $this->table($this->table)->where('beli_id',$beliID)->delete();
    }

}
