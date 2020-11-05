<?= $this->extend('templates/admin-templates') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Detail Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">detail pesanan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="card card-pink">
                        <div class="card-header">
                            <h3 class="card-title">Pesanan <span id="nomor-pesanan-label"></span></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        Dari
                                        <address>
                                            <strong><span id="nama">andika</span></strong><br>
                                            <span id="provinsi-kabupaten"></span><br>
                                            <span id="kecamatan-kelurahan-kodepos"></span><br>
                                            Phone: <span id="telp"></span><br>
                                            Email: <span id="email"></span>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                        <b>Nomor Pesanan : <span id="nomor-pesanan"></span></b><br>
                                        <br>
                                        <b>Kode Pesanan:</b> <span id="kode-pesanan"></span><br>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Jumlah</th>
                                                    <th>Produk</th>
                                                    <th>Ukuran</th>
                                                    <th>Warna</th>
                                                    <th>Sablon Warna</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabel-pesanan">
                                                <tr>
                                                    <td>120</td>
                                                    <td>Paperbag</td>
                                                    <td>455-981-221</td>
                                                    <td>red</td>
                                                    <td>blue</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
                                        <p class="lead">Design:</p>
                                        <ul class="list-unstyled" id="design">
                                            <li>
                                                <a href="" download class="btn-link text-secondary"><i
                                                        class="fas fa-file"></i>
                                                    Functional-requirements.docx</a>
                                            </li>
                                        </ul>

                                        <p class="lead">Materi :</p>
                                        <p id="materi"></p>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>$250.30</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>$265.24</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="<?= base_url() ?>/admin" class="btn btn-default">Kembali</a>
                                        <button type="button" class="btn btn-success float-right">Terima Pesanan
                                        </button>
                                        <button type="button" class="btn btn-danger float-right"
                                            style="margin-right: 5px;">Tolak Pesanan
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="/js/admin/order-detail.js"></script>

<?= $this->endSection() ?>