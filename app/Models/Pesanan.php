<?php

namespace App\Models;

use CodeIgniter\Model;

class Pesanan extends Model
{
    protected $table      = 'pesanan';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'id_pembeli', 'id_produk', 'nomor_pesanan', 'kode_pesanan', 'id_ukuran', 'materi', 'status', 'tanggal_pesan', 'keterangan', 'jumlah', 'total_harga'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'required',
        'id_pembeli' => 'required',
        'id_produk' => 'required',
        'nomor_pesanan' => 'required',
        'id_ukuran' => 'required',
        'total_harga' => 'required',
        'jumlah' => 'required'
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
        'id_ukuran' => [
            'required' => 'Ukuran Tidak Boleh Kosong'
        ],
        'tanggal_pesan' => [
            'required' => 'Tanggal Pesan Tidak Boleh Kosong'
        ],
    ];
    protected $skipValidation     = false;

    public function getPesanan($id = null)
    {
        $pesanan = new \App\Models\Pesanan;
        $ukuran = new \App\Models\Ukuran;
        $alamat = new  \App\Models\Alamat;
        $produk = new \App\Models\Produk;
        $pembeli = new \App\Models\Pembeli;
        $log = new \App\Models\LogPesanan;
        $data = [];

        if ($id) {
            $data = $pesanan->where('id', $id)->get()->getResultArray();
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['ukuran'] = $ukuran->where('id', $data[$i]['id_ukuran'])->get()->getResultArray();
                $data[$i]['pembeli'] = $pembeli->where('id', $data[$i]['id_pembeli'])->get()->getResultArray();
                $data[$i]['produk'] = $produk->where('id', $data[$i]['id_produk'])->get()->getResultArray();
                $data[$i]['alamat'] = $alamat->where('id_pesanan', $data[$i]['id'])->get()->getResultArray();
                $data[$i]['log'] = $log->where('id_pesanan', $data[$i]['id'])->orderBy('created_at', 'ASC')->get()->getResult();
            }
            return $data;
        } else {
            $data = $pesanan->where('status', 'terkonfirmasi')->get()->getResultArray();
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['ukuran'] = $ukuran->where('id', $data[$i]['id_ukuran'])->get()->getResultArray();
                $data[$i]['pembeli'] = $pembeli->where('id', $data[$i]['id_pembeli'])->get()->getResultArray();
                $data[$i]['produk'] = $produk->where('id', $data[$i]['id_produk'])->get()->getResultArray();
                $data[$i]['alamat'] = $alamat->where('id_pesanan', $data[$i]['id'])->get()->getResultArray();
            }
            return $data;
        }
    }
}