<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="center">
      <h4>Daftar Kabar Kebaikan</h4>
    </div>
    <div class="col s12">
      <div class="card-panel orange darken-1 white-text center" >
        <h6>Kabar kebaikan menjadi jendela transparan kami</h6>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="center">
      <h5>Daftar Laporan Penggunaan Dana Dari Penerima Bantuan</h5>
    </div>
    <?php foreach($laporan as $i): ?>
      <div class="col s12 m4">
        <a href="/home/detailKabar/1/<?= $i['id'] ?>">
          <div class="card">
            <p class="green center-align white-text my-0">Rp.<?= number_format($i['lap_jumlah']) ?></p>
            <div class="card-image">
              <img src="/img/bukti_laporan/<?= $i['barang'] ?>" class="img-responsive" style="max-height: 300px;min-height: 300px;">
              <span class="card-title" style="text-shadow: 2px 2px 2px black; width: 400px; background-color: rgba(0,0,0,0.5); overflow: hidden;" ><?= $i['nama'] ?></span>
            </div>
            <div class="card-content" style="max-height: 70px;overflow : hidden;
              text-overflow: ellipsis;
              display: -webkit-box;
              -webkit-line-clamp: 2;
              -webkit-box-orient: vertical;
              text-align: justify">
              <p><?= $i['lap_cerita'] ?></p>
            </div>
          </div>
      </a>
      </div>
    <?php endforeach; ?>
    <div class="col s12">
      <?= $pager->links('laporan') ?>
    </div>
  </div>
  <div class="row">
    <div class="center">
      <h5>Daftar Penyaluran Dana Dari GalangDana</h5>
    </div>
    <?php foreach($pengajuan as $i): ?>
    <div class="col s12 m4">
      <a href="/home/detailKabar/2/<?= $i['id'] ?>">
        <div class="card">
          <p class="blue center-align white-text my-0">Rp.<?= number_format($i['jumlah']) ?></p>
          <div class="card-image">
            <img src="/img/fotodiri/<?= $i['fotoDiri'] ?>" class="img-responsive" style="max-height: 300px;min-height: 300px;">
            <span class="card-title" style="text-shadow: 2px 2px 2px black; width: 400px; background-color: rgba(0,0,0,0.5); overflow: hidden;" ><?= $i['nama'] ?></span>
          </div>
          <div class="card-content" style="max-height: 70px;overflow : hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-align: justify">
            <p><?= $i['cerita'] ?></p>
          </div>
        </div>
      </a>
    </div>
    <?php endforeach; ?>
    <div class="col s12">
      <?= $pager2->links('pengajuan') ?>
    </div>

  </div>
  

</div>
<br>

  <?= $this->endSection(); ?>