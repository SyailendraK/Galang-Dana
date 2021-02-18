<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <a href="/dashboardAdmin/kelolaPengajuan"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Kelola Pengajuan</p></span>


  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Detail Pengajuan Bantuan</h5>
          <?php if(session()->getFlashdata('pesan')): ?>
            <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <form>
            <div class="form-group">
                <label for="cerita">Ceritakan kenapa dan untuk apa mengajukan bantuan</label>
                <textarea
                  class="form-control <?= ($validation->hasError('cerita') ? 'is-invalid' : '') ?>"
                  id="cerita"
                  name="cerita"
                  disabled
                  rows="3"
                ><?= (old('cerita')) ? old('cerita') : $pengajuan['cerita'] ?></textarea>
                <div class="invalid-feedback">
                  <?= $validation->getError('cerita'); ?>
                </div>
            </div>
            <div class="form-group">
              <label for="siapa">Bantuan akan digunakan untuk siapa</label>
              <select class="custom-select <?= ($validation->hasError('siapa') ? 'is-invalid' : '') ?>" id="siapa" name="siapa" disabled>
                <option <?= ($pengajuan['siapa'] == 'sendiri') ? 'selected' : '' ?> value="sendiri">Diri Sendiri</option>
                <option <?= ($pengajuan['siapa'] == 'orang lain') ? 'selected' : '' ?> value="orang lain">Orang lain</option>
                <option <?= ($pengajuan['siapa'] == 'organisasi') ? 'selected' : '' ?> value="organisasi">Organisasi</option>
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
                disabled
                name="nama"
                value="<?= (old('nama')) ? old('nama') : $pengajuan['nama'] ?>"
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
                disabled
                minlength="15"
                maxlength="17"
                name="nik"
                value="<?= (old('nik')) ? old('nik') : $pengajuan['nik'] ?>"
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
                disabled
                name="nomorHP"
                placeholder="Contoh: 085720663015"
                value="<?= (old('nomorHP')) ? old('nomorHP') : $pengajuan['nomorHP'] ?>"
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
                disabled
                placeholder="Contoh: budisasongko@gmail.com"
                value="<?= (old('email')) ? old('email') : $pengajuan['email'] ?>"
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
              <textarea class="form-control <?= ($validation->hasError('alamat') ? 'is-invalid' : '') ?>" id="alamat" name="alamat" rows="3" disabled>
<?= (old('alamat')) ? old('alamat') : $pengajuan['alamat'] ?></textarea
              >
              <div class="invalid-feedback">
                <?= $validation->getError('alamat'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="bank">Bank untuk penerimaan bantuan</label>
              <select class="custom-select <?= ($validation->hasError('bank') ? 'is-invalid' : '') ?>" id="bank" name="bank" disabled>
                <option value="<?= $pengajuan['bank'] ?>" selected><?= $pengajuan['bank'] ?></option>
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
                disabled
                id="rekening"
                name="rekening"
                value="<?= (old('rekening')) ? old('rekening') : $pengajuan['rekening'] ?>"
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
                min="1000000"
                id="jumlah"
                disabled
                name="jumlah"
                value="<?= (old('jumlah')) ? old('jumlah') : $pengajuan['jumlah'] ?>"
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
                <a href="/img/fotodiri/<?= $pengajuan['fotoDiri'] ?>" target="_blank"><img
                  src="/img/fotodiri/<?= $pengajuan['fotoDiri'] ?>"
                  class="img-thumbnail img-preview-fotoDiri"
                />
                </a>
              </div>
            </div>

            <div class="form-group">
              <div class="col">
              <a href="/dashboardAdmin/tolakPengajuan/<?= $pengajuan['id'] ?>" class="btn btn-danger">
                  Tolak Pengajuan
                </a>
                <a href="/dashboardAdmin/terimaPengajuan/<?= $pengajuan['id'] ?>" class="btn btn-primary">
                  Terima Pengajuan
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
