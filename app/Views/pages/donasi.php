<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<body>
  <!-- Donasi -->
  <div class="row" id="donasi">
    <div class="col l12 s12 bg-uang">
      <div class="row pt-50">
        <div class="col l6 s12 pl-50">
          <blockquote>
            <h5 class="white-text black-5">Salurkan kebaikanmu tidak perlu bingung
              Donasi berbentuk uang dan akan kami
              Salurkan pada yang membutuhkan</h5>
          </blockquote>
        </div>
        <div class="col l6 s12 pr-50 pt-40">
          <a href="/snap" class="btn btn-large waves-effect waves-light amber darken-3 curved-box right mr-5 btn-donasi">Donasi Uang</a>
        </div>
      </div>
    </div>
    <div class="col l12 s12 bg-barang">
      <div class="row pt-50">
        <div class="col l6 s12 pl-50">
          <blockquote>
            <h5 class="white-text black-5">Banyak barang yang tidak terpakai?
              Donasikan barangmu pada kami
              Untuk kami salurkan kembali</h5>
          </blockquote>
        </div>
        <div class="col l6 s12 pr-50 pt-40">
          <a href="/donasi/donasiBarang" class="btn btn-large waves-effect waves-light amber darken-3 curved-box right mr-5 btn-donasi">Donasi Barang</a>
        </div>
      </div>
    </div>
  </div>

  <div class="grey lighten-4">
    <div class="">
      <div class="row">
        <div class="col l8 s12">
          <div class="pl-5 deskripsi">
            <p class="flow-text justify"> Semua donasi yang masuk akan disalurkan secepatnya dan setepat mungkin kepada orang yang benar-benar membutuhkan, kami akan menyeleksi setiap penerima donasi dengan tahapan yang teliti tapi cepat.
          </div>
        </div>

        <div class="col l4 s12 center mt-4">
          <i class="fas fa-shipping-fast indigo-text text-darken-4" style="font-size: 7rem;"></i>
        </div>
      </div>
    </div>
  </div>

  <?= $this->endSection(); ?>