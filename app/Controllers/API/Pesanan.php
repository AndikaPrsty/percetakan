<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class Pesanan extends ResourceController
{
    protected $modelName = 'App\Models\Pesanan';
    protected $format = 'json';

    public function index()
    {
    }

    public function create()
    {
        $pembeli = new \App\Models\Pembeli;
        $alamat = new \App\Models\Alamat;

        $data = $this->request->getJSON(true);

        $id_pembeli = service('uuid')->uuid4()->toString();
        $id_pesanan = service('uuid')->uuid4()->toString();

        $dataPembeli = [
            'id' => $id_pembeli,
            'nama' => $data['dataDiri']['nama'],
            'email' => $data['dataDiri']['email'],
            'no_telp' => $data['dataDiri']['telp'],
            'no_whatsapp' => $data['dataDiri']['telp'],
            'alamat' => $data['dataDiri']['alamat_lengkap'],
        ];

        $nomor_pesanan = $this->model->selectMax('nomor_pesanan')->get()->getRow()->nomor_pesanan;
        $nomor_pesanan = !$nomor_pesanan ? 'NO.00000' : $nomor_pesanan;
        $nomor_pesanan = (int) substr($nomor_pesanan, 3, 4);
        $nomor_pesanan = $nomor_pesanan + 1;
        $kode = 'NO.';
        $nomor_pesanan = sprintf('%04s', $nomor_pesanan);
        $kode_pesanan = date('dmy') . $nomor_pesanan;
        $nomor_pesanan = $kode . $nomor_pesanan;

        $dataPesanan = [
            'id' => $id_pesanan,
            'id_pembeli' => $id_pembeli,
            'id_produk' => $data['order']['id_produk'],
            'nomor_pesanan' => $nomor_pesanan,
            'kode_pesanan' => $kode_pesanan,
            'ukuran' => $data['order']['ukuran'],
            'materi' => $data['order']['materi'],
            'status' => 'ditampung',
            'tanggal_pesan' => date('d-m-Y')
        ];

        $dataAlamat = [
            'id' => service('uuid')->uuid4()->toString(),
            'id_pesanan' => $id_pesanan,
            'provinsi' => $data['dataDiri']['alamat']['provinsi'],
            'kabupaten' => $data['dataDiri']['alamat']['kabupaten'],
            'kecamatan' => $data['dataDiri']['alamat']['kecamatan'],
            'kelurahan' => $data['dataDiri']['alamat']['kelurahan'],
            'kode_pos' => $data['dataDiri']['alamat']['kodePOS'],
        ];

        $pembeli->insert($dataPembeli);
        $pembeli->errors() ? null : $this->model->insert($dataPesanan);
        $this->model->errors() ? null : $alamat->insert($dataAlamat);

        if (!$this->model->errors() && !$pembeli->errors() && !$alamat->errors()) {
            $dataResponse = [
                ''
            ];
        }

        return $this->respond($dataAlamat);
    }
}