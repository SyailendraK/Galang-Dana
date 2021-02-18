<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <a href="/dashboardAdmin/daftarVerifikasi"
    ><i class="fa fa-fw fa-arrow-left"></i> Kembali</a
  >
  <span class="h3 mb-4 text-gray-800"
    ><p style="text-align: center">Detail Verifikasi</p></span
  >

  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Form Verifikasi</h5>
          <?php if(session()->getFlashdata('pesan')): ?>
          <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <form method="post" action="">
            <div class="form-group">
              <label for="nama">NIK</label>
              <input
                type="text"
                class="form-control"
                disabled
                value="<?= $verifikasi['nik'] ?>"
              />
            </div>

            <div class="form-group">
              <label for="telp">KTP</label>
              <br />
              <a href="/img/ktp/<?= $verifikasi['ktp'] ?>" target="_blank">
                <img
                  src="/img/ktp/<?= $verifikasi['ktp'] ?>"
                  alt=""
                  class="img-responsive"
                  width="300"
                />
              </a>
            </div>

            <div class="form-group">
              <label for="provinsi">Foto Diri dan KTP</label>
              <br />
              <a href="/img/ktp/<?= $verifikasi['ktpdiri'] ?>" target="_blank">
                <img
                  src="/img/ktp/<?= $verifikasi['ktpdiri'] ?>"
                  alt=""
                  class="img-responsive"
                  width="300"
                />
              </a>
            </div>

            <div class="form-group">
              <div class="col">
              <a
                  href="/dashboardAdmin/tolakVerifikasi/<?= $verifikasi['nik'] ?>/<?= $verifikasi['id_user'] ?>"
                  class="btn btn-danger mr-2"
                >
                  Tolak Verifikasi
                </a>
                <a
                  href="/dashboardAdmin/verifikasi/<?= $verifikasi['nik'] ?>/<?= $verifikasi['id_user'] ?>"
                  class="btn btn-primary"
                >
                  Verifikasi
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- baris edit profile -->
</div>
<!-- /.container-thumbnail -->

<?= $this->endsection() ?>
