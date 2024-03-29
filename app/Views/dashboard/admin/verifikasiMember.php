<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Kelola Verifikasi</p></span>

  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Pengajuan Verifikasi</h5>
          <form class="form-inline" method="get" action="/dashboardAdmin/daftarVerifikasi">
            <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="search-pengajuanverif">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
          </form>
          <div class="row">
          <div class="col-12" style="overflow-x: scroll;">
          <?php if(session()->getFlashdata('pesan')): ?>
            <?= session()->getFlashdata('pesan'); ?>
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
              <?php $no=1;foreach($verifikasi as $i): if($i['status'] == 0):?>
              <tr style="text-transform: capitalize">
                <td><?= $no ?></td>
                <td><?= $i['nama'] ?></td>
                <td><?= $i['nik'] ?></td>
                <td>
                  <a href="/dashboardAdmin/detailVerifikasi/<?= $i['nik'] ?>" class="badge badge-primary">Detail</a>
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
          <h5 class="card-title">Un-verifikasi</h5>

          <form class="form-inline" method="get" action="/dashboardAdmin/daftarVerifikasi">
            <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="search-verified">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
          </form>

          <div class="row">
          <div class="col-12" style="overflow-x: scroll;">
          
          <?php if(session()->getFlashdata('unverif')): ?>
            <?= session()->getFlashdata('unverif'); ?>
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
            <?php $no=1;foreach($unverif as $i): ?>
              <tr style="text-transform: capitalize">
                <td><?= $no ?></td>
                <td><?= $i['nama'] ?></td>
                <td><?= $i['nik'] ?></td>
                <td>
                  <a href="/dashboardAdmin/unVerifikasi/<?= $i['nik'] ?>/<?= $i['id_user'] ?>" class="badge badge-danger">unVerif</a>
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
