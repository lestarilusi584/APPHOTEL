<?= $this->include('Layout/Header');?>
<!-- Awal Konten Aplikasi -->
<main role="main" class="fiex-shrink-0">
    <div class="container">
        <?= $this->renderSection('content') ?>
</div>
</main>
<?=$this->include('Layout/Footer');?>

