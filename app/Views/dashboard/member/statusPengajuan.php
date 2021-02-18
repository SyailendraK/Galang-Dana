<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Status Pengajuan</p></span>


  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card" style="overflow-x : auto;">
        <div class="card-body">
          <h5 class="card-title text-center">Daftar Pengajuan</h5>
          <a href="/dashboard/pengajuanBantuan" class="btn btn-primary">Ajukan Bantuan</a>
          <?php if(session()->getFlashdata('pesan')): ?>
          <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <table class="table table-hover" >
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Penerima Donasi</th>
                <th scope="col">Jumlah Permintaan Bantuan</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1;foreach($status as $i): ?>
              <tr>
                <th scope="row"><?= $no ?></th>
                <td><?= $i['nama'] ?></td>
                <td>Rp.<?= number_format($i['jumlah']) ?></td>
                <td><?= $i['created_at'] ?></td>
                <td>
                <?php if($i['status'] == 0){
                  echo 'Menunggu review';
                }elseif($i['status'] == 1){
                  echo 'Pengajuan diterima, menunggu penyaluran dana';
                }elseif($i['status'] == 3){
                  echo 'Pengajuan ditolak';
                }?>
                </td>
                <td>
                  <?php if($i['status'] != 1): ?>
                  <a href="/Dashboard/perbaruiPengajuan/<?= $i['id'] ?>" class="badge badge-success">Perbarui</a>
                  <a href="/Dashboard/hapusPengajuan/<?= $i['id'] ?>/<?= $i['fotoDiri'] ?>" class="badge badge-danger" onclick="return confirm('Ingin menghapus pengajuan ini?')">Hapus</a>
                  <?php endif; ?>

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
