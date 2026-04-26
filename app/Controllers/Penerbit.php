<?php

namespace App\Controllers;

use App\Models\PenerbitModel;

class Penerbit extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PenerbitModel();
    }

    // 🔹 TAMPIL DATA
    public function index()
    {
        $model = new \App\Models\PenerbitModel();

        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['penerbit'] = $model->like('nama_penerbit', $keyword)->findAll();
        } else {
            $data['penerbit'] = $model->findAll();
        }

        return view('penerbit/index', $data);
    }

    // 🔹 FORM TAMBAH
    public function create()
    {
        return view('penerbit/create');
    }

    // 🔹 SIMPAN
    public function store()
    {
        $this->model->save([
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat'        => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/penerbit')->with('success', 'Penerbit berhasil ditambahkan');
    }

    // 🔹 EDIT
    public function edit($id)
    {
        $data['row'] = $this->model->find($id);
        return view('penerbit/edit', $data);
    }

    // 🔹 UPDATE
    public function update($id)
    {
        $this->model->update($id, [
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat'        => $this->request->getPost('alamat')
        ]);

        return redirect()->to('/penerbit')->with('success', 'Penerbit berhasil diupdate');
    }

    // 🔹 DELETE
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/penerbit')->with('success', 'Penerbit berhasil dihapus');
    }
    public function print()
    {
        $model = new \App\Models\PenerbitModel();

        $data['penerbit'] = $model->findAll();

        return view('penerbit/print', $data);
    }
}
