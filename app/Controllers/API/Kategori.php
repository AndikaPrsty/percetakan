<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class Kategori extends ResourceController
{
    protected $modelName = 'App\Models\Kategori';
    protected $format = 'json';

    public function index()
    {
        $data = [
            'kategori' => $this->model->findAll()
        ];
        return $this->respond($data);
    }
    public function create()
    {
        return $this->respond(['data' => 'created']);
    }
}