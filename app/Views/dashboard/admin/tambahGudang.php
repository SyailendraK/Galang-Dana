<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
<a href="/dashboardAdmin/kelolaGudangKebaikan"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Tambah Gudang</p></span>
  
  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-body">
          <h5 class="card-title text-center">Form Tambah Gudang</h5>
          <?php if(session()->getFlashdata('pesan')): ?>
            <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <form method="post" action="/dashboardAdmin/tambahGudang">
          <?= csrf_field(); ?>

            <div class="form-group">
              <label for="nama">Nama Penanggung Jawab</label>
              <input
                type="text"
                class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : '') ?>"
                min="0"
                id="nama"
                name="nama"
                value="<?= old('nama') ?>"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('nama'); ?>
              </div>
            </div>

            <div class="form-group">
              <label for="telp">Nomor Telpon Penanggung Jawab</label>
              <input
                type="number"
                class="form-control <?= ($validation->hasError('telp') ? 'is-invalid' : '') ?>"
                min="0"
                id="telp"
                name="telp"
                value="<?= old('telp') ?>"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('telp'); ?>
              </div>
            </div>
            
            <div class="form-group">
              <label for="provinsi">Provinsi</label>
              <input
                type="text"
                class="form-control <?= ($validation->hasError('provinsi') ? 'is-invalid' : '') ?>"
                min="0"
                id="provinsi"
                name="provinsi"
                value="<?= old('provinsi') ?>"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('provinsi'); ?>
              </div>
            </div>

            <div class="form-group">
              <label for="kotkab">Kota/ Kabupaten</label>
              <input
                type="text"
                class="form-control <?= ($validation->hasError('kotkab') ? 'is-invalid' : '') ?>"
                min="0"
                id="kotkab"
                name="kotkab"
                value="<?= old('kotkab') ?>"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('kotkab'); ?>
              </div>
            </div>

            <div class="form-group">
              <label for="kecamatan">Kecamatan</label>
              <input
                type="text"
                class="form-control <?= ($validation->hasError('kecamatan') ? 'is-invalid' : '') ?>"
                min="0"
                id="kecamatan"
                name="kecamatan"
                value="<?= old('kecamatan') ?>"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('kecamatan'); ?>
              </div>
            </div>

            <div class="form-group">
              <label for="deskel">Desa/ Keluarahan</label>
              <input
                type="text"
                class="form-control <?= ($validation->hasError('deskel') ? 'is-invalid' : '') ?>"
                min="0"
                id="deskel"
                name="deskel"
                value="<?= old('deskel') ?>"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('deskel'); ?>
              </div>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea
                  class="form-control <?= ($validation->hasError('alamat') ? 'is-invalid' : '') ?>"
                  id="alamat"
                  name="alamat"
                  rows="3"
                ><?= old('alamat') ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('alamat'); ?>
                </div>
            </div>
            
            <div class="form-group">
              <div class="col">
                <button type="submit" class="btn btn-primary" name="submit">Tambah Gudang</button>
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
