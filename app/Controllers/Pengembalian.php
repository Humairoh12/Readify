<?php

namespace App\Controllers;

use App\Models\PengembalianModel;
use App\Models\PeminjamanModel;
use App\Models\DendaModel;

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
        $model = new \App\Models\PengembalianModel();

        $keyword = $this->request->getGet('keyword');

        $builder = $model;

        if ($keyword) {
            $builder = $builder
                ->like('id_peminjaman', $keyword)
                ->orLike('tanggal_dikembalikan', $keyword)
                ->orLike('denda', $keyword);
        }

        $data['pengembalian'] = $builder->findAll();
        $data['keyword'] = $keyword;

        return view('pengembalian/index', $data);
    }
    // ================= FORM =================
    public function create()
    {
        $peminjamanModel = new PeminjamanModel();

        return view('pengembalian/create', [
            'peminjaman' => $peminjamanModel->findAll()
        ]);
    }

    // ================= SIMPAN =================
    public function store()
    {
        $peminjamanModel = new PeminjamanModel();
        $dendaModel = new DendaModel();

        $id_peminjaman = $this->request->getPost('id_peminjaman');
        $tanggal_kembali = $this->request->getPost('tanggal_dikembalikan');

        $peminjaman = $peminjamanModel->find($id_peminjaman);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $tglHarusKembali = $peminjaman['tanggal_kembali'];

        // 🔥 hitung telat
        $telat = floor((strtotime($tanggal_kembali) - strtotime($tglHarusKembali)) / 86400);
        $telat = max(0, $telat);

        $dendaPerHari = 1000;
        $totalDenda = $telat * $dendaPerHari;

        // 🔥 SIMPAN PENGEMBALIAN + AMBIL ID
        $this->pengembalian->insert([
            'id_peminjaman' => $id_peminjaman,
            'tanggal_dikembalikan' => $tanggal_kembali,
            'denda' => $totalDenda
        ]);

        $id_pengembalian = $this->pengembalian->getInsertID();

        // 🔥 UPDATE STATUS PEMINJAMAN (ENUM FIX)
        $peminjamanModel->update($id_peminjaman, [
            'status' => ($totalDenda > 0) ? 'terlambat' : 'kembali'
        ]);

        // 🔥 SIMPAN KE TABEL DENDA (JIKA TELAT)
        if ($totalDenda > 0) {
            $dendaModel->insert([
                'id_peminjaman' => $id_peminjaman,
                'id_pengembalian' => $id_pengembalian,
                'jumlah_denda' => $totalDenda,
                'status_denda' => 'belum bayar'
            ]);
        }

        return redirect()->to('/pengembalian')
            ->with('success', 'Berhasil dikembalikan');
    }
    public function delete($id)
    {
        // hapus data pengembalian
        $this->pengembalian->delete($id);

        return redirect()->to('/pengembalian')
            ->with('success', 'Data pengembalian berhasil dihapus');
    }
    public function print()
    {
        $model = new \App\Models\PengembalianModel();

        $data['pengembalian'] = $model
            ->select('pengembalian.*')
            ->findAll();

        return view('pengembalian/print', $data);
    }
}
