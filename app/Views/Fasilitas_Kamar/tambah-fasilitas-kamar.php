<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>
<h2>Penambahan Data Fasilitas Kamar</h2>
<p>Silakan gunakan form dibawah ini untuk menambahkan data fasilitas kamar baru</p>
<form method="POST" action="/fasilitas-kamar/simpan" enctype="multipart/form-data">
<div class="form-group">
<!-- <label class="font-weight-bold">Id Fasilitas Kamar</label>
<input type="text" name="txtnamafasilitaskamar" class="form-control" placeholder="Masukan Id Fasilitas Kamar" autocomplete="off" autofocus>
</div>

<div class="form-group">
    <label class="font-weight-bold">Id Kamar</label>
    <input type="text" name="txtidKamar" class="form-control" placeholder="Masukan Id Kamar" autocomplete="off">
</div> -->

    <div class="form-group">
        <label class="exampleFormControlTextareal" class="font-weight-bold">Nama Fasilitas Kamar</label>
        <textarea name="txtinputfasilitaskamar" class="form-control rounded-0" id="exampleFormControlTextareal">
        </textarea>
    </div>

    <div class="form-group">
        <label for="tipe_kamar" > Pilih Tipe Kamar</label>
        <select class="form-control" id="tipe_kamar" name="txtinputtipekamar">
            <?php foreach ($tipe_kamar as $key => $value) : ?>
                <option value="<?= $value['id_tipe_kamar']; ?>"><?= $value['tipe_kamar']?></option>
    <?php endforeach; ?>
            </select>
    <div class="form-group">
        <button class="btn btn-primary">Simpan Fasilitas Kamar</button>
    </div>
</div>
</form>
<?= $this->endSection() ?>