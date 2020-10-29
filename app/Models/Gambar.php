<?php

namespace App\Models;

use CodeIgniter\Model;

class Gambar extends Model
{
    protected $table      = 'gambar';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'id_produk', 'gambar', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'required',
        'id_produk' => 'required',
        'gambar' => 'requried',
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'ID Tidak Boleh Kosong'
        ],

        'id_produk' => [
            'required' => 'ID Produk Tidak Boleh Kosong'
        ],
        'gambar' => [
            'required' => 'Gambar Harus DIisi'
        ]
    ];
    protected $skipValidation     = false;
}