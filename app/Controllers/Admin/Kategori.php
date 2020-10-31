<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Kategori extends BaseController
{
    public function set_view($path)
    {
        return view('admin/kategori/' . $path);
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