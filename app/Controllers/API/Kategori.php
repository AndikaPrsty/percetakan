<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class Kategori extends ResourceController
{
    protected $modelName = 'App\Models\Kategori';
    protected $format = 'json';

    public function index()
    {
        $id = $this->request->getGet('id');

        if ($id) {
            $data['kategori'] = $this->model->where('id', $id)->get()->getResult();
            return $this->respond($data);
        } else {
            $data = $this->model->getKategori();
            return $this->respond($data);
        }
    }
    public function create()
    {
        $data = $this->request->getJSON(true);
        $uuid = service('uuid')->uuid4()->toString();
        $data['id'] = $uuid;

        $this->model->insert($data);
        if ($this->model->errors()) {
            $data['errors'] = $this->model->errors();
            $data['isValid'] = false;
            return $this->respond($data);
        } else {
            $data['isValid'] = true;
            return $this->respond($data);
        }
    }
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        $this->model->update($data['id'], $data);

        if ($this->model->errors()) {
            $data['errors'] = $this->model->errors();
            $data['isValid'] = false;
            return $this->respond($data);
        } else {
            $data['isValid'] = true;
            return $this->respond($data);
        }
        return $this->respond($data);
    }
}