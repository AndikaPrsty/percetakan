<?= $this->extend('templates/admin-templates') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kategori</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
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
                            <h3 class="card-title">Tambah kategori</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="form" role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_kategori">Nama kategori</label>
                                    <input type="text" id="nama_kategori" name="nama_kategori"
                                        class="form-control form-kategori" id="nama_kategori">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" id="submit"
                                    class="btn btn-primary btn-sm form-kategori">Submit</button>
                                <button type="reset" id="btn-back"
                                    class="btn btn-danger btn-sm form-kategori">Kembali</button>
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
<script src="/js/kategori/tambah.js"></script>
<?= $this->endSection() ?>