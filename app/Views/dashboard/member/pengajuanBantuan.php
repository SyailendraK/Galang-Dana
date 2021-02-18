<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <a href="/dashboard/statusPengajuan"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Pengajuan Bantuan</p></span>

  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Form Pengajuan Bantuan</h5>
          <?php if(session()->getFlashdata('pesan')): ?>
            <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <form
            method="post"
            action="/dashboard/pengajuanBantuan"
            enctype="multipart/form-data"
          >
            <?= csrf_field(); ?>
            <div class="form-group">
                <label for="cerita">Ceritakan kenapa dan untuk apa mengajukan bantuan</label>
                <textarea
                  class="form-control <?= ($validation->hasError('cerita') ? 'is-invalid' : '') ?>"
                  id="cerita"
                  name="cerita"
                  rows="3"
                ><?= old('cerita') ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('cerita'); ?>
                </div>
            </div>
            <div class="form-group">
              <label for="siapa">Bantuan akan digunakan untuk siapa</label>
              <select class="custom-select <?= ($validation->hasError('siapa') ? 'is-invalid' : '') ?>" id="siapa" name="siapa">
                <option selected value="sendiri">Diri Sendiri</option>
                <option value="orang lain">Orang lain</option>
                <option value="organisasi">Organisasi</option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('siapa'); ?>
              </div>
            </div>
            <!-- orang lain -->
            <div class="form-group">
              <label for="nama"
                >Nama lengkap penerima bantuan/ penanggung jawab
                organisasi</label
              >
              <input
                type="text"
                class="form-control <?= ($validation->hasError('nama') ? 'is-invalid' : '') ?>"
                id="nama"
                name="nama"
                value="<?= (old('nama')) ? old('nama') : user()->username ?>"
                placeholder="Contoh: husein sastra negara"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('nama'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="nik"
                >NIK penerima bantuan/ penanggung jawab organisasi
              </label>
              <input
                type="number"
                class="form-control <?= ($validation->hasError('nik') ? 'is-invalid' : '') ?>"
                min="0"
                id="nik"
                minlength="15"
                maxlength="17"
                name="nik"
                value="<?= old('nik') ?>"
                placeholder="Contoh: 3202567809880003"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('nik'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="nomorHP"
                >Nomor HP penerima bantuan/ penanggung jawab organisasi</label
              >
              <input
                type="number"
                class="form-control <?= ($validation->hasError('nomorHP') ? 'is-invalid' : '') ?>"
                min="0"
                id="nomorHP"
                name="nomorHP"
                placeholder="Contoh: 085720663015"
                value="<?= (old('nomorHP')) ? old('nomorHP') : user()->telephone ?>"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('nomorHP'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="email"
                >Email penerima bantuan/ penanggung jawab organisasi</label
              >
              <input
                type="email"
                class="form-control <?= ($validation->hasError('email') ? 'is-invalid' : '') ?>"
                min="0"
                id="email"
                name="email"
                placeholder="Contoh: budisasongko@gmail.com"
                value="<?= (old('email')) ? old('email') : user()->email ?>"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('email'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="alamat" class="col-form-label"
                >Alamat penerima bantuan/ operasional organisasi</label
              >
              <label for="alamat"></label>
              <textarea class="form-control <?= ($validation->hasError('alamat') ? 'is-invalid' : '') ?>" id="alamat" name="alamat" rows="3">
<?= (old('alamat')) ? old('alamat') : user()->address ?></textarea
              >
              <div class="invalid-feedback">
                <?= $validation->getError('alamat'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="bank">Bank untuk penerimaan bantuan</label>
              <select class="custom-select <?= ($validation->hasError('bank') ? 'is-invalid' : '') ?>" id="bank" name="bank">
                <?php foreach($bank as $i): ?>
                <option value="<?= $i['name'] ?>"><?= $i['name'] ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('bank'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="rekening">Nomor rekening penerima bantuan</label>
              <input
                type="number"
                class="form-control <?= ($validation->hasError('rekening') ? 'is-invalid' : '') ?>"
                min="0"
                id="rekening"
                name="rekening"
                value="<?= old('rekening') ?>"
                placeholder="Contoh: 32074628293213"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('rekening'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="jumlah">Berapa jumlah yang diperlukan</label>
              <input
                type="number"
                class="form-control <?= ($validation->hasError('jumlah') ? 'is-invalid' : '') ?>"
                id="jumlah"
                name="jumlah"
                value="<?= old('jumlah') ?>"
                placeholder="Rp."
              />
              <div class="invalid-feedback">
                <?= $validation->getError('jumlah'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="fotoDiri" class="col-sm-2 col-form-label"
                >Foto diri penerima bantuan/ penanggung jawab organisasi</label
              >
              <div class="col-sm-4">
                <img
                  src="/img/icon_donatur_tr.png"
                  class="img-thumbnail img-preview-fotoDiri"
                />
              </div>
              <div class="col-sm-6">
                <div class="custom-file mb-3">
                  <input
                    type="file"
                    class="custom-file-input <?= ($validation->hasError('fotoDiri') ? 'is-invalid' : '') ?>"
                    id="fotoDiri"
                    name="fotoDiri"
                    required
                    onchange="previewImage3()"
                  />
                  <div class="invalid-feedback">
                    <?= $validation->getError('fotoDiri'); ?>
                  </div>
                  <label class="custom-file-label fotoDiri-label" for="fotoDiri"
                    >Pilih Gambar</label
                  >
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col">
                <button type="submit" class="btn btn-primary" name="submit">
                  Ajukan Bantuan
                </button>
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
