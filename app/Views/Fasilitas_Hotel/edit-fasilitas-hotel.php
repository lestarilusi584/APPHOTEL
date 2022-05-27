<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>
<h2> Penambahan Hotel </h2>
<p>Silahkan masukan data Hotel baru pada form dibawah ini</p>
<form method="POST" action="/fasilitas-hotel/update" ectype="multipart/form-data">
<div class="form-group">
    <input type="hidden" name="txtid" value="<?= $detailFasilitasHotel[0]['id_fasilitas_umum']; ?> >
    <input type = "hidden name="txtidfasilitas" value="<?= $detailFasilitasHotel[0]['id_fasilitas_umum']; ?>"> 
        <label class="font-weight-bold">Nama Fasilitas Hotel</label>
        <input type="text" name="txtnamafasilitas" class="form-control" placeholder="Masukan nama fasilitas hotel" value="<?= $detailFasilitasHotel[0]['nama_fasilitas_umum']; ?>">
    </div>

    <div class="form-group">
     <input type = "hidden" name="txtidfasilitas" value="<?= $detailFasilitasHotel[0]['id_fasilitas_umum']; ?>"> 
        <label class="font-weight-bold">Deskripsi Fasilitas Hotel</label>
        <input type="text" name="txtInputDeskripsi" class="form-control" placeholder="Masukan deskripsi fasilitas hotel" value="<?= $detailFasilitasHotel[0]['deskripsi']; ?>">
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Update Fasilitas Hotel</button>
    </div>
</form>
<?= $this->endSection(); ?>