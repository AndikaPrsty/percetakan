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
                    <div class="card card-pink">
                        <div class="card-header">
                            <h3 class="card-title">Detail Produk</h3>
                            <div class="card-tools">
                                <div class="input-group">
                                    <button class="btn btn-danger mr-1" id="btn-del"><i class="far fa-trash-alt"> Hapus
                                        </i></button>
                                    <button id="edit-produk" class="btn btn-warning"><i
                                            class="far fa-edit mr-1"></i>Edit</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <form id="form" role="form">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" id="nama_produk" name="nama_produk"
                                                class="form-control form-produk old-produk" id="nama_produk">
                                        </div>
                                        <div class="form-group">
                                            <label for="id_kategori">Kategori</label>
                                            <select class="form-control form-produk old-produk" id="id_kategori"
                                                name="id_kategori" id="id_kategori">
                                            </select>
                                        </div>
                                        <div id="form-ukuran">
                                        </div>
                                        <div id="form-ukuran-baru" style="display:none;">
                                            <hr>
                                            <h3 class="h3">tambah ukuran baru</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Nama Ukuran</label>
                                                        <input type="text" required="true" name="nama_ukuran"
                                                            class="form-control nama_ukuran_baru form-produk">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Ukuran</label>
                                                        <input type="text" required="true" name="ukuran"
                                                            class="form-control ukuran_baru form-produk">
                                                    </div>

                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Harga (Rp)</label>
                                                        <div class="input-group">
                                                            <input type="text" name="harga"
                                                                class="form-control harga_baru form-produk">
                                                            <span class="input-group-append">
                                                                <button type="button" id="tambah-ukuran"
                                                                    class="btn btn-success btn-flat"><i
                                                                        class="fas fa-plus"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button id="ukuran_baru_toggle" style="display: none;"
                                            class="btn btn-warning"><i class="fas fa-plus"></i> Tambah
                                            Ukuran</button>
                                        <button id="ukuran_baru_remove" style="display: none;" class="btn btn-danger">
                                            Batal</button>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                                <div class="col-6">
                                    <!-- /.card -->
                                    <h4 class="h4">Daftar Gambar</h4>
                                    <div class="card card-info">
                                        <div class="card-body p-0">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>File Name</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="gambar-container">
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                    <div id="img-add" class="row btn-edit" style="display: none;">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <button type="button" id="btn-img" class="btn btn-primary">Tambah
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
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="reset" id="btn-back" class="btn btn-danger form-produk-btn">Kembali</button>
                            <button type="submit" id="submit" style="display: none;"
                                class="btn btn-success form-produk-btn float-right btn-edit">Simpan Perubahan</button>
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
<script src="/js/produk/edit.js"></script>
<?= $this->endSection() ?>