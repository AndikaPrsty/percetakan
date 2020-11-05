<?php

namespace App\Models;

use CodeIgniter\Model;

class Pesanan extends Model
{
    protected $table      = 'pesanan';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'id_pembeli', 'id_produk', 'nomor_pesanan', 'kode_pesanan', 'ukuran', 'materi', 'status', 'tanggal_pesan', 'keterangan'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'required',
        'id_pembeli' => 'required',
        'id_produk' => 'required',
        'nomor_pesanan' => 'required',
        'ukuran' => 'required',
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'ID Tidak Boleh Kosong'
        ],
        'id_pembeli' => [
            'required' => 'ID Pembeli Tidak Boleh Kosong'
        ],
        'id_produk' => [
            'required' => 'ID Produk Tidak Boleh Kosong'
        ],
        'nomor_pesanan' => [
            'required' => 'Nomor Pesanan Tidak Boleh Kosong'
        ],
        'ukuran' => [
            'required' => 'Ukuran Tidak Boleh Kosong'
        ],
        'tanggal_pesan' => [
            'required' => 'Tanggal Pesan Tidak Boleh Kosong'
        ],
    ];
    protected $skipValidation     = false;
}