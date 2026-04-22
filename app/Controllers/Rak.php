<?php

namespace App\Controllers;

use App\Models\RakModel;

class Rak extends BaseController
{
    protected $rak;

    public function __construct()
    {
        $this->rak = new RakModel();
    }

    // ================= LIST =================
    public function index()
    {
        $model = new \App\Models\RakModel();

        $data['rak'] = $model->findAll(); // 🔥 kirim ke view

        return view('rak/index', $data);
    }

    // ================= CREATE =================
    public function create()
    {
        return view('rak/create');
    }

    public function store()
    {
        $this->rak->save([
            'nama_rak' => $this->request->getPost('nama_rak'),
            'lokasi'   => $this->request->getPost('lokasi'),
        ]);

        return redirect()->to('/rak')->with('success', 'Data rak berhasil ditambahkan!');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $model = new \App\Models\RakModel();

        $data['row'] = $model->find($id);

        return view('rak/edit', $data);
    }

    public function update($id)
    {
        $model = new \App\Models\RakModel();

        $model->update($id, [
            'nama_rak' => $this->request->getPost('nama_rak'),
            'lokasi'   => $this->request->getPost('lokasi')
        ]);

        return redirect()->to('/rak')->with('success', 'Berhasil update');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $model = new \App\Models\RakModel();

        // DEBUG (cek apakah masuk sini)
        // dd($id);

        if (!$id) {
            return redirect()->to('/rak')->with('error', 'ID kosong');
        }

        $model->delete($id);

        return redirect()->to('/rak')->with('success', 'Data berhasil dihapus');
    }
    // ================= DETAIL =================
    public function detail($id)
    {
        $data['rak'] = $this->rak->find($id);
        return view('rak/detail', $data);
    }
}
