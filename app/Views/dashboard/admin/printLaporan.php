<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="<?= base_url() ?>/css/sb-admin-2.min.css" rel="stylesheet" />
  </head>
  <body style="word-break: break-all">
    <div class="mx-5 my-5">
      <div class="row mb-3">
        <div class="col-6 text-center">
          <h5>Pemasukan</h5>
        </div>
        <div class="col-6 text-center">
          <h5>Pengeluaran</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <table class="table table-bordered">
            <thead>
              <tr class="thead-dark">
                <th scope="col">No</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <?php $jumlah=0;$no=1;foreach($transaksi as $i): if($i['status_code'] == 200): ?>
              <tr>
                <td><?= $no ?></td>
                <td style="max-width: 200px !important">
                  <?= $i['keterangan'] ?>
                </td>
                <td><?= date("m-d-Y", strtotime($i['created_at'])) ?></td>
                <td>Rp.<?= number_format($i['gross_amount']) ?></td>
              </tr>
              <?php $no++;$jumlah+=(int)$i['gross_amount'];endif;endforeach; ?>

              <tr>
                <td colspan="3" class="text-center">Jumlah</td>
                <td>Rp.<?= number_format($jumlah) ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-6">
          <table class="table table-bordered">
            <thead>
              <tr class="thead-dark">
                <th scope="col">No</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <?php $jumlah=0;$no=1;foreach($transaksi as $i): if($i['status_code'] == 199): ?>
              <tr>
                <td><?= $no ?></td>
                <td style="max-width: 200px !important">
                  <?= $i['keterangan'] ?>
                </td>
                <td><?= date("m-d-Y", strtotime($i['created_at'])) ?></td>
                <td>Rp.<?= number_format($i['gross_amount']) ?></td>
              </tr>
              <?php $no++;$jumlah+=(int)$i['gross_amount'];endif;endforeach; ?>
              <tr>
                <td colspan="3" class="text-center">Jumlah</td>
                <td>Rp.<?= number_format($jumlah) ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
  <script src="<?= base_url() ?>/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?= base_url() ?>/js/sb-admin-2.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      print();
    });
  </script>
</html>
