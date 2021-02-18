<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"
    ><p style="text-align: center">Kelola Laporan Bantuan</p></span
  >

  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Daftar Laporan Bantuan</h5>
          <form class="form-inline" method="get" action="/dashboardAdmin/laporanBantuan">
            <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
          </form>
          <div class="card" style="overflow-x: auto">
            <div class="card-body">
              <?php if(session()->getFlashdata('pesan')): ?>
              <?= session()->getFlashdata('pesan'); ?>
              <?php endif; ?>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1;foreach($laporan as $i): ?>
                  <tr style="text-transform: capitalize">
                    <td><?= $no ?></td>
                    <td><?= $i['nama'] ?></td>
                    <td><?= $i['nik'] ?></td>
                    <td>Rp.<?= number_format($i['lap_jumlah']) ?></td>
                    <td>
                      <a href="/home/detailKabar/1/<?= $i['id'] ?>" target="_blank" class="badge badge-primary">Detail</a>
                      <a href="/dashboardAdmin/hapusLaporanBantuan/<?= $i['id'] ?>/<?= $i['pembelian'] ?>/<?= $i['barang'] ?>" class="badge badge-danger">Hapus</a>
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
  </div>

  <!-- baris edit profile -->
</div>
<br />
<!-- /.container-fluid -->

<?= $this->endsection() ?>
