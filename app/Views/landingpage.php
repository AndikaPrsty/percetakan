<?= $this->extend('templates/template') ?>

<?= $this->section('content') ?>
<div id="portfolio">
    <div class="container-fluid p-0 ">
        <h2 class="text-center pt-2">Produk Kami</h2>
        <hr class="divider my-4" />
        <div class="row no-gutters" id="kategori-container">
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript')  ?>
<script src="/js/home.js"></script>
<?= $this->endSection() ?>