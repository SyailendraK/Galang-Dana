<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Kelola Pengajuan</p></span>

  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Daftar Pengajuan</h5>
          <form class="form-inline" method="get" action="/dashboardAdmin/KelolaPengajuan">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search-pengajuan" ">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
          </form>
          <div class="row">
          <div class="col-12" style="overflow-x: scroll;">
          <?php if(session()->getFlashdata('pengajuan')): ?>
            <?= session()->getFlashdata('pengajuan'); ?>
          <?php endif; ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">NIK</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1;foreach($pengajuan as $i):?>
              <tr style="text-transform: capitalize">
                <td><?= $no ?></td>
                <td><?= $i['nama'] ?></td>
                <td><?= $i['nik'] ?></td>
                <td>
                  <a href="/dashboardAdmin/detailPengajuan/<?= $i['id'] ?>" class="badge badge-primary">Detail</a>
                </td>
              </tr>
              <?php $no++;endforeach; ?>
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
          <h5 class="card-title">Pembayaran</h5>

          <form class="form-inline" method="get" action="/dashboardAdmin/KelolaPengajuan">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search-pembayaran">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
          </form>

          <div class="row">
          <div class="col-12" style="overflow-x: scroll;">
          
          <?php if(session()->getFlashdata('bayar')): ?>
            <?= session()->getFlashdata('bayar'); ?>
          <?php endif; ?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">NIK</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php $no=1;foreach($bayar as $i): ?>
              <tr style="text-transform: capitalize">
                <td><?= $no ?></td>
                <td><?= $i['nama'] ?></td>
                <td><?= $i['nik'] ?></td>
                <td>
                  <a href="/dashboardAdmin/detailPembayaran/<?= $i['id'] ?>" class="badge badge-success">Konfirmasi pembayaran</a>
                </td>
              </tr>
            <?php endforeach; ?>
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
