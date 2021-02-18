<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <a href="/dashboard/PelaporanBantuan"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Pelaporan Bantuan</p></span>

  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card" style="overflow-x : auto;">
        <div class="card-body">
          <h5 class="card-title text-center">Daftar Laporan</h5>
          <a href="/Dashboard/tambahLaporan/<?= $id ?>" class="btn btn-primary">Buat Laporan</a>
          
          <?php if(session()->getFlashdata('pesan')): ?>
          <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <table class="table table-hover" >
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Isi laporan</th>
                <th scope="col">Jumlah yang digunakan</th>
                <th scope="col">Tanggal laporan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $jumlah=0;$no=1;foreach($laporan as $i): ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $i['cerita'] ?></td>
                <td>Rp.<?= number_format($i['jumlah']) ?></td>
                <td><?= $i['created_at'] ?></td>
                <td>
                <a href="/dashboard/perbaruiLaporan/<?= $i['id'] ?>/<?= $id ?>" class="badge badge-success">Perbarui</a>
                <a href="/dashboard/hapusLaporan/<?= $i['id'] ?>/<?= $id ?>/<?= $i['pembelian'] ?>/<?= $i['barang'] ?>" class="badge badge-danger" onclick="return confirm('Ingin menghapus laporan ini?')">Hapus</a>
                </td>
              </tr>
              <?php $jumlah+=(int) $i['jumlah'];$no++;endforeach; ?>

              <tr>
                <td colspan="2"><b>Dana terlaporkan</b></td>
                <td><b>Rp.<?= number_format($jumlah) ?></b></td>

              </tr>
              <tr>
                <td colspan="2"><b>Dana Pengajuan</b></td>
                <td><b> Rp.<?= number_format($pengajuan['jumlah']) ?></b></td>
                <td><b>Dana belum terlapor</b></td>
                <td><b>Rp.<?= number_format((int)$pengajuan['jumlah'] - $jumlah) ?></b></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- baris edit profile -->
</div>
<!-- /.container-thumbnail -->

<?= $this->endsection() ?>
