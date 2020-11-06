<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title></title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Pesanan
                <strong><?= $nomor_pesanan ?></strong>
                <span class="float-right"> <strong>Status:</strong> Pending</span>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">Dari:</h6>
                        <div>
                            <strong>Bita Merchandise</strong>
                        </div>
                        <div>Madalinskiego 8</div>
                        <div>71-101 Szczecin, Poland</div>
                        <div>Email: herlinabita@gmail.com</div>
                        <div>Phone: 081904036201</div>
                    </div>

                    <div class="col-sm-6">
                        <h6 class="mb-3">Kepada:</h6>
                        <div>
                            <strong><?= $dataDiri['nama'] ?></strong>
                        </div>
                        <div><?= $dataDiri['alamat']['provinsi'] . ', ' . $dataDiri['alamat']['kabupaten'] ?></div>
                        <div>
                            <?= $dataDiri['alamat']['kecamatan'] . ', ' . $dataDiri['alamat']['kelurahan'] . ', ' . $dataDiri['alamat']['kodePOS'] ?>
                        </div>
                        <div>Email: <?= $dataDiri['email'] ?></div>
                        <div>Phone: <?= $dataDiri['telp'] ?></div>
                    </div>



                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>ukuran</th>
                                <th>materi</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $order['nama_produk'] ?></td>
                                <td><?= $ukuran ?></td>
                                <td><?= $order['materi'] ?></td>
                                <td><?= $keterangan ?></td>
                                <td><?= $order['jumlah'] ?></td>
                                <td>
                                    <h3>Rp.<?= $total_harga ?></h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <p>Kode Pesanan Anda : <?= $kode_pesanan ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <div class="m-auto">
                            <a href="<?= base_url() ?>/order/konfirmasi?id_pesanan=<?= $id_pesanan ?>"
                                class="btn btn-success">Konfirmasi Pesanan</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>