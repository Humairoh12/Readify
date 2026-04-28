<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .profil-wrapper {
        max-width: 600px;
        margin: auto;
    }

    .profil-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .profil-title {
        font-weight: 600;
        margin-bottom: 20px;
        color: #3b4a6b;
        text-align: center;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 5px;
        color: #555;
    }

    .form-control {
        border-radius: 12px;
        padding: 10px;
        border: 1px solid #ddd;
        background: #f9fbff;
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: #a1c4fd;
        box-shadow: 0 0 6px rgba(161, 196, 253, 0.5);
    }

    textarea.form-control {
        resize: none;
    }

    .btn-simpan {
        width: 100%;
        border-radius: 12px;
        padding: 10px;
        background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
        border: none;
        color: #2f3e55;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-simpan:hover {
        transform: scale(1.02);
        background: linear-gradient(135deg, #90b4f8, #b5defa);
    }
</style>

<div class="profil-wrapper">

    <div class="profil-card">

        <h4 class="profil-title">👤 Lengkapi Profil Anggota</h4>

        <form action="<?= base_url('anggota/updateProfil') ?>" method="post">

            <!-- NISN -->
            <div class="mb-3">
                <label class="form-label">NISN</label>
                <input type="text" name="nisn" class="form-control"
                    value="<?= $anggota['nisn'] ?? '' ?>" placeholder="Masukkan NISN">
            </div>

            <!-- ALAMAT -->
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3"
                    placeholder="Masukkan alamat"><?= $anggota['alamat'] ?? '' ?></textarea>
            </div>

            <!-- NO HP -->
            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control"
                    value="<?= $anggota['no_hp'] ?? '' ?>" placeholder="08xxxxxxxxxx">
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn btn-simpan">
                💾 Simpan Profil
            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>