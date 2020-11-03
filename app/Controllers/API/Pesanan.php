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
        $data = $this->request->getJSON(true);
    }
}