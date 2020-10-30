<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class Produk extends ResourceController
{
    protected $modelName = 'App\Models\Produk';
    protected $format = 'json';

    public function index()
    {
        $id = $this->request->getGet('id');
        $id ?  $data = $this->model->getProduk($id) : $data = $this->model->getProduk();
        return $this->respond($data);
    }
    public function create()
    {
        $uuid = service('uuid')->uuid4()->toString();
        $data = $this->request->getJSON(true);
        $data['id'] = $uuid;
        $ukuran = new \App\Models\Ukuran;
        $harga = new \App\Models\Harga;

        $this->model->insert($data);
        foreach ($data['ukuran'] as $uk) {
            $idUkuran = service('uuid')->uuid4()->toString();
            $dataUkuran = [
                'id' => $idUkuran,
                'id_produk' => $uuid,
                'nama_ukuran' => $uk['nama_ukuran'],
                'ukuran' => $uk['ukuran'],
                'id_kategori' => $data['id_kategori']
            ];
            $dataHarga = [
                'id' => service('uuid')->uuid4()->toString(),
                'id_produk' => $uuid,
                'id_ukuran' => $idUkuran,
                'harga' => $uk['harga']
            ];
            !$this->model->errors() ?   $ukuran->insert($dataUkuran) : null;
            !$this->model->errors() ? $harga->insert($dataHarga) : null;
        }
        if (!$this->model->errors() && !$ukuran->errors() && !$harga->errors()) {
            $data['isValid'] = true;
            return $this->respond($data);
        } else {
            $this->model->delete($uuid);
            $ukuran->where('id_produk', $uuid)->delete();
            $harga->where('id_produk', $uuid)->delete();
            $data['isValid'] = false;
            $data['errors'] = [];
            $this->model->errors() ? $data['errors'] += $this->model->errors() : null;
            $harga->errors() ? $data['errors'] += $harga->errors() : null;
            $ukuran->errors() ? $data['errors'] += $ukuran->errors() : null;

            return $this->respond($data);
        }
    }
    public function upload()
    {
        $gambar = new \App\Models\Gambar;
        $uuid = service('uuid')->uuid4()->toString();
        $file = $this->request->getFile('image');
        $file ? $fileName = $this->request->getFile('image')->getRandomName() : $fileName = $this->request->getPost('dummy_image');
        $file ? $file->move(ROOTPATH . '\public\image\produk', $fileName) : null;
        $data = [
            'id' => $uuid,
            'gambar' => $fileName,
            'id_produk' => $this->request->getPost('id_produk')
        ];

        $gambar->insert($data);

        return $this->respond($data);
    }
}