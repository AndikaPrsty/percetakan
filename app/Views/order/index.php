<?= $this->extend('templates/order-info') ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto col-xs-12">
            <?= session()->getFlashdata('info') ?>
            <div class="card card-pink">
                <div class="card-header">
                    <h4 class="h4">Cek Informasi Pesanan Anda</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> Perhatian!</h5>
                        email yang diisi adalah email yang anda gunakan sewaktu anda memesan produk. Untuk kode pesanan
                        sudah tercantum di konfirmasi email
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Kode Pesanan</label>
                            <input type="text" id="kode-pesanan" class="form-control">
                        </div>
                        <button id="submit" type="button" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/js/order/index.js"></script>
<?= $this->endSection() ?>