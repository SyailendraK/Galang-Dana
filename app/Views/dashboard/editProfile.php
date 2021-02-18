<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"><p style="text-align: center;">Edit Profile</p></span>

  
  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Edit</h5>
          <?php if(session()->getFlashdata('pesan')): ?>
            <?= session()->getFlashdata('pesan'); ?>
          <?php endif; ?>
          <?php if(in_groups('member')): ?>
          <form method="post" action="/dashboard/editProfile">
          <?php else: ?>
            <form method="post" action="/dashboardAdmin/editProfile">
          <?php endif; ?>
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
                  class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : '') ?>"
                  name="username"
                  value="<?= (old('username')) ? old('username') : user()->username ?>"
                />
                <div class="invalid-feedback">
                  <?= $validation->getError('username'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col">
              <label for="alamat">Alamat</label>
              <textarea class="form-control <?= ($validation->hasError('alamat') ? 'is-invalid' : '') ?>" id="alamat" name="alamat" rows="3"><?= (old('alamat')) ? old('alamat') : user()->address ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col">
                <label for="numberTel">Nomor Handphone (WA)</label>
                <input
                  type="number"
                  min="0"
                  id="numberTel"
                  class="form-control <?= ($validation->hasError('numberTel') ? 'is-invalid' : '') ?>"
                  name="numberTel"
                  value="<?= (old('numberTel')) ? old('numberTel') : user()->telephone ?>"
                />
                <div class="invalid-feedback">
                  <?= $validation->getError('numberTel'); ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col">
                <button type="submit" class="btn btn-primary" name="submit">Ubah</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
  </div>
  <!-- baris edit profile -->
    
</div>
<!-- /.container-fluid -->

<?= $this->endsection() ?>
