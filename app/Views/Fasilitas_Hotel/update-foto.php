<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>
<h2>Update Foto</h2>
<p>Silahkan upload foto baru</p>
<form method="POST" action="/fasilitas-hotel/update-foto" enctype="multipart/form-data">
    <div class="form-group">
        <label class="font-weight-bold">Nama Fasilitas Hotel</label>
        <input type="text" name="txtnamafasilitas" class="form-control" placeholder="Masukan Nama Fasilitas" value="<?= $detailFasilitasHotel[0]['nama_fasilitas_umum']; ?>" >
        <input type="hidden" name="tfoto" class="form-control" value="<?= $detailFasilitasHotel[0]['foto']; ?>">
    </div>
    <div class="form-group">
        <label class="font-weight-bold"> Foto Fasilitas Hotel</label><br />
        <?php
        if (!empty($detailFasilitasHotel[0]['foto'])) {
            echo '<img src="' . base_url("/gambar/" . $detailFasilitasHotel[0]['foto']) . '" width="150">';
        }
        ?>
        <input type="file" name="txtInputFoto" class="form-control">

    </div>
    <div class="form-group">
        <button class="btn btn-primary">Update Foto Fasilitas</button>
    </div>
</form>
<?= $this->endSection(); ?>