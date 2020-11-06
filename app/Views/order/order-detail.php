<?= $this->extend('templates/order-info') ?>


<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="invoice p-3 mb-3">
                <div class="row invoice-info">
                    <div class="col-sm-4 col-lg-12 invoice-col">
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
                                    <th>keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="tabel-pesanan">
                                <tr>
                                    <td id="jumlah"></td>
                                    <td id="nama_produk"></td>
                                    <td id="ukuran"></td>
                                    <td id="keterangan"></td>
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
                                <a href="" download class="btn-link text-secondary"><i class="fas fa-file"></i>
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
                                    <th>Total:</th>
                                    <td id="total"></td>
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
                        <button type="button" id="terima" class="btn btn-success float-right">Bayar Lunas
                        </button>
                        <button id="tolak" type="button" class="btn btn-info float-right" style="margin-right: 5px;">DP
                            50%
                        </button>
                    </div>
                </div>
            </div>
        </div>
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