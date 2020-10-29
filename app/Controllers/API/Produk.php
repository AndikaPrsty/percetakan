<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class Produk extends ResourceController
{
    protected $modelName = 'App\Models\Produk';
    protected $format = 'json';

    public function index()
    {
        return $this->respond(['data' => 'andika']);
    }
    public function create()
    {
        return $this->respond(['data' => 'created']);
    }
}