<?php

namespace App\Models;

use CodeIgniter\Model;

class Produk extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nama_produk', 'id_kategori'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    protected $skipValidation     = false;
    public function getProduk($id = null)
    {
        $produk = new \App\Models\Produk;
        $kategori = new \App\Models\Kategori;
        $gambar = new \App\Models\Gambar;
        $ukuran = new \App\Models\Ukuran;
        $harga = new \App\Models\Harga;

        if ($id) {
            if (count($produk->where('id', $id)->get()->getResult()) === 0) {
                return $data = [
                    'msg' => 'Data Produk Tidak Ditemukan',
                    'isValid' => false
                ];
            }
            $data = [];
            $data['produk'] = $produk->where('id', $id)->get()->getResultArray()[0];
            $data['kategori'] = $kategori->get()->getResultArray();
            $data['ukuran'] = $ukuran
                ->select('ukuran.id,ukuran.id_produk,nama_ukuran,ukuran,harga')
                ->where('ukuran.id_produk', $id)
                ->join('harga', 'ukuran.id = harga.id_ukuran')
                ->get()
                ->getResultArray();

            $data['harga'] = $harga->where('id_produk', $id)
                ->get()->getResultArray();

            $data['gambar'] = $gambar->where('id_produk', $id)
                ->get()
                ->getResultArray();

            $data['isValid'] = true;

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