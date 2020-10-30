<?php

namespace App\Models;

use CodeIgniter\Model;

class Produk extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nama_produk', 'id_kategori', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'id' => 'required',
        'nama_produk' => 'required|min_length[4]|is_unique[produk.nama_produk]',
        'id_kategori' => 'required'
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
        'id_kategori' => [
            'required' => 'ID Kategori Tidak Boleh Kosong'
        ]
    ];
    protected $skipValidation     = false;
    public function getProduk($id = null)
    {
        $produk = new \App\Models\Produk;
        $kategori = new \App\Models\Kategori;
        $gambar = new \App\Models\Gambar;
        $ukuran = new \App\Models\Ukuran;
        $harga = new \App\Models\Harga;

        if ($id) {
            $data = [];
            $data['produk'] = $produk->where('id', $id)->get()->getResultArray()[0];
            $data['kategori'] = $kategori->get()->getResultArray();
            $data['ukuran'] = $ukuran
                ->select('ukuran.id_produk,nama_ukuran,ukuran,harga')
                ->where('ukuran.id_produk', $id)
                ->join('harga', 'ukuran.id = harga.id_ukuran')
                ->get()
                ->getResultArray();

            $data['harga'] = $harga->where('id_produk', $id)
                ->get()->getResultArray();

            $data['gambar'] = $gambar->where('id_produk', $id)
                ->get()
                ->getResultArray();

            return $data;
        } else {
            $data = $produk
                ->select('produk.id,nama_produk,id_kategori,nama_kategori')
                ->join('kategori', 'kategori.id = id_kategori')
                ->get()->getResultArray();
            return $data;
        }
    }
}