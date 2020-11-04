<?php

namespace App\Models;

use CodeIgniter\Model;

class Alamat extends Model
{
    protected $table      = 'alamat';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'id_pesanan', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'kode_pos'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'required',
        'id_pesanan' => 'required',
        'provinsi' => 'required',
        'kabupaten' => 'required',
        'kecamatan' => 'required',
        'kelurahan' => 'required',
        'kode_pos' => 'required',
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'ID Tidak Boleh Kosong'
        ],
        'id_pesanan' => [
            'required' => 'ID Pesanan Tidak Boleh Kosong'
        ],
        'provinsi' => [
            'required' => 'Provinsi Harus DIisi'
        ],
        'kabupaten' => [
            'required' => 'Kabupaten Harus DIisi'
        ],
        'kecamatan' => [
            'required' => 'Kecamatan Harus DIisi'
        ],
        'kelurahan' => [
            'required' => 'Kelurahan Harus DIisi'
        ],
        'kode_pos' => [
            'required' => 'Kode Pos Harus DIisi'
        ],
    ];
    protected $skipValidation     = false;
}