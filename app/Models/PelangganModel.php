<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{

    protected $table = 'pelanggan';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'nama',
        'no_telp',
        'input_waktu',
        'input_admin_id'
    ];

    public function all(){

        $query = $this->table($this->table);
        $query->select(' * ');
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

        $result = $this->all()->where('id', $id)->get()->getRow();
        return $result;
    }

    public function remove($id){

       return $this->table($this->table)->where('id',$id)->delete();
    }

}
