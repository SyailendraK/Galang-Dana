<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
<a href="/dashboard/daftarLaporan/<?= $id ?>"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Pelaporan Bantuan</p></span>
  
  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-body">
          <h5 class="card-title text-center">Form Pelaporan</h5>
          <?php if(session()->getFlashdata('pesan')): ?>
            <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <form method="post" action="/dashboard/tambahLaporan/<?= $id ?>" enctype="multipart/form-data">
          <?= csrf_field(); ?>
            <div class="form-group">
                <label for="cerita">Ceritakan pemakaian bantuan</label>
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
              <label for="jumlah">Berapa jumlah dana yang digunakan</label>
              <input
                type="number"
                class="form-control <?= ($validation->hasError('jumlah') ? 'is-invalid' : '') ?>"
                min="0"
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
              <label for="pembelian" class="col-sm-2 col-form-label">Bukti pembelian</label>
              <div class="col-sm-4">
                <img src="/img/icon_donatur_tr.png" class="img-thumbnail img-preview-pembelian"/>
              </div>
              <div class="col-sm-6">
                <div class="custom-file mb-3">
                  <input
                    type="file"
                    class="custom-file-input <?= ($validation->hasError('pembelian') ? 'is-invalid' : '') ?>"
                    id="pembelian"
                    required
                    name="pembelian"
                    onchange="previewImageAll('pembelian','pembelian-label','img-preview-pembelian')"
                  />
                  <div class="invalid-feedback">
                    <?= $validation->getError('pembelian'); ?>
                  </div>
                  <label class="custom-file-label pembelian-label" for="pembelian">Pilih Gambar</label>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="barang" class="col-sm-2 col-form-label">Barang yang dibeli</label>
              <div class="col-sm-4">
                <img src="/img/icon_donatur_tr.png" class="img-thumbnail img-preview-barang" />
              </div>
              <div class="col-sm-6">
                <div class="custom-file mb-3">
                  <input
                    type="file"
                    class="custom-file-input <?= ($validation->hasError('barang') ? 'is-invalid' : '') ?>"
                    id="barang"
                    required
                    name="barang"
                    onchange="previewImageAll('barang','barang-label','img-preview-barang')"
                  />
                  <div class="invalid-feedback">
                    <?= $validation->getError('barang'); ?>
                  </div>
                  <label class="custom-file-label barang-label" for="barang">Pilih Gambar</label>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col">
                <button type="submit" class="btn btn-primary" name="submit">Tambah Laporan</button>
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
