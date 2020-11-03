<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembeli extends Model
{
    protected $table      = 'pembeli';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nama', 'email', 'no_telp', 'no_whatsapp', 'alamat'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'required',
        'nama' => 'required',
        'email' => 'required',
        'no_telp' => 'required',
        'no_whatsapp' => 'required',
        'alamat' => 'required',
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'ID Tidak Boleh Kosong'
        ],
        'nama' => [
            'required' => 'Nama Tidak Boleh Kosong'
        ],
        'email' => [
            'required' => 'E-Mail Tidak Boleh Kosong'
        ],
        'no_telp' => [
            'required' => 'Nomor Telpon Tidak Boleh Kosong'
        ],
        'no_whatsapp' => [
            'required' => 'Nomor Whatsapp Tidak Boleh Kosong'
        ],
        'alamat' => [
            'required' => 'Alamat Tidak Boleh Kosong'
        ],
    ];
    protected $skipValidation     = false;
}