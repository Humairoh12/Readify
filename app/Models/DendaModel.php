<?php

namespace App\Models;

use CodeIgniter\Model;

class DendaModel extends Model
{
    protected $table = 'denda';
    protected $primaryKey = 'id_denda';

    protected $allowedFields = [
        'id_pengembalian',
        'jumlah_denda',
        'metode_pembayaran',
        'bukti_pembayaran',
        'id_petugas_verif',
        'tanggal_verifikasi',
        'id_peminjaman',
        'status_denda'
    ];

    // 🔥 AMBIL DATA DENDA + JOIN SEMUA RELASI
    public function getDenda()
    {
        return $this->db->table('denda')
            ->select('
            denda.id_denda,
            denda.id_peminjaman,
            denda.jumlah_denda,
            denda.status_denda,
            denda.metode_pembayaran,
            denda.bukti_pembayaran,

            users.nama as nama_anggota,
            petugas.nama as nama_petugas_verif
        ')
            ->join('peminjaman', 'peminjaman.id_peminjaman = denda.id_peminjaman', 'left')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('users', 'users.id = anggota.user_id', 'left')
            ->join('users as petugas', 'petugas.id = denda.id_petugas_verif', 'left')
            ->get()
            ->getResultArray();
    }
}
