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
                buku.judul,
                COALESCE(denda.jumlah_denda, 0) AS denda')
            ->join('users AS anggota', 'anggota.id = peminjaman.id_anggota', 'left')
            ->join('users AS petugas', 'petugas.id = peminjaman.id_petugas', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('denda', 'denda.id_peminjaman = peminjaman.id_peminjaman', 'left');

        if (session()->get('role') == 'anggota') {
            $builder->where('peminjaman.id_anggota', session()->get('id'));
        }

        $data['peminjaman'] = $builder->findAll();

        return view('peminjaman/index', $data);
    }

    // ================= FORM =================
    public function create()
    {
        $anggotaModel = new \App\Models\AnggotaModel();

        $anggota = $anggotaModel
            ->where('user_id', session()->get('id'))
            ->first();

        if (!$anggota || empty($anggota['nisn']) || empty($anggota['alamat']) || empty($anggota['no_hp'])) {
            return redirect()->to('/anggota/profil')
                ->with('error', 'Lengkapi profil dulu!');
        }

        $bukuModel = new BukuModel();
        $kategoriModel = new KategoriModel();
        $userModel = new UsersModel();

        $data = [
            'buku' => $bukuModel->findAll(),
            'kategori' => $kategoriModel->findAll(),
            'petugas' => $userModel->where('role', 'petugas')->findAll()
        ];

        return view('peminjaman/create', $data);
    }

    // ================= SIMPAN =================
    public function store()
    {
        $anggotaModel = new \App\Models\AnggotaModel();

        $anggota = $anggotaModel
            ->where('user_id', session()->get('id'))
            ->first();

        if (!$anggota) {
            return redirect()->to('/anggota/profil')
                ->with('error', 'Lengkapi profil dulu!');
        }

        if (
            empty($anggota['nisn']) ||
            empty($anggota['alamat']) ||
            empty($anggota['no_hp'])
        ) {
            return redirect()->to('/anggota/profil')
                ->with('error', 'Profil belum lengkap!');
        }

        $id_buku = $this->request->getPost('id_buku');

        if (!$id_buku) {
            return redirect()->back()->with('error', 'Pilih minimal 1 buku!');
        }

        if (!is_array($id_buku)) {
            $id_buku = [$id_buku];
        }

        if (count($id_buku) > 2) {
            return redirect()->back()->with('error', 'Maksimal 2 buku!');
        }

        foreach ($id_buku as $buku) {
            $this->peminjaman->insert([
                'id_anggota' => session()->get('id'),
                'id_petugas' => $this->request->getPost('id_petugas'),
                'id_buku' => $buku,
                'tanggal_pinjam' => date('Y-m-d'),
                'tanggal_kembali' => date('Y-m-d', strtotime('+7 days')),
                'status' => 'dipinjam'
            ]);
        }

        return redirect()->to('/peminjaman')
            ->with('success', 'Peminjaman berhasil!');
    }

    // ================= DETAIL =================
    public function detail($id)
    {
        $data['peminjaman'] = $this->peminjaman
            ->select('peminjaman.*, 
                anggota.nama AS nama_anggota, 
                petugas.nama AS nama_petugas, 
                buku.judul,
                COALESCE(denda.jumlah_denda, 0) AS denda')
            ->join('users AS anggota', 'anggota.id = peminjaman.id_anggota', 'left')
            ->join('users AS petugas', 'petugas.id = peminjaman.id_petugas', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('denda', 'denda.id_peminjaman = peminjaman.id_peminjaman', 'left')
            ->where('peminjaman.id_peminjaman', $id)
            ->first();

        return view('peminjaman/detail', $data);
    }

    // ================= KEMBALIKAN =================
    public function kembalikan($id)
    {
        $model = new PeminjamanModel();
        $bukuModel = new BukuModel();
        $dendaModel = new \App\Models\DendaModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $today = date('Y-m-d');

        $telat = (strtotime($today) - strtotime($data['tanggal_kembali'])) / (60 * 60 * 24);
        $telat = max(0, floor($telat));

        $denda = 0;
        $status = 'kembali';

        if ($telat > 0) {
            $denda = $telat * 1000;
            $status = 'terlambat';
        }

        // 🔥 update peminjaman
        $model->update($id, [
            'status' => $status,
            'denda' => $denda,
            'status_bayar' => ($denda > 0 ? 'belum' : 'lunas')
        ]);

        // 🔥 SIMPAN KE TABEL DENDA (INI YANG PENTING)
        if ($denda > 0) {
            $dendaModel->insert([
                'id_peminjaman' => $id,
                'jumlah_denda' => $denda,
                'status_denda' => 'belum bayar'
            ]);
        }

        // update stok buku
        $buku = $bukuModel->find($data['id_buku']);
        $bukuModel->update($data['id_buku'], [
            'tersedia' => $buku['tersedia'] + 1
        ]);

        return redirect()->to('/peminjaman')->with('success', 'Buku dikembalikan');
    }

    // ================= DELETE =================
    public function delete($id)
    {
        $this->peminjaman->delete($id);
        return redirect()->to('/peminjaman')->with('success', 'Data berhasil dihapus');
    }
    public function perpanjang($id)
    {
        $model = new PeminjamanModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if ($data['status'] == 'dikembalikan') {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan');
        }

        if ($data['perpanjang'] >= 2) {
            return redirect()->back()->with('error', 'Maksimal 2x perpanjang');
        }

        $tanggalBaru = date('Y-m-d', strtotime($data['tanggal_kembali'] . ' +3 days'));

        $model->update($id, [
            'tanggal_kembali' => $tanggalBaru,
            'perpanjang' => $data['perpanjang'] + 1
        ]);

        return redirect()->back()->with('success', 'Berhasil diperpanjang');
    }
    public function kirimWA($id)
    {
        $data = $this->peminjaman
            ->select('peminjaman.*, buku.judul, anggota.nama as nama_anggota, petugas.nama as nama_petugas')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('users as anggota', 'anggota.id = peminjaman.id_anggota', 'left')
            ->join('users as petugas', 'petugas.id = peminjaman.id_petugas', 'left')
            ->where('peminjaman.id_peminjaman', $id)
            ->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // 📱 nomor tujuan (ambil dari database kalau ada no_hp)
        $no = "6281234567890"; // nanti bisa diganti $data['no_hp']

        // ✉️ FORMAT PESAN WA
        $pesan = "📚 *INFORMASI PEMINJAMAN BUKU*\n\n";
        $pesan .= "👤 Nama: " . $data['nama_anggota'] . "\n";
        $pesan .= "📖 Buku: " . $data['judul'] . "\n";
        $pesan .= "👮 Petugas: " . $data['nama_petugas'] . "\n";
        $pesan .= "📅 Tgl Pinjam: " . $data['tanggal_pinjam'] . "\n";
        $pesan .= "⏳ Jatuh Tempo: " . $data['tanggal_kembali'] . "\n";
        $pesan .= "📌 Status: " . strtoupper($data['status']) . "\n";

        // 🔥 kalau ada denda
        if (!empty($data['denda']) && $data['denda'] > 0) {
            $pesan .= "💸 Denda: Rp " . number_format($data['denda']) . "\n";
        }

        $pesan .= "\nTerima kasih 🙏";

        // encode
        $url = "https://wa.me/$no?text=" . urlencode($pesan);

        return redirect()->to($url);
    }
    public function print()
    {
        $model = new \App\Models\PeminjamanModel();

        $data['peminjaman'] = $model
            ->select('peminjaman.*,
              anggota.nisn as nama_anggota,
              users.nama as nama_petugas,
              buku.judul,
              denda.jumlah_denda')

            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('petugas', 'petugas.id_petugas = peminjaman.id_petugas', 'left')
            ->join('users', 'users.id = petugas.user_id', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('denda', 'denda.id_peminjaman = peminjaman.id_peminjaman', 'left')

            ->findAll();

        return view('peminjaman/print', $data);
    }
}
