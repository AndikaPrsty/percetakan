<?= $this->extend('templates/order-template') ?>

<?= $this->section('order-form') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">FORM ORDER</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="card card-pink">
                        <div class="card-header">
                            <h3 class="card-title" id="title-nama-produk"></h3>
                        </div>
                        <div class="card-body">
                            <form role="form">
                                <div class="row">
                                    <div class="col-lg-4 col-xs-12 col-sm-12">
                                        <hr class="divider">
                                        <h5 class="h5 text-center bg-pink">Data Diri</h5>
                                        <hr class="divider">
                                        <div class="form-group">
                                            <label for="nama">Nama Anda *</label>
                                            <input type="text" name="nama" class="form-control" id="nama"
                                                placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="telp">No Telp / Whatsapp *</label>
                                            <input type="number" name="telp" class="form-control" id="telp"
                                                placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Alamat E-Mail *</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <hr class="divider">
                                        <h5 class="h5 text-center bg-pink">Sample Produk</h5>
                                        <hr class="divider">
                                        <div id="ProdukExample" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators" id="image-indicators">

                                            </ol>
                                            <div class="carousel-inner" id="image-container">

                                            </div>
                                            <a class="carousel-control-prev" href="#ProdukExample" role="button"
                                                data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#ProdukExample" role="button"
                                                data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12 col-xs-12">
                                        <hr class="divider">
                                        <h5 class="h5 text-center bg-pink">Alamat Lengkap</h5>
                                        <hr class="divider">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Provinsi *</label>
                                            <select class="form-control" name="provinsi" id="provinsi">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Kabupaten / Kota *</label>
                                            <select class="form-control" name="kabupaten" id="kabupaten">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Kecamatan *</label>
                                            <select class="form-control" name="kecamatan" id="kecamatan">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Kelurahan *</label>
                                            <select class="form-control" name="kelurahan" id="kelurahan">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Kode POS *</label>
                                            <input type="number" class="form-control" name="kode-pos" id="kode-pos">
                                        </div>

                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <?= $this->renderSection('content') ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/js/order/alamat.js"></script>
<script src="/js/order/order.js"></script>
<?= $this->endSection() ?>