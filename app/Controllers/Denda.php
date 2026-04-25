<?php

namespace App\Controllers;

use App\Models\DendaModel;

class Denda extends BaseController
{
    protected $dendaModel;

    public function __construct()
    {
        $this->dendaModel = new DendaModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $role = session()->get('role');
        $id_user = session()->get('id');

        $builder = $this->dendaModel
            ->select('denda.*, peminjaman.id_peminjaman, anggota.nama as nama_anggota, petugas.nama as nama_petugas_verif')
            ->join('peminjaman', 'peminjaman.id_peminjaman = denda.id_peminjaman', 'left')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('users as petugas', 'petugas.id = denda.id_petugas_verif', 'left');

        // 🔒 filter anggota
        if ($role == 'anggota') {
            $builder->where('peminjaman.id_anggota', $id_user);
        }
        // 🔒 filter anggota
        if ($role == 'anggota') {
            $builder->where('peminjaman.id_anggota', $id_user);
        }

        // 🔍 search
        if ($search) {
            $builder->groupStart()
                ->like('users.nama', $search)
                ->orLike('peminjaman.id_peminjaman', $search)
                ->groupEnd();
        }

        // 🔔 NOTIFIKASI
        $notif = $this->dendaModel
            ->where('status_denda', 'menunggu verifikasi')
            ->countAllResults();

        $data = [
            'denda' => $builder->findAll(),
            'search' => $search,
            'notif' => $notif
        ];

        return view('denda/index', $data);
    }

    public function bayar($id)
    {
        $metode = $this->request->getPost('metode_pembayaran');
        $file = $this->request->getFile('bukti_pembayaran');

        $namaFile = null;

        // ✔ kalau QRIS → wajib file
        if ($metode == 'qris') {
            if (!$file || !$file->isValid()) {
                return redirect()->back()->with('error', 'QRIS wajib upload bukti');
            }

            $namaFile = $file->getRandomName();
            $file->move('uploads/bukti/', $namaFile);
        }

        // ✔ CASH → tidak pakai file
        if ($metode == 'cash') {
            $namaFile = null;
        }

        $this->dendaModel->update($id, [
            'metode_pembayaran' => $metode,
            'bukti_pembayaran' => $namaFile,
            'status_denda' => 'menunggu verifikasi'
        ]);

        return redirect()->to('/denda');
    }
    // VERIFIKASI (ADMIN / PETUGAS)
    // =====================
    public function verifikasi($id)
    {
        $this->dendaModel->update($id, [
            'status_denda' => 'lunas',
            'id_petugas_verif' => session()->get('id'), // HARUS ADA INI
            'tanggal_verifikasi' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/denda');
    }
    public function hapus($id)
    {
        $role = session()->get('role');

        if ($role != 'admin') {
            return redirect()->back()->with('error', 'Tidak punya akses');
        }

        $model = new \App\Models\DendaModel();
        $model->delete($id);

        return redirect()->to('/denda')->with('success', 'Data berhasil dihapus');
    }
}
