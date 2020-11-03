<?php

namespace App\Models;

use CodeIgniter\Model;

class LogPesanan extends Model
{
    protected $table      = 'log_pesanan';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'id_pesanan', 'log'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'required',
        'id_pesanan' => 'required',
        'log' => 'required',
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'ID Tidak Boleh Kosong'
        ],
        'id_pesanan' => [
            'required' => 'ID Pesanan Tidak Boleh Kosong'
        ],
        'log' => [
            'required' => 'Log Pesanan Tidak Boleh Kosong'
        ],

    ];
    protected $skipValidation     = false;
}