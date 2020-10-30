<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nama_kategori'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'required',
        'nama_kategori' => 'required',
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'ID Tidak Boleh Kosong'
        ],
        'nama_kategori' => [
            'required' => 'Nama Kategori Harus DIisi'
        ]
    ];
    protected $skipValidation     = false;
}