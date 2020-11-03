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
<div class="form-group" id="ukuranCustomInput" style="display: none;">
    <label for=" ukuran-custom">Ukuran Custom *</label>
    <input type="text" name="ukuran-custom" id="ukuran-custom" class="form-control">
</div>
<div class="form-group">
    <label for="warna">Warna *</label>
    <input type="text" name="warna" id="warna" class="form-control">
</div>
<div class="form-group">
    <label for="jumlah">Qty / Jumlah *</label>
    <div class="input-group mb-3">
        <input type="number" name="jumlah" id="jumlah" class="form-control">
        <div class="input-group-append">
            <span class="input-group-text">pcs</span>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="sablon">Sablon Warna *</label>
    <input type="text" name="sablon" id="sablon" class="form-control">
</div>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-info"></i>Info!</h5>
    Apakah Anda sudah ada design coreldraw / ai / psd silahkan upload di bawah sini. Jika belum, silahkan isi materi
    design yang
    diinginkan
</div>
<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" id="no-design" type="radio" name="radio1" checked>
        <label class="form-check-label" for="no-design">Belum ada design</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" id="have-design" type="radio" name="radio1">
        <label class="form-check-label" for="have-design">Sudah punya design</label>
    </div>
</div>
<div class="form-group" id="design-input" style="display: none;">
    <label for="design">Upload Design</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" multiple id="design">
            <label class="custom-file-label" id="design-label" for="design">Pilih File</label>
        </div>
    </div>
</div>
<div class="form-group" id="materi-design-input">
    <label>Materi Design</label>
    <textarea class="form-control" name="materi" id="materi" rows="3" placeholder=""></textarea>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/js/order/paperbag-plastik.js"></script>
<?= $this->endSection() ?>