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
                            <h3 class="card-title">Detail Produk</h3>
                            <div class="card-tools">
                                <button class="btn btn-warning"><i class="far fa-edit mr-1"></i>Edit</button>
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
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Gambar</label>
                                                    <button type="button" id="btn-img" class="btn btn-primary ">Tambah
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

                                        </div>
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
                                                <tbody>

                                                    <tr>
                                                        <td>Functional-requirements.docx</td>
                                                        <td class="text-right py-0 align-middle">
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="#" class="btn btn-info mr-1"><i
                                                                        class="fas fa-eye"></i></a>
                                                                <a href="#" class="btn btn-danger"><i
                                                                        class="fas fa-trash"></i></a>
                                                            </div>
                                                        </td>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" id="submit" style="display: none;"
                                class="btn btn-primary form-produk-btn">Submit</button>
                            <button type="reset" id="btn-back" class="btn btn-danger form-produk-btn">Kembali</button>
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