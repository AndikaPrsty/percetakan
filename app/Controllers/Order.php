<?php

namespace App\Controllers;

class Order extends BaseController
{
    public function index()
    {
        return view('order/index');
    }
    public function paperbag()
    {
        return view('order/paperbag-pastik');
    }
    public function plastik()
    {
        return view('order/paperbag-plastik');
    }
}