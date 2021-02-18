<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"
    ><p style="text-align: center">Gudang Kebaikan</p></span
  >

  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Daftar Gudang Kebaikan</h5>
          <a href="/dashboardAdmin/tambahGudang" class="btn btn-primary"
            >Tambah Gudang</a
          >
          <div class="card" style="overflow-x: auto">
            <div class="card-body">
              <?php if(session()->getFlashdata('pesan')): ?>
              <?= session()->getFlashdata('pesan'); ?>
              <?php endif; ?>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">provinsi</th>
                    <th scope="col">Kota/Kabupaten</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Desa/ Kelurahan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1;foreach($gudang as $i): ?>
                  <tr style="text-transform: capitalize">
                    <td><?= $no ?></td>
                    <td><?= $i['provinsi'] ?></td>
                    <td><?= $i['kotkab'] ?></td>
                    <td><?= $i['kecamatan'] ?></td>
                    <td><?= $i['deskel'] ?></td>
                    <td><?= $i['alamat'] ?></td>
                    <td>
                      <a href="/dashboardAdmin/perbaruiGudang/<?= $i['id'] ?>" class="badge badge-success">Perbarui</a>
                      <a href="/dashboardAdmin/hapusGudang/<?= $i['id'] ?>" class="badge badge-danger">Hapus</a>
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
