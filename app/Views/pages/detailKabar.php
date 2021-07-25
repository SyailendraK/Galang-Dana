<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col s12 m12">
      <div class="card">
        <p class="amber darken-3 center-align white-text my-0">Rp.<?= number_format($kabar['jumlah']) ?></p>
        <div class="card-image">
          <img src="/img/<?= ($jenis == 1) ? 'bukti_laporan' : 'fotodiri' ?>/<?= ($jenis == 1) ? $kabar['barang'] : $kabar['fotoDiri'] ?>" class="img-responsive" style="height:500px; width:100%; overflow : hidden;">
          <span class="card-title" style="text-shadow: 2px 2px 2px black; width: 100%; background-color: rgba(0,0,0,0.5); overflow: hidden;" ><?= $kabar['nama'] ?></span>
        </div>
        <div class="card-content">
          <div class="row">
            <?php if($jenis == 1): ?>
            <div class="col m6 s12">
              <p class="center amber darken-3 white-text">Bukti Pembelian</p>
              <img src="/img/<?= ($jenis == 1) ? 'bukti_laporan' : 'fotodiri' ?>/<?= ($jenis == 1) ? $kabar['pembelian'] : $kabar['fotoDiri'] ?>" class="img-responsive" style="height:200px; width:100%; overflow : hidden;">
            </div>
            <div class="col m6 s12">
              <p class="center amber darken-3 white-text">Cerita Dari Penerima Donasi</p>
              <p style="font-size: 0.8rem; text-align: justify;"><?= $kabar['cerita'] ?></p>
            </div>
            <?php else: ?>
              <div class="col m12 s12">
              <p class="center amber darken-3 white-text">Cerita Dari Penerima Donasi</p>
              <p style="font-size: 0.8rem; text-align: justify;"><?= $kabar['cerita'] ?></p>
            </div>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<!-- height:200px; width:100%; overflow : hidden; -->
  <?= $this->endSection(); ?>