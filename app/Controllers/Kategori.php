<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new KategoriModel();
    }

    public function index()
    {
        $model = new \App\Models\KategoriModel();

        $keyword = $this->request->getGet('keyword'); // ← ini penting

        if ($keyword) {
            $data['kategori'] = $model->like('nama_kategori', $keyword)->findAll();
        } else {
            $data['kategori'] = $model->findAll();
        }

        return view('kategori/index', $data);
    }

    public function create()
    {
        return view('kategori/create');
    }

    public function store()
    {
        $this->model->save([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori');
    }

    public function edit($id)
    {
        $data['row'] = $this->model->find($id);
        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/kategori');
    }
    public function print()
    {
        $model = new \App\Models\KategoriModel();

        $data['kategori'] = $model->findAll();

        return view('kategori/print', $data);
    }
}
