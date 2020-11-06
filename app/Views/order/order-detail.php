<?= $this->extend('templates/order-info') ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="timeline" id="timeline">

                <!-- END timeline item -->
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/js/moment-with-locales.js"></script>
<script src="/js/order/detail.js"></script>
<?= $this->endSection() ?>