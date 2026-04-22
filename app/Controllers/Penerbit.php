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
        $data['data'] = $this->model->findAll();
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
}
