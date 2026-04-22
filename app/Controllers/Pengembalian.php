<?php

namespace App\Controllers;

use App\Models\PengembalianModel;
use App\Models\PeminjamanModel;

class Pengembalian extends BaseController
{
    protected $pengembalian;

    public function __construct()
    {
        $this->pengembalian = new PengembalianModel();
    }

    // ================= LIST =================
    public function index()
    {
        $model = new PengembalianModel();

        $data['pengembalian'] = $model
            ->join('peminjaman', 'peminjaman.id_peminjaman = pengembalian.id_peminjaman')
            ->findAll();

        return view('pengembalian/index', $data);
    }

    // ================= FORM =================
    public function create()
    {
        $peminjamanModel = new PeminjamanModel();

        $data['peminjaman'] = $peminjamanModel->findAll();

        return view('pengembalian/create', $data);
    }

    // ================= SIMPAN =================
    public function store()
    {
        $this->pengembalian->insert([
            'id_peminjaman' => $this->request->getPost('id_peminjaman'),
            'tanggal_dikembalikan' => $this->request->getPost('tanggal_dikembalikan'),
            'denda' => $this->request->getPost('denda'),
        ]);

        return redirect()->to('/pengembalian')->with('success', 'Data berhasil disimpan');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->pengembalian->delete($id);
        return redirect()->to('/pengembalian');
    }
}
