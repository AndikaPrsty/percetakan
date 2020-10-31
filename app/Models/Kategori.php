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
        'nama_kategori' => 'required|is_unique[kategori.nama_kategori]',
    ];
    protected $validationMessages = [
        'id' => [
            'required' => 'ID Tidak Boleh Kosong'
        ],
        'nama_kategori' => [
            'required' => 'Nama Kategori Harus DIisi',
            'is_unique' => 'Gunakan nama kategori yang lain'
        ]
    ];
    protected $skipValidation     = false;

    public function getKategori()
    {
        $kategori = new \App\Models\Kategori;
        $data['kategori'] = $kategori->select('kategori.id,gambar,nama_kategori')->join('gambar', 'gambar.id_kategori = kategori.id', 'left')->groupBy('id_kategori')->get()->getResultArray();
        return $data;
    }
}