<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>
<h2>Penambahan Data Kamar</h2>
<p>Silahkan masukan data Kamar baru pada form dibawah ini</p>
<form method="POST" action="/kamar/update" enctype="multipart/form-data">
<input type="hidden" value="<?=$detailKamar[0]['id_kamar'] ?>" name="txtId">
    <div class="form-group">
        <label class="font-weight-bold">Nomor Kamar</label>
        <input type="text" name="txtNoKamar" class="form-control" placeholder="Masukan nomor kamar, misal : 1A" value="<?= $detailKamar[0]['nomor_kamar']; ?>" readonly>
    </div>
    <div class="form-group">
        <label class="font-weight-bold"> Tipe Kamar</label>
        <select class="form-control" name="txtInputTipeKamar" required>
        <option value="<?=$detailKamar[0]['id_tipe_kamar'];?>"><?=$detailKamar[0]['tipe_kamar'];?></option>
        <?php foreach($tipe_kamar as $row):?>
        <option value="<?php echo $row['id_tipe_kamar'];?>"><?php echo $row['tipe_kamar'];?></option>
        <?php endforeach;?>
        </select>
        
    </div>
    <div class="form-group">
        <label class="font-weight-bold"> Deskripsi Kamar</label>
        <input type="text" name="txtInputDeskripsi" class="form-control" placeholder="Masukan Deskripsi kamar" value="<?= $detailKamar[0]['deskripsi']; ?>">
    </div>
    <div class="form-group">
        <label class="font-weight-bold"> Foto Kamar</label><br />
        <?php
        if (!empty($detailKamar[0]['foto'])) {
            echo '<img src="' . base_url("/gambar/" . $detailKamar[0]['foto']) . '" width="150">';
        }
        ?>
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Update Kamar</button>
    </div>
</form>
<?= $this->endSection(); ?>