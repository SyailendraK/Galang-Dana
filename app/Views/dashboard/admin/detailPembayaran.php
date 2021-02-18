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
          <h5 class="card-title text-center">Detail Pembayaran</h5>
          <?php if(session()->getFlashdata('pesan')): ?>
            <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <form>
            
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
                type="text"
                class="form-control <?= ($validation->hasError('jumlah') ? 'is-invalid' : '') ?>"
                id="jumlah"
                disabled
                name="jumlah"
                value="Rp.<?= number_format((int) $pengajuan['jumlah']) ?>"
                placeholder="Rp."
              />
              <div class="invalid-feedback">
                <?= $validation->getError('jumlah'); ?>
              </div>
            </div>

            <div class="form-group">
              <div class="col">
                <a href="/dashboardAdmin/konfirmasiPembayaran/<?= $pengajuan['id'] ?>" class="btn btn-primary" onclick="return confirm('Konfirmasi pembayaran ini?')">
                  Konfirmasi Pembayaran
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
