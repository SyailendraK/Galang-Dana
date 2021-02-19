<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Pelaporan</p></span>

  <!-- baris my profile -->
  <div class="row">
    <div class="col-12">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Filter Waktu</h5>
          <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 offset-1">
              <form class="form-inline" method="get" action="/dashboardAdmin/laporan">
                <input class="form-control mr-sm-2" type="date"  aria-label="Search" name="dateStart">
                <input class="form-control mr-sm-2" type="date"  aria-label="Search" name="dateEnd">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <a href="/dashboardAdmin/printLaporan/<?= $start ?>/<?= $end ?>" class="btn btn-primary my-2 my-sm">Print</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<br>
  <div class="row">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Daftar Pemasukan</h5>
          <!-- <form class="form-inline" method="get" action="/dashboardAdmin/laporan">
            <input class="form-control mr-sm-2  mx-auto" type="date"  aria-label="Search" name="dateStartMasuk">
            <input class="form-control mr-sm-2  mx-auto" type="date"  aria-label="Search" name="dateEndMasuk">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
          </form> -->
          <div class="row">
          <div class="col-12">
          <?php if(session()->getFlashdata('pengajuan')): ?>
            <?= session()->getFlashdata('pengajuan'); ?>
          <?php endif; ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1;foreach($transaksi as $i): if($i['status_code'] == 200):?>
              <tr style="text-transform: capitalize">
                <td><?= $no ?></td>
                <td>Rp.<?= number_format($i['gross_amount']) ?></td>
                <td>
                  <a href="/dashboardAdmin/detailTransaksi/<?= $i['order_id'] ?>" class="badge badge-primary">Detail</a>
                </td>
              </tr>
              <?php $no++;endif;endforeach; ?>
            </tbody>
          </table>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Daftar Pengeluaran</h5>

          <!-- <form class="form-inline" method="get" action="/dashboardAdmin/laporan">
          <input class="form-control mr-sm-2  mx-auto" type="date"  aria-label="Search" name="dateStartKeluar">
            <input class="form-control mr-sm-2  mx-auto" type="date"  aria-label="Search" name="dateEndKeluar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
          </form> -->

          <div class="row">
          <div class="col-12">
          
          <?php if(session()->getFlashdata('bayar')): ?>
            <?= session()->getFlashdata('bayar'); ?>
          <?php endif; ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php $no=1;foreach($transaksi as $i):if($i['status_code'] == 199): ?>
              <tr style="text-transform: capitalize">
                <td><?= $no ?></td>
                <td>Rp.<?= number_format($i['gross_amount']) ?></td>
                <td>
                <a href="/dashboardAdmin/detailTransaksi/<?= $i['order_id'] ?>" class="badge badge-primary">Detail</a>
                </td>
              </tr>
            <?php $no++; endif; endforeach; ?>
            </tbody>
          </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- baris edit profile -->
</div>
<br />
<!-- /.container-fluid -->

<?= $this->endsection() ?>
