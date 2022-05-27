<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>
<form action="/reservasi/simpan" method="POST">
<div class="form-group">
    <label for="coloum-nik">NIK</label>
    <input type="text" class="form-control" name="nik" id="coloum-nik" placeholder="Masukkan NIK">
</div>
<div class="form-group">
    <label for="coloum-nama">Nama Pemesan</label>
    <input type="text" class="form-control" name="nama_pemesan" id="coloum-nama" placeholder="Masukkan Nama Pemesan">
</div>
<div class="form-group">
    <label for="coloum-nik">Cek In</label>
    <input type="date" class="form-control" name="cekin" id="coloum-cekin">
</div>
<div class="form-group">
    <label for="coloum-nik">Cek Out</label>
    <input type="date" class="form-control" name="cekout" id="coloum-cekout">
</div>
<div class="coloum-pilihkamar">Pilih Kamar</label>
<select multiple class="form-control" name="pilihkamar[]" id="coloum-pilihkamar">
    <?php foreach ($kamar as $row) : ?>
        <option value="<?= $row['id_kamar'] ?>"><?= $row['nomor_kamar'] ?> </option>
        <?php endforeach ?>
</select>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
<?= $this->endSection() ?>