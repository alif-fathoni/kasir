<?php

namespace App\Models;

use CodeIgniter\Model;

class JualDetailModel extends Model
{

    protected $table = 'jual_detail';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'jual_id',
        'produk_id',
        'harga',
        'jumlah',
        'satuan_id',
        'input_waktu',
        'input_admin_id'
    ];

    public function all(){

        $query = $this->table($this->table);
        $query->select(' jual_detail.*, produk.nama as "nama_produk", produk.code as "code_produk", satuan.nama as "nama_satuan", kategori.nama as "nama_kategori" ');
        $query->join('satuan', 'satuan.id=jual_detail.satuan_id', 'left');
        $query->join('produk', 'produk.id=jual_detail.produk_id', 'left');
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

    public function removeByJual($jualID){

       return $this->table($this->table)->where('jual_id',$jualID)->delete();
    }

}
