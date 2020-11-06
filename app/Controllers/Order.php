<?php

namespace App\Controllers;

class Order extends BaseController
{
    public function index()
    {
        return view('order/index');
    }
    public function order_detail()
    {
        return view('order/order-detail.php');
    }
    public function paperbag()
    {
        return view('order/paperbag-plastik');
    }
    public function plastik()
    {
        return view('order/paperbag-plastik');
    }
    public function detail()
    {
        return view('order/order-detail');
    }
    public function email()
    {
        return view('email/order-info');
    }
    public function konfirmasi()
    {
        $id_pesanan = $this->request->getGet('id_pesanan');
        $pesanan = new \App\Models\Pesanan;
        $log = new \App\Models\LogPesanan;
        $data = [];
        $dataPesanan = $pesanan->where('id', $id_pesanan)->get()->getResult()[0];
        if ($dataPesanan->status === 'pending') {
            $dataLog = [
                'id' => service('uuid')->uuid4()->toString(),
                'id_pesanan' => $id_pesanan,
                'log' => 'Pesanan Dikonfirmasi'
            ];
            $pesanan->where('id', $id_pesanan)->set('status', 'terkonfirmasi')->update();
            $data['isConfirmed'] = true;
            $log->insert($dataLog);
            session()->setFlashdata('info', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            pesanan anda terkonfirmasi, silahkan cek informasi pesanan anda secara berkala
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            return view('order/index');
        } else {
            return view('order/index');
        }
    }
}