<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view('admin/index');
    }
    public function order_detail()
    {
        return view('admin/order-detail');
    }


    //--------------------------------------------------------------------

}