<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->

  <a href="/dashboard"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Verifikasi</p></span>
  
  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-body">
          <h5 class="card-title text-center">Form Verifikasi</h5>
          <?php if(session()->getFlashdata('pesan')): ?>
            <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <form method="post" action="/dashboard/verifikasi" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="nama">Nama sesuai KTP</label>
              <input
                type="text"
                class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : '') ?>"
                min="0"
                id="nama"
                name="nama"
                value="<?= old('nama') ?>"
                placeholder="Contoh : Angga Rusdi Ginanjar"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('nama'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="nik">NIK</label>
              <input
                type="text"
                class="form-control <?= ($validation->hasError('nik') ? 'is-invalid' : '') ?>"
                min="0"
                id="nik"
                name="nik"
                value="<?= old('nik') ?>"
                placeholder="Contoh : 3204896709990004"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('nik'); ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="ktp" class="col-sm-2 col-form-label">Foto KTP</label>
              <div class="col-sm-4">
                <img src="/img/icon_donatur_tr.png" class="img-thumbnail img-preview-ktp"/>
              </div>
              <div class="col-sm-6">
                <div class="custom-file mb-3">
                  <input
                    type="file"
                    class="custom-file-input <?= ($validation->hasError('ktp') ? 'is-invalid' : '') ?>"
                    id="ktp"
                    required
                    name="ktp"
                    onchange="previewImage()"
                  />
                  <div class="invalid-feedback">
                    <?= $validation->getError('ktp'); ?>
                  </div>
                  <label class="custom-file-label ktp-label" for="ktp">Pilih Gambar</label>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="ktpdiri" class="col-sm-2 col-form-label">Foto diri dengan KTP</label>
              <div class="col-sm-4">
                <img src="/img/icon_donatur_tr.png" class="img-thumbnail img-preview-ktpdiri" />
              </div>
              <div class="col-sm-6">
                <div class="custom-file mb-3">
                  <input
                    type="file"
                    class="custom-file-input <?= ($validation->hasError('ktpdiri') ? 'is-invalid' : '') ?>"
                    id="ktpdiri"
                    required
                    name="ktpdiri"
                    onchange="previewImage2()"
                  />
                  <div class="invalid-feedback">
                    <?= $validation->getError('ktpdiri'); ?>
                  </div>
                  <label class="custom-file-label ktpdiri-label" for="ktpdiri">Pilih Gambar</label>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col">
                <button type="submit" class="btn btn-primary" name="submit">Ajukan Verifikasi</button>
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
