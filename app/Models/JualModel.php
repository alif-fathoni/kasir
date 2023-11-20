<?php

namespace App\Models;

use CodeIgniter\Model;

class JualModel extends Model
{

    protected $table = 'jual';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'nota',
        'tanggal',
        'deskripsi',
        'pelanggan_id',
        'pelanggan_nama',
        'pelanggan_no_telp',
        'input_waktu',
        'input_admin_id'
    ];

    public function all(){

        $query = $this->table($this->table);
        $query->select(' jual.*, SUM(jual_detail.harga*jual_detail.jumlah) as "total" ');
        $query->join('jual_detail', 'jual_detail.jual_id=jual.id');
        $query->orderBy('input_waktu', 'desc');
        $query->groupBy('jual.id');
        return $query;
    }

    public function setNota(){

        $query = $this->table($this->table);
        $query->select(' COUNT(*) as "count_jual" ');
        $query->where(' MONTH(tanggal) ', date('m'));
        $query->where(' YEAR(tanggal) ', date('Y'));
        $result = $query->get()->getResult();

        return @$result[0];

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

        $result = $this->all()->where('id', $id)->get()->getRow();
        return $result;
    }

    public function remove($id){

       return $this->table($this->table)->where('id',$id)->delete();
    }

}
