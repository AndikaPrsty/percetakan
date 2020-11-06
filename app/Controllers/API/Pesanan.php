<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class Pesanan extends ResourceController
{
    protected $modelName = 'App\Models\Pesanan';
    protected $format = 'json';

    public function index()
    {
        $id_pesanan = $this->request->getGet('orderId');
        $data = $id_pesanan ? $this->model->getPesanan($id_pesanan) : $this->model->getPesanan();
        if (count($data) === 0) {
            $data['isValid'] = false;
            return $this->respond($data);
        } else {
            return $this->respond($data);
        }
    }

    public function create()
    {
        $pembeli = new \App\Models\Pembeli;
        $alamat = new \App\Models\Alamat;
        $harga = new \App\Models\Harga;
        $ukuran = new \App\Models\Ukuran;
        $log = new \App\Models\LogPesanan;
        $email = \Config\Services::email();

        $data = $this->request->getJSON(true);

        $keterangan = http_build_query($data['keterangan'], '', ', ');


        $id_pembeli = service('uuid')->uuid4()->toString();
        $id_pesanan = service('uuid')->uuid4()->toString();

        $dataLog = [
            'id' => service('uuid')->uuid4()->toString(),
            'id_pesanan' => $id_pesanan,
            'log' => 'Pesanan Berhasil Dibuat'
        ];

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

        $total_harga = $harga->where('id_ukuran', $data['order']['id_ukuran'])->get()->getResult()[0]->harga;
        $total_harga = $total_harga * $data['order']['jumlah'];

        $dataPesanan = [
            'id' => $id_pesanan,
            'id_pembeli' => $id_pembeli,
            'id_produk' => $data['order']['id_produk'],
            'nomor_pesanan' => $nomor_pesanan,
            'kode_pesanan' => $kode_pesanan,
            'id_ukuran' => $data['order']['id_ukuran'],
            'materi' => $data['order']['materi'],
            'status' => 'pending',
            'jumlah' => $data['order']['jumlah'],
            'tanggal_pesan' => date('Y-m-d'),
            'keterangan' => $keterangan,
            'total_harga' => $total_harga,
            'status_bayar' => 'belum'
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
        $data['nomor_pesanan'] = $nomor_pesanan;
        $data['kode_pesanan'] = $kode_pesanan;
        $data['id_pesanan'] = $id_pesanan;
        $data['ukuran'] = $ukuran->where('id', $data['order']['id_ukuran'])->get()->getResult()[0]->ukuran;
        $data['total_harga'] = $total_harga;
        $data['keterangan'] = $keterangan;

        $email->setTo($data['dataDiri']['email']);
        $email->setSubject('Konfirmasi Pesanan');
        $email->setMessage(view('email/order-info', $data));
        $dataResponse = [];


        $pembeli->insert($dataPembeli);
        $pembeli->errors() ? null : $this->model->insert($dataPesanan);
        $this->model->errors() ? null : $alamat->insert($dataAlamat);

        if (!$this->model->errors() && !$pembeli->errors() && !$alamat->errors()) {
            $log->insert($dataLog);
            if (!$email->send()) {
                return $this->respond($dataResponse['isValid'] = false);
            }
            $dataResponse = [
                'isValid' => true,
            ];
            return $this->respond($dataResponse);
        } else {
            $this->model->where('id_pembeli', $id_pembeli)->delete();
            $pembeli->where('id', $id_pembeli)->delete();
            $alamat->where('id_pesanan', $id_pesanan)->delete();
            $dataResponse = [
                'isValid' => false,
                'errors' => []
            ];
            $this->model->errors ? $dataResponse['errors'] += $this->model->errors() : null;
            $pembeli->errors() ? $dataResponse['errors'] += $pembeli->errors() : null;
            $alamat->errors()  ? $dataResponse['errors'] += $alamat->errors() : null;

            return $this->respond($dataResponse);
        }

        return $this->respond($total_harga);
    }
    public function terima()
    {
        $id_pesanan = $this->request->getGet('orderId');
        $log = new \App\Models\LogPesanan;

        $this->model->where('id', $id_pesanan)->set('status', 'diterima')->update();
        $dataLog = [
            'id' => service('uuid')->uuid4()->toString(),
            'id_pesanan' => $id_pesanan,
            'log' => 'Pesanan Diterima Oleh Admin'
        ];
        $log->insert($dataLog);

        if (!$log->errors() && !$this->model->errors()) {
            $data = [
                'isValid' => true,
            ];
            return $this->respond($data);
        } else {
            $data = [
                'isValid' => false
            ];
            return $this->respond($data);
        }
    }
    public function tolak()
    {
        $id_pesanan = $this->request->getGet('orderId');
        $log = new \App\Models\LogPesanan;

        $this->model->where('id', $id_pesanan)->set('status', 'ditolak')->update();
        $dataLog = [
            'id' => service('uuid')->uuid4()->toString(),
            'id_pesanan' => $id_pesanan,
            'log' => 'Pesanan Ditolak Oleh Admin'
        ];
        $log->insert($dataLog);

        if (!$log->errors() && !$this->model->errors()) {
            $data = [
                'isValid' => true,
            ];
            return $this->respond($data);
        } else {
            $data = [
                'isValid' => false
            ];
            return $this->respond($data);
        }
    }
    public function cek_pesanan()
    {
        $data = $this->request->getJSON(true);
        $pembeli = new \App\Models\Pembeli;

        // return $this->respond($data);


        $kodePesanan = $this->model->where('kode_pesanan', $data['kodePesanan'])->get()->getResult();
        $email = $pembeli->where('email', $data['email'])->get()->getResult();

        if (count($kodePesanan) == 0 && count($email) === 0) {
            $data = [
                'isValid' => false,
            ];
            return $this->respond($data);
        } else {
            $data = [
                'isValid' => true,
                'id_pesanan' => $kodePesanan
            ];
            return $this->respond($data);
        }
    }
}