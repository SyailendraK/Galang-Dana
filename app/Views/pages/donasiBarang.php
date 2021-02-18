<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

  <div class="row container">
  <div class="center">
    <h4>Daftar Gudang Kebaikan</h4>
  </div>
    <div class="col s12">
      <div class="card-panel orange darken-1 white-text center" >
        <h6>Donasikan barang anda ke alamat gudang kami yang terdekat</h6>
      </div>
      <table class="striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Provinsi</th>
            <th>Kota/Kabupaten</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>Alamat</th>
            <th>Kontak</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1;foreach($gudang as $i): ?>
          <tr style="text-transform: capitalize;">
            <td><?= $no ?></td>
            <td><?= $i['provinsi'] ?></td>
            <td><?= $i['kotkab'] ?></td>
            <td><?= $i['kecamatan'] ?></td>
            <td><?= $i['deskel'] ?></td>
            <td><?= $i['alamat'] ?></td>
            <td><?= $i['nama_pj'] ?> : <?= $i['telp_pj'] ?></td>

          </tr>
          <?php $no++;endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <br>

  <?= $this->endSection(); ?>
