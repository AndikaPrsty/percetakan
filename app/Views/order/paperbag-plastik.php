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
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-info"></i>Info!</h5>
    Apakah Anda sudah ada design coreldraw/ai silahkan upload di bawah sini. Jika belum, silahkan isi materi design yang
    diinginkan
</div>
<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" id="no-design" type="radio" name="radio1" checked>
        <label class="form-check-label">Belum ada design</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" id="have-design" type="radio" name="radio1">
        <label class="form-check-label">Sudah punya design</label>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/js/order/paperbag-plastik.js"></script>
<?= $this->endSection() ?>