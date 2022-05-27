<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>
<h2>Penambahan Kamar</h2>
<p>Silahkan masukan data Kamar baru pada form dibawah ini</p>
<form method="POST" action="/kamar/updatefoto" enctype="multipart/form-data">
    <div class="form-group">
        <label class="font-weight-bold">Nomor Kamar</label>
        <input type="text" name="txtNoKamar" class="form-control" placeholder="Masukan nomor kamar, misal : 1A" value="<?= $detailKamar[0]['nomor_kamar']; ?>" readonly>
        <input type="hidden" name="foto" class="form-control" value="<?= $detailKamar[0]['foto']; ?>" readonly>
        <input type="hidden" name="txtId" class="form-control" value="<?= $detailKamar[0]['id_kamar']; ?>" >
    </div>
    <div class="form-group">
        <label class="font-weight-bold"> Foto Kamar</label><br />
        <?php
        if (!empty($detailKamar[0]['foto'])) {
            echo '<img src="' . base_url("/gambar/" . $detailKamar[0]['foto']) . '" width="150">';
        }
        ?>
        <input type="file" name="txtFoto" class="form-control" >
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Update foto</button>
    </div>
</form>
<?= $this->endSection(); ?>