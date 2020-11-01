<?= $this->extend('templates/order-form') ?>


<?= $this->section('content') ?>
<hr class="divider">
<h5 class="h5 text-center bg-pink">Format Order</h5>
<hr class="divider">
<div class="form-group">
    <label for="nama">Ukuran *</label>
    <select name="ukuran" id="ukuran" class="form-control">
        <option value="">pilih ukuran</option>
        <option value="custom">custom</option>
    </select>
</div>
<div class="form-group">
    <label for="warna">Warna *</label>
    <input type="text" name="warna" id="warna" class="form-control">
</div>
<div class="form-group">
    <label for="jumlah">Qty / Jumlah *</label>
    <input type="text" name="jumlah" id="jumlah" class="form-control">
</div>
<div class="form-group">
    <label for="sablon">Sablon Warna *</label>
    <input type="text" name="sablon" id="sablon" class="form-control">
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/js/order/paperbag.js"></script>
<?= $this->endSection() ?>