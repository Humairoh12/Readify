<?php

namespace App\Controllers;

use App\Models\PenulisModel;

class Penulis extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new PenulisModel();
    }

    // 🔹 TAMPIL DATA
    public function index()
    {
        $model = new \App\Models\PenulisModel();

        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $data['penulis'] = $model->like('nama_penulis', $keyword)->findAll();
        } else {
            $data['penulis'] = $model->findAll();
        }

        return view('penulis/index', $data);
    }

    // 🔹 FORM TAMBAH
    public function create()
    {
        return view('penulis/create');
    }

    // 🔹 SIMPAN
    public function store()
    {
        $this->model->save([
            'nama_penulis' => $this->request->getPost('nama_penulis')
        ]);

        return redirect()->to('/penulis')->with('success', 'Penulis berhasil ditambahkan');
    }

    // 🔹 EDIT
    public function edit($id)
    {
        $data['row'] = $this->model->find($id);
        return view('penulis/edit', $data);
    }

    // 🔹 UPDATE
    public function update($id)
    {
        $this->model->update($id, [
            'nama_penulis' => $this->request->getPost('nama_penulis')
        ]);

        return redirect()->to('/penulis')->with('success', 'Penulis berhasil diupdate');
    }

    // 🔹 DELETE
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/penulis')->with('success', 'Penulis berhasil dihapus');
    }
    public function print()
    {
        $model = new \App\Models\PenulisModel();

        $data['penulis'] = $model->findAll();

        return view('penulis/print', $data);
    }
}
