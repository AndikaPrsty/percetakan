<?= $this->extend('templates/admin-templates') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Produk</li>
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
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form" role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk</label>
                                    <input type="text" id="nama_produk" name="nama_produk" class="form-control"
                                        id="nama_produk">
                                </div>
                                <div class="form-group">
                                    <label for="id_kategori">Kategori</label>
                                    <select class="form-control" id="id_kategori" name="id_kategori" id="id_kategori">
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Gambar</label>
                                            <button type="button" id="btn-img"
                                                class="btn btn-primary btn-sm form-control">Tambah
                                                Gambar</button>
                                        </div>
                                    </div>
                                    <div class="col" id="img-form" style="display: none;">
                                        <div class="form-group">
                                            <label for="">Gambar yang akan diupload:</label>
                                            <div id="img-container">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="form-ukuran">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Nama Ukuran</label>
                                                <input type="text" required="true" name="nama_ukuran"
                                                    class="form-control nama_ukuran">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Ukuran</label>
                                                <input type="text" required="true" name="ukuran"
                                                    class="form-control ukuran">
                                            </div>

                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Harga (Rp)</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control harga">
                                                    <span class="input-group-append">
                                                        <button type="button" id="tambah-ukuran"
                                                            class="btn btn-success btn-flat"><i
                                                                class="fas fa-plus"></i></button>
                                                    </span>
                                                </div>
                                                <span class="badge badge-info float-right mt-1">Klik tombol + untuk
                                                    menambah
                                                    form
                                                    ukuran</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
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
<script src="/js/produk/tambah.js"></script>
<?= $this->endSection() ?>