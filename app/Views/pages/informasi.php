<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

  <!-- top informasi -->
  <div class="row">
    <div class="col l9 s12 center-mobile">
      <p class="flow-text ml-4" style="font-size: 2.5rem;">Hidup menjadi bermakna, bila hidup penuh dengan kebaikan, kita berpulang diiringi beribu kasih sayang.</p>
      <p class="ml-4 flow-text">Memberi merupakan kebahagiaan yang tidak sebelah tangan.</p>
    </div>

    <div class="col l3 s12 center">
      <img src="/img/bg_informasi.jpg" alt="" class="pt-4">
    </div>
  </div>

  <!-- how we works -->
  <div class="grey lighten-4">

    <div class="container">
      <p class="center flow-text pt-4">Bagaimana kami bekerja :</p>
      <div class="row">
        <div class="col l4 s12">
          <div class="card">
            <div class="card-image" style="background-color: rgba(0,0,0,0.4);" >
              <img src="/img/icon-informasi-1.png">
              <span class="card-title" style="text-shadow: 2px 2px 2px black;">Pengumpulan dana dari donatur</span>
            </div>
            <div class="card-content justify">
              <p>Dana dikumpulkan dari para donatur untuk nantinya disimpan dan akan langsung disalurkan bila ada pihak yang membutuhkan.</p>
            </div>
          </div>
        </div>

        <div class="col l4 s12">
          <div class="card">
            <div class="card-image" style="background-color: rgba(0,0,0,0.4);">
              <img src="/img/icon-informasi-2.png">
              <span class="card-title" style="text-shadow: 2px 2px 2px black;">Penyaluran bantuan</span>
            </div>
            <div class="card-content justify">
              <p>Bantuan disalurkan dengan teliti melewati tahapan pemfilteran dengan harapan dana yang disalurkan teapt pada yang membutuhkan</p>
            </div>
          </div>
        </div>

        <div class="col l4 s12">
          <div class="card">
            <div class="card-image" style="background-color: rgba(0,0,0,0.4);">
              <img src="/img/icon-informasi-3.png">
              <span class="card-title" style="text-shadow: 2px 2px 2px black;">Laporan penggunaan dana</span>
            </div>
            <div class="card-content justify">
              <p>Penerima donasi akan menyampaikan laporan penggunaan dana yang telah mereka dapatkan dan dapat dilihat pada halaman kabar kebaikan.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?= $this->endSection(); ?>
