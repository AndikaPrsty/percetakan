<?= $this->extend('templates/template') ?>

<?= $this->section('content') ?>
<!-- Services-->
<section class="page-section" id="services">
    <!-- Portfolio-->
    <div id="portfolio">
        <div class="container-fluid p-0">
            <h2 class="text-center mt-0">Produk - <span id="kategori-label">Nota</span></h2>
            <hr class="divider my-4" />
            <div class="row no-gutters" id="produk-container">
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script src="/js/produk.js"></script>
<?= $this->endSection() ?>