<?= $this->extend('layout/admin/admin') ?>
<?= $this->section('page-content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <span class="h3 mb-4 text-gray-800"
    ><p style="text-align: center">User List</p></span
  >

  <!-- baris my profile -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center">Daftar Akun</h5>
          <form class="form-inline" method="get" action="/dashboardAdmin/userList">
            <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Search</button>
          </form>
          <div class="card" style="overflow-x: auto">
            <div class="card-body">
              <?php if(session()->getFlashdata('pesan')): ?>
              <?= session()->getFlashdata('pesan'); ?>
              <?php endif; ?>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No. Telp</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1;foreach($users as $i): ?>
                  <tr style="text-transform: capitalize">
                    <td><?= $no ?></td>
                    <td><?= $i['email'] ?></td>
                    <td><?= $i['username'] ?></td>
                    <td><?= $i['role'] ?></td>
                    <td><?= $i['address'] ?></td>
                    <td><?= $i['telephone'] ?></td>
                    <td>
                    
                      <?php if($i['email'] != user()->email): ?>
                      <a href="/dashboardAdmin/matikanAkun/<?= $i['id'] ?>" class="badge badge-danger" onclick="return confirm('Nonaktifkan akun ini?')">Nonaktifkan</a>
                        <?php if($i['role'] == 'member'): ?>
                        <a href="/dashboardAdmin/updateRole/<?= $i['id'] ?>/<?= $i['role'] ?>/1" class="badge badge-success">Promote</a>
                        <?php elseif($i['role'] == 'admin'): ?>
                        <a href="/dashboardAdmin/updateRole/<?= $i['id'] ?>/<?= $i['role'] ?>/1" class="badge badge-success">Promote</a>
                        <a href="/dashboardAdmin/updateRole/<?= $i['id'] ?>/<?= $i['role'] ?>/0" class="badge badge-warning">Demote</a>
                        <?php else: ?>
                        <a href="/dashboardAdmin/updateRole/<?= $i['id'] ?>/<?= $i['role'] ?>/0" class="badge badge-warning">Demote</a>
                        <?php endif; ?>
                      <?php endif; ?>

                    </td>
                  </tr>
                  <?php $no++;endforeach; ?>
                </tbody>
              </table>
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
