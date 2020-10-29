<?php

namespace App\Models;

use CodeIgniter\Model;

class Produk extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nama_produk', 'id_produk', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'required',
        'nama_produk' => 'required|min_length[4]|is_unique[produk.nama_produk]',
        'id_produk' => 'required'
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'ID Tidak Boleh Kosong'
        ],
        'nama_produk' => [
            'required' => 'Nama Produk Harus Diisi',
            'min_length' => 'Nama Produk Terlalu Pendek',
            'is_unique' => 'Produk Yang anda input sudah tersedia di database'
        ],
        'id_produk' => [
            'required' => 'ID Produk Tidak Boleh Kosong'
        ]
    ];
    protected $skipValidation     = false;
}