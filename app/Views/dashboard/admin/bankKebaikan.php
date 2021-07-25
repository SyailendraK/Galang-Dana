<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Bank Kebaikan</p></span>

  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Ringkasan Bank Kebaikan</h5>
          <div class="row">
            <div class="col-md-4">
              <p>Total Donasi</p>
              <img src="img/icon_donatur_tr.png" alt="" width="150" />
              <p>Rp.<?php 
              $temp=0;
              foreach($total as $t){
                if($t['status_code'] == 200){
                  $temp += (int)$t['gross_amount'];
                }
              }
              echo number_format($temp);
              
              ?></p>
            </div>
            <div class="col-md-4">
              <p>Donasi tersalurkan</p>
              <img src="img/icon_donatur_tr.png" alt="" width="150" />
              <p>Rp.<?php 
              $temp2=0;
              foreach($total as $t){
                if($t['status_code'] == 199){
                  $temp2 += (int)$t['gross_amount'];
                }
              }
              echo number_format($temp2);
              
              ?></p>
            </div>
            <div class="col-md-4">
            <p>Sisa Dana</p>
              <img src="img/icon_donatur_tr.png" alt="" width="150" />
              <p>Rp.<?php 
              echo number_format($temp-$temp2);
              
              ?></p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <br />
  <div class="row">
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Pemasukan dana</h5>
          <div class="row">
          <div class="col-12">
          <?php if(session()->getFlashdata('tambah')): ?>
            <?= session()->getFlashdata('tambah'); ?>
          <?php endif; ?>
          <form method="post" action="/dashboardAdmin/tambahDana" >
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="jumlah">Jumlah dana</label>
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

            <div class="form-group">
              <label for="keteranganTambah">Keterangan</label>
              <input
                type="text"
                class="form-control <?= ($validation->hasError('keteranganTambah') ? 'is-invalid' : '') ?>"
                id="keteranganTambah"
                name="keteranganTambah"
                value="<?= old('keteranganTambah') ?>"
                placeholder="Keterangan"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('keteranganTambah'); ?>
              </div>
            </div>

            <div class="form-group">
              <label for="tgl">Tanggal</label>
              <input
                type="date"
                class="form-control <?= ($validation->hasError('tgl') ? 'is-invalid' : '') ?>"
                min="0"
                id="tgl"
                name="tgl"
                value="<?= old('tgl') ?>"
                placeholder="Rp."
              />
              <div class="invalid-feedback">
                <?= $validation->getError('tgl'); ?>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col">
                <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
              </div>
            </div>
          </form>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Pengeluaran dana</h5>
          <div class="row">
          <div class="col-12">
          <?php if(session()->getFlashdata('keluar')): ?>
            <?= session()->getFlashdata('keluar'); ?>
          <?php endif; ?>
          <form method="post" action="/dashboardAdmin/keluarDana">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="jumlah">Jumlah dana</label>
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
            <div class="form-group">
              <label for="keteranganKurang">Keterangan</label>
              <input
                type="text"
                class="form-control <?= ($validation->hasError('keteranganKurang') ? 'is-invalid' : '') ?>"
                id="keteranganKurang"
                name="keteranganKurang"
                value="<?= old('keteranganKurang') ?>"
                placeholder="Keterangan"
              />
              <div class="invalid-feedback">
                <?= $validation->getError('keteranganKurang'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="tgl">Tanggal</label>
              <input
                type="date"
                class="form-control <?= ($validation->hasError('tgl') ? 'is-invalid' : '') ?>"
                min="0"
                id="tgl"
                name="tgl"
                value="<?= old('tgl') ?>"
                placeholder="Rp."
              />
              <div class="invalid-feedback">
                <?= $validation->getError('tgl'); ?>
              </div>
            </div>
            <div class="form-group">
              <div class="col">
                <button type="submit" class="btn btn-primary" name="submit">Kurangi</button>
              </div>
            </div>
          </form>
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
