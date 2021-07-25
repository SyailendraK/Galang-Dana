<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="slider">
  <ul class="slides">
    <li>
      <img
        src="/img/sss-1.jpg"
      />
      <!-- random image -->
      <div class="caption center-align" style="text-shadow: 2px 2px 2px black;">
        <h3>Memberi Seperti Mengasihi Diri Sendiri</h3>
        <h5 class="light grey-text text-lighten-3">"Oranglain adalah saudara yang belum bersua"</h5>
      </div>
    </li>
    <li>
      <img
        src="/img/sss-2.jpg"
      />
      <!-- random image -->
      <div class="caption left-align" style="text-shadow: 2px 2px 2px black;">
        <h3>Menabung Kebaikan Untuk Diri Sendiri</h3>
        <h5 class="light grey-text text-lighten-3">"Setiap pemberian selalu mencorehkan bekas"</h5>
      </div>
    </li>
    <li>
      <img src="/img/sss-3.jpg" />
      <!-- random image -->
      <div class="caption right-align" style="text-shadow: 2px 2px 2px black;">
        <h3>Hebat Karena Berbuat</h3>
        <h5 class="light grey-text text-lighten-3">"Mulai Gerakan Kecil Untuk Hal Yang Besar"</h5>
      </div>
    </li>
  </ul>
</div>

<!-- Total dana -->
<div class="container pt-05">
  <div class="row">
    <div class="col l3 s6">
      <img class="responsive-img small-img" src="/img/icon_bank.jpg" />
      <br />
      <p class="center-align my-0 bold">Donasi Masuk</p>
      <?php 
      $masuk=0;
      $keluar=0;
      foreach ($transaksi as $i) {
        if($i['status_code'] == 200){
          $masuk += $i['gross_amount'];
        }elseif($i['status_code'] == 199){
          $keluar += $i['gross_amount'];
        }
      }
      ?>
      <p class="center-align my-0">Rp.<?= number_format($masuk) ?></p>
    </div>

    <div class="col l3 s6">
      <img class="responsive-img small-img" src="/img/icon_tersalurkan.jpg" />
      <p class="center-align my-0 bold">Total Tersalurkan</p>
      <p class="center-align my-0">Rp.<?= number_format($keluar) ?></p>
    </div>

    <div class="col l3 s6">
      <img class="responsive-img small-img" src="/img/icon_barang.jpg" />
      <p class="center-align my-0 bold">Total Gudang</p>
      <p class="center-align my-0"><?= number_format($gudang) ?></p>
    </div>

    <div class="col l3 s6">
      <img class="responsive-img small-img" src="/img/icon_donatur.jpg" />
      <p class="center-align my-0 bold">Total Donatur</p>
      <p class="center-align my-0"><?= number_format($orang) ?> Orang</p>
    </div>
  </div>
</div>

<!-- card kabar kebaikan -->
<div class="amber lighten-5 pb-2 overflow-x">
  <p
    href="/"
    class="brand-logo indigo-text text-darken-4 logo-text center-align pt-3"
  >
    <b>Kabar Kebaikan</b>
  </p>
  <div class="row">
    <div class="carousel">
      <?php foreach($pengajuan as $i): ?>
      <div class="col l4 s12 carousel-item">
        <a href="/home/detailKabar/1/<?= $i['id'] ?>">
        <div class="card">
          <p class="green center-align white-text my-0">Rp.<?= number_format($i['lap_jumlah']) ?></p>
          <div class="card-image">
            <img src="/img/bukti_laporan/<?= $i['barang'] ?>" class="img-responsive" style="max-height: 300px;min-height: 300px;">
            <span class="card-title" style="text-shadow: 2px 2px 2px black; width: 500px; background-color: rgba(0,0,0,0.5); overflow: hidden;"><?= $i['nama'] ?></span>
            <!-- <a class="btn-floating z-depth-0 halfway-fab waves-effect waves-light green">
              <p>Rp. 2.300.000</p>
            </a> -->
          </div>
          <div class="card-content" style="max-height: 70px;overflow : hidden;
          text-overflow: ellipsis;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
          text-align: justify">
            <p>
              <?= $i['lap_cerita'] ?>
            </p>
          </div>
        </div>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="amber lighten-5 center">
  <a
    class="btn waves-effect waves-light transparent z-depth-0 indigo-text text-darken-3 border-black"
    href="/home/daftarKabar"
  >
    Lihat Semua
  </a>
  <br />
  <br />
</div>

<!-- mari mendaftar -->
<div class="amber darken-2 center">
  <img class="responsive-img" src="/img/icon_donatur_tr.png" alt="" />
  <br />
  <p class="flow-text white-text">Mari Menggalang Kebaikan</p>
  <br />
  <a
    class="btn waves-effect waves-light transparent z-depth-0 border"
    href="/donasi"
  >
    Menjadi Donatur
  </a>
  <br />
  <br />
</div>

<?= $this->endSection(); ?>
