<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Pelaporan Bantuan</p></span>


  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card" style="overflow-x : auto;">
        <div class="card-body">
          <h5 class="card-title text-center">Daftar Pengajuan</h5>
          <?php if(session()->getFlashdata('pesan')): ?>
          <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <table class="table table-hover" >
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Penerima Donasi</th>
                <th scope="col">Dana Bantuan</th>
                <th scope="col">Dana Terlaporkan</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=0;foreach($status as $i): ?>
              <tr>
                <th scope="row"><?= $no+1 ?></th>
                <td><?= $i['nama'] ?></td>
                <td>Rp.<?= number_format($i['jumlah']) ?></td>
                <td>Rp.<?= number_format($terlaporkan[$no]) ?></td>
                <td><?= $i['created_at'] ?></td>
                <td>
                  <a href="/Dashboard/daftarLaporan/<?= $i['id'] ?>" class="badge badge-primary">Daftar laporan</a>
                </td>
              </tr>
              <?php $no++;endforeach; ?>
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
