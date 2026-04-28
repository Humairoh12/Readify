<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\AnggotaModel;
use App\Models\PeminjamanModel;

class Home extends BaseController
{
    public function index(): string
    {
        $bukuModel = new BukuModel();
        $anggotaModel = new AnggotaModel();
        $peminjamanModel = new PeminjamanModel();

        // 👉 INI YANG KAMU TANYA (taruh di sini)
        $peminjaman_terbaru = $peminjamanModel
            ->select('peminjaman.*, users.nama, buku.judul')
            ->join('users', 'users.id = peminjaman.id_anggota', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->orderBy('tanggal_pinjam', 'DESC')
            ->findAll(5);

        $data = [
            'total_buku' => $bukuModel->countAll(),
            'total_anggota' => $anggotaModel->countAll(),
            'total_peminjaman' => $peminjamanModel->countAll(),
            'peminjaman_terbaru' => $peminjaman_terbaru // ← kirim ke view
        ];

        return view('layouts/dashboard', $data);
    }
}
