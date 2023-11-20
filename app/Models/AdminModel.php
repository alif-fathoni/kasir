<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{

    protected $table = 'admin';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'nama',
        'username',
        'password',
        'login_waktu',
        'token',
        'role',
        'ijinkan_login',
        'input_waktu',
        'input_admin_id'
    ];

    public function all(){

        $query = $this->table($this->table);
        $query->select(' * ');
        $query->orderBy('input_waktu', 'desc');
        return $query;
    }

    public function login($username, $password){
        $query = $this->table($this->table);
        $query->select('id, password ');
        $query->where('username', $username);
        $admin_data = $query->get()->getRow();

        if (isset($admin_data) && password_verify($password, $admin_data->password)) {
            $result = $this->all();
            $resultData = $result->where("username", $username)->get()->getRow();
            return (array)$resultData;
        }
        return false;
    }

    public function check_password($id_user, $password){

        $query = $this->table($this->table);
        $query->select('id, password ');
        $query->where('id', $id_user);
        $admin_data = $query->get()->getRow();


        if (isset($admin_data) && password_verify($password, $admin_data->password)) {
            $result = $this->all();
            $resultData = $result->where("id", $id_user)->get()->getRow();
            return (array)$resultData;
        }
        return false;
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
