<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    
    <div class="col s12 m12">
      <div class="card">
        <p class="green center-align white-text my-0">Rp.<?= number_format($kabar['jumlah']) ?></p>
        <div class="card-image">
          <img src="/img/<?= ($jenis == 1) ? 'bukti_laporan' : 'fotodiri' ?>/<?= ($jenis == 1) ? $kabar['barang'] : $kabar['fotoDiri'] ?>" class="img-responsive" style="height:500px; width:auto; overflow : hidden;">
          <span class="card-title" style="text-shadow: 2px 2px 2px black; width: 100%; background-color: rgba(0,0,0,0.5); overflow: hidden;" ><?= $kabar['nama'] ?></span>
        </div>
        <div class="card-content" style="max-height: 95px;overflow : hidden;
          text-overflow: ellipsis;
          display: -webkit-box;
          -webkit-line-clamp: 3;
          -webkit-box-orient: vertical;
          text-align: justify">
          <p><?= $kabar['cerita'] ?></p>
        </div>
        <div class="card-action">
          <a href="#">This is a link</a>
        </div>
      </div>
    </div>
  </div>
</div>
<br>

  <?= $this->endSection(); ?>