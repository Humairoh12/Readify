<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\UsersModel;
use App\Models\BukuModel;
use App\Models\KategoriModel;

class Peminjaman extends BaseController
{
    protected $peminjaman;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
    }

    // ================= LIST =================
    public function index()
    {
        $builder = $this->peminjaman
            ->select('peminjaman.*, 
                      anggota.nama AS nama_anggota, 
                      petugas.nama AS nama_petugas, 
                      buku.judul')
            ->join('users AS anggota', 'anggota.id = peminjaman.id_anggota', 'left')
            ->join('users AS petugas', 'petugas.id = peminjaman.id_petugas', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');

        // 🔥 anggota hanya lihat miliknya
        if (session()->get('role') == 'anggota') {
            $builder->where('peminjaman.id_anggota', session()->get('id'));
        }

        $data['peminjaman'] = $builder->findAll();

        return view('peminjaman/index', $data);
    }

    // ================= FORM =================
    public function create()
    {
        $userModel = new UsersModel();
        $bukuModel = new BukuModel();
        $kategoriModel = new KategoriModel();

        $data['anggota'] = $userModel->where('role', 'anggota')->findAll();
        $data['petugas'] = $userModel->where('role', 'petugas')->findAll();
        $data['kategori'] = $kategoriModel->findAll();
        $data['buku'] = $bukuModel->findAll();

        return view('peminjaman/create', $data);
    }

    // ================= SIMPAN =================
    public function store()
    {
        $this->peminjaman->insert([
            'id_anggota' => session()->get('id'),
            'id_petugas' => $this->request->getPost('id_petugas'),
            'id_buku' => $this->request->getPost('id_buku'),
            'tanggal_pinjam' =>  date('Y-m-d'),
            'tanggal_kembali' => date('Y-m-d', strtotime('+7 days')),
            'status' => 'dipinjam'
        ]);

        return redirect()->to('/peminjaman')
            ->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    // ================= DETAIL =================
    public function detail($id)
    {
        $data['peminjaman'] = $this->peminjaman
            ->select('peminjaman.*, 
                      anggota.nama AS nama_anggota, 
                      petugas.nama AS nama_petugas, 
                      buku.judul')
            ->join('users AS anggota', 'anggota.id = peminjaman.id_anggota', 'left')
            ->join('users AS petugas', 'petugas.id = peminjaman.id_petugas', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->where('id_peminjaman', $id)
            ->first();

        return view('peminjaman/detail', $data);
    }

    // ================= KEMBALIKAN =================
    public function kembali($id)
    {
        $this->peminjaman->update($id, [
            'status' => 'dikembalikan'
        ]);

        return redirect()->to('/peminjaman')->with('success', 'Buku dikembalikan');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->peminjaman->delete($id);

        return redirect()->to('/peminjaman')
            ->with('success', 'Data berhasil dihapus');
    }
    public function kirimWA($id)
    {
        $data = $this->peminjaman
            ->select('peminjaman.*, buku.judul, anggota.nama as nama_anggota, petugas.nama as nama_petugas')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('users as anggota', 'anggota.id = peminjaman.id_anggota', 'left')
            ->join('users as petugas', 'petugas.id = peminjaman.id_petugas', 'left')
            ->where('id_peminjaman', $id)
            ->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // 📱 nomor tujuan (sementara hardcode dulu)
        $no = "6281234567890";

        // ✉️ isi pesan
        $pesan = "📚 *INFORMASI PEMINJAMAN BUKU*\n\n";
        $pesan .= "👤 Anggota: " . $data['nama_anggota'] . "\n";
        $pesan .= "📖 Buku: " . $data['judul'] . "\n";
        $pesan .= "📅 Tgl Pinjam: " . $data['tanggal_pinjam'] . "\n";
        $pesan .= "⏳ Jatuh Tempo: " . $data['tanggal_kembali'] . "\n";
        $pesan .= "📌 Status: " . $data['status'] . "\n\n";
        $pesan .= "Terima kasih 🙏";

        $pesan = urlencode($pesan);

        return redirect()->to("https://wa.me/$no?text=$pesan");
    }
}
