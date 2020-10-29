<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Produk extends BaseController
{
    public function set_view($path)
    {
        return view('admin/produk/' . $path);
    }
    public function index()
    {
        return $this->set_view('index');
    }
    public function tambah()
    {
        return $this->set_view('tambah');
    }
    public function edit()
    {
        return $this->set_view('edit');
    }


    //--------------------------------------------------------------------

}