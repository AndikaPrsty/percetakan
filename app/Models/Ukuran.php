<?php

namespace App\Models;

use CodeIgniter\Model;

class Ukuran extends Model
{
    protected $table      = 'ukuran';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'id_produk', 'id_kategori', 'nama_ukuran', 'ukuran', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'required',
        'id_produk' => 'required',
        'id_kategori' => 'required',
        'nama_ukuran' => 'required|min_length[3]',
        'ukuran' => 'required',
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'ID Tidak Boleh Kosong'
        ],
        'nama_ukuran' => [
            'required' => 'Nama Ukuran Harus Diisi',
            'min_length' => 'Nama Ukuran Terlalu Pendek',
        ],
        'id_produk' => [
            'required' => 'ID Produk Tidak Boleh Kosong'
        ],
        'id_kategori' => [
            'required' => 'ID Kategori Tidak Boleh Kosong'
        ],
        'ukuran' => [
            'required' => 'Ukuran Harus Diisi'
        ]
    ];
    protected $skipValidation     = false;
}