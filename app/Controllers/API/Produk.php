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
    public function delete_image()
    {
        $id = $this->request->getGet('id_image');
        $gambar = new \App\Models\Gambar;
        $fileName = $gambar->where('id', $id)->get()->getResult()[0]->gambar;
        if (count($gambar->where('id', $id)->get()->getResult()) === 0) {
            $data = [
                'msg' => 'ID gambar tidak valid',
                'isDeleted' => false
            ];
            return $this->respond($data);
        } else {
            unlink(FCPATH . './image/produk/' . $fileName);
            $gambar->where('id', $id)->delete();
            if (count($gambar->where('id', $id)->get()->getResult()) === 0) {
                $data = [
                    'msg' => 'Gambar terhapus',
                    'isDeleted' => true,
                ];
                return $this->respond($data);
            } else {
                $data = [
                    'msg' => 'Gambar tidak terhapus',
                    'isDeleted' => false,
                    'filename' => $fileName
                ];
                return $this->respond($data);
            }
        }
    }
    public function delete($id = null)
    {
        $ukuran = new \App\Models\Ukuran;
        $harga = new \App\Models\Harga;
        $gambar = new \App\Models\Gambar;

        $id = $this->request->getGet('id');
        $deleteGambar = $gambar->where('id_produk', $id)->get()->getResult();
        foreach ($deleteGambar as $gmbr) {
            unlink(FCPATH . './image/produk/' . $gmbr->gambar);
        }
        if ($this->model->delete($id)) {
            $ukuran->where('id_produk', $id)->delete();
            $harga->where('id_produk', $id)->delete();
            $gambar->where('id_produk', $id)->delete();
            $data = [
                'msg' => 'data berhasil dihapus',
                'isDeleted' => true
            ];
            return $this->respond($data);
        } else {
            $data = [
                'msg' => 'data gagal dihapus',
                'isDeleted' => false
            ];
            return $this->respond($data);
        }
    }

    public function test()
    {
        $gambar = new \App\Models\Gambar;
        $data = $gambar->get()->getResult();
        return $this->respond($data);
    }
}