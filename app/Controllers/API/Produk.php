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

        $produkValidation = [
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Tidak Boleh Kosong'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required|min_length[4]|is_unique[produk.nama_produk]',
                'errors' => [
                    'required' => 'Nama Produk Harus Diisi',
                    'min_length' => 'Nama Produk Terlalu Pendek',
                    'is_unique' => 'Produk Yang anda input sudah tersedia di database'
                ],
            ],
            'id_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Kategori Tidak Boleh Kosong'
                ]
            ]
        ];

        $this->model->setValidationRules($produkValidation);

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
            'id_produk' => $this->request->getPost('id_produk'),
            'id_kategori' => $this->request->getPost('id_kategori')
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

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        $ukuran = new \App\Models\Ukuran;
        $harga = new \App\Models\Harga;
        $id_produk = $data['id_produk'];

        $dataProduk = [
            'nama_produk' => $data['nama_produk'],
            'id_kategori' => $data['id_kategori']
        ];
        $dataUkuran = $data['ukuran'];
        $dataHarga = $data['harga'];


        $produkValidation = [
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Tidak Boleh Kosong'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => 'Nama Produk Harus Diisi',
                    'min_length' => 'Nama Produk Terlalu Pendek',
                    'is_unique' => 'Produk Yang anda input sudah tersedia di database'
                ],
            ],
            'id_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Kategori Tidak Boleh Kosong'
                ]
            ]
        ];

        $this->model->setValidationRules($produkValidation);
        $this->model->update($id_produk, $dataProduk);
        for ($i = 0; $i < count($data['ukuran']); $i++) {
            $ukuran->update($dataUkuran[$i]['id'], $dataUkuran[$i]);
            $harga->update($dataHarga[$i]['id'], $dataHarga[$i]);
        }
        if (!$this->model->errors() && !$ukuran->errors() && !$harga->errors()) {
            $data['isValid'] = true;
            return $this->respond($data);
        } else {
            $data['isValid'] = false;
            $data['errors'] = [];
            $this->model->errors() ? $data['errors'] += $this->model->errors() : null;
            $harga->errors() ?  $data['errors'] += $harga->errors() : false;
            $ukuran->errors() ? $data['errors'] += $ukuran->errors() : false;

            return $this->respond($data);
        }
        return $this->respond($data);
    }

    public function ukuran_harga()
    {
        $data = $this->request->getJSON(true);
        $ukuran = new \App\Models\Ukuran;
        $harga = new \App\Models\Harga;
        $id_produk = $data['id_produk'];

        foreach ($data['ukuran'] as $uk) {
            $idUkuran = service('uuid')->uuid4()->toString();
            $dataUkuran = [
                'id' => $idUkuran,
                'id_produk' => $id_produk,
                'nama_ukuran' => $uk['nama_ukuran'],
                'ukuran' => $uk['ukuran'],
                'id_kategori' => $data['id_kategori']
            ];
            $dataHarga = [
                'id' => service('uuid')->uuid4()->toString(),
                'id_produk' => $id_produk,
                'id_ukuran' => $idUkuran,
                'harga' => $uk['harga']
            ];
            $ukuran->insert($dataUkuran);
            $harga->insert($dataHarga);
        }
        if (!$ukuran->errors() && !$harga->errors()) {
            $data['isValid'] = true;
            return $this->respond($data);
        } else {
            $data['isValid'] = false;
            $data['errors'] = [];
            $harga->errors() ? $data['errors'] += $harga->errors() : null;
            $ukuran->errors() ? $data['errors'] += $ukuran->errors() : null;

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