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
        $search = $this->request->getGet('search') ?? $this->request->getGet('keyword');

        $builder = $this->dendaModel
            ->select('denda.*, 
                  peminjaman.id_peminjaman, 
                  anggota.nama as nama_anggota, 
                  petugas.nama as nama_petugas_verif')
            ->join('peminjaman', 'peminjaman.id_peminjaman = denda.id_peminjaman', 'left')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('users as petugas', 'petugas.id = denda.id_petugas_verif', 'left');

        if (!empty($search)) {
            $builder->groupStart()
                ->like('anggota.nama', $search)
                ->orLike('peminjaman.id_peminjaman', $search)
                ->orLike('denda.status_denda', $search)
                ->groupEnd();
        }

        $data['denda'] = $builder->findAll();

        // DEBUG TEMP
        // dd($data['denda']);

        return view('denda/index', $data);
    }

    public function bayar($id)
    {
        $metode = $this->request->getPost('metode_pembayaran');
        $file = $this->request->getFile('bukti_pembayaran');

        $namaFile = null;

        if ($metode == 'qris') {
            if (!$file || !$file->isValid()) {
                return redirect()->back()->with('error', 'QRIS wajib upload bukti');
            }

            $namaFile = $file->getRandomName();
            $file->move('uploads/bukti/', $namaFile);
        }

        $this->dendaModel->update($id, [
            'metode_pembayaran' => $metode,
            'bukti_pembayaran' => $namaFile,
            'status_denda' => 'menunggu verifikasi'
        ]);

        return redirect()->to('/denda');
    }

    public function verifikasi($id)
    {
        $this->dendaModel->update($id, [
            'status_denda' => 'lunas',
            'id_petugas_verif' => session()->get('id'),
            'tanggal_verifikasi' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/denda');
    }

    public function hapus($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->back()->with('error', 'Tidak punya akses');
        }

        $this->dendaModel->delete($id);

        return redirect()->to('/denda')->with('success', 'Data berhasil dihapus');
    }

    public function print()
    {
        $model = new DendaModel();

        $data['denda'] = $model
            ->select('denda.*, peminjaman.id_peminjaman, anggota.nama as nama_anggota')
            ->join('peminjaman', 'peminjaman.id_peminjaman = denda.id_peminjaman', 'left')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->findAll();

        return view('denda/print', $data);
    }
}
