<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Profile</p></span>

  <!-- baris my profile -->
  <?php if(in_groups('member')): ?>
  <div class="row">
    <div class="col-md-12">
      <div class="card text-center">
        <div class="card-body">
          <h5 class="card-title">Donasi saya</h5>
          <div class="row">
            <div class="col-md-4">
              <p>Donasi saya</p>
              <img src="img/icon_donatur_tr.png" alt="" width="150" />
              <p>Rp.<?php 
              $temp=0;
              foreach($total as $t){
                $temp += (int)$t['gross_amount'];
              }
              echo number_format($temp);
              ?></p>
            </div>
            <div class="col-md-4">
              <p>Donasi tersalurkan</p>
              <img src="img/icon_donatur_tr.png" alt="" width="150" />
              <?php if($pengeluaran != null): ?>
              <?php 
              $temp2=0;
              foreach($pengeluaran as $i){
                $temp2 += $i['gross_amount'];
              }
              $temp2 = $temp2/$count;
              
              ?>
              <p>Rp.<?= ($temp2 > $temp) ? number_format($temp) : number_format($temp2) ?></p>
              <?php else: ?>
              <p>Rp.0</p>
              <?php endif; ?>
            </div>
            <div class="col-md-4">
              <br />
              <br />
              <a class="btn btn-primary align-middle" href="/donasi">Donasi</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br />
  <?php endif; ?>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">My Profile</h5>
          <?php if(session()->getFlashdata('ktp')): ?>
          <?= session()->getFlashdata('ktp'); ?>
          <?php endif; ?>
          <form>
            <div class="form-group">
              <div class="col">
                <label for="email">Email</label>
                <input
                  type="text"
                  id="email"
                  class="form-control"
                  value="<?= user()->email ?>"
                  disabled
                />
              </div>
            </div>
            <div class="form-group">
              <div class="col">
                <label for="username">Username</label>
                <input
                  type="text"
                  id="username"
                  class="form-control"
                  value="<?= user()->username ?>"
                  disabled
                />
              </div>
            </div>
            <?php if(in_groups('member')): ?>
            <div class="form-group">
              <div class="col">
                <label for="username">Terverifikasi</label>
                <input
                  type="text"
                  id="username"
                  class="form-control"
                  value="<?php if(user()->status == 1){
                  echo 'Menunggu Proses Verifikasi dalam 3x24 Jam';
                }else if(user()->status == 0){
                  echo 'Belum Terverifikasi';
                }else if(user()->status == 2){
                  echo 'Terverifikasi';
                }else{
                  echo 'Data Verifikasi ditolak, harap kirim kembali';
                } ?>"
                  disabled
                />
              </div>
            </div>
            <?php endif; ?>
            <?php if(user()->status != 1 && user()->status != 2 && in_groups('member') && user()->address != '' && user()->telephone != ''): ?>
            <div class="form-group">
              <div class="col">
                <a class="btn btn-primary" href="/dashboard/verifikasi"
                  >Verifikasi Akun</a
                >
              </div>
            </div>
            <?php elseif(in_groups('member') && user()->status == 0 && user()->address == '' && user()->telephone == ''): ?>
              <div class="form-group">
              <div class="col">
                <a class="btn btn-secondary" href="/dashboard/editProfile"
                  >Lengkapi Profile Untuk Verifikasi
                </a>
              </div>
            </div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Ubah password</h5>

          <?php if(session()->getFlashdata('pesan')): ?>
          <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>

          <form method="post" action="/dashboard/ubahPassword">
            <div class="form-group">
              <div class="col">
                <label for="passLama">Password lama</label>
                <input
                  type="password"
                  id="passLama"
                  class="form-control <?= ($validation->hasError('passLama') ? 'is-invalid' : '') ?>"
                  name="passLama"
                  value="<?= old('passLama') ?>"
                />
                <div class="invalid-feedback">
                  <?= $validation->getError('passLama'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col">
                <label for="passBaru">Password baru</label>
                <input
                  type="password"
                  id="passBaru"
                  class="form-control <?= ($validation->hasError('passBaru') ? 'is-invalid' : '') ?>"
                  name="passBaru"
                  value="<?= old('passBaru') ?>"
                />
                <div class="invalid-feedback">
                  <?= $validation->getError('passBaru'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col">
                <label for="passBaruRe">Ulangi password baru</label>
                <input
                  type="password"
                  id="passBaruRe"
                  class="form-control <?= ($validation->hasError('passBaruRe') ? 'is-invalid' : '') ?>"
                  name="passBaruRe"
                  value="<?= old('passBaruRe') ?>"
                />
                <div class="invalid-feedback">
                  <?= $validation->getError('passBaruRe'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col">
                <button type="submit" class="btn btn-primary">Ubah</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- baris edit profile -->
</div>
<br />
<!-- /.container-fluid -->

<?= $this->endsection() ?>
