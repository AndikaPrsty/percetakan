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
        return view('order/paperbag');
    }
}