<?= $this->extend('layout/template_checkout'); ?>

<?= $this->section('content'); ?>

    
    <!-- <form id="payment-form" method="post" action="<?=site_url()?>snap/finish">
      <input type="hidden" name="result_type" id="result-type" value=""></div>
      <input type="hidden" name="result_data" id="result-data" value=""></div>
    </form> -->
    <div class="container">
    <h4 class="center">Pembayaran</h4>
    <div class="row">
    <form id="payment-form" class="col s12" method="POST" action="<?=site_url()?>snap/finish">
      <?= csrf_field(); ?>
      <input type="hidden" name="result_type" id="result-type" value="">
      <input type="hidden" name="result_data" id="result-data" value="">
      <div class="row">
        <div class="input-field col s12">
          <input id="nama" type="text" class="" value="<?= (logged_in()) ? user()->username : null ?>" name="nama">
          <label for="nama" id="labelNama">Nama (Kosong = Anonim)</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="email" id="email" class="" value="<?= (logged_in()) ? user()->email : null ?>" required name="email">
          <label for="email" id="labelEmail">Email (Untuk informasi pembayaran)</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="jumlah" type="number" name="jumlah" class="" required min="1000">
          <label for="jumlah" id="labelJumlah">Jumlah (Min Rp.1.000)</label>
        </div>
      </div>
      <div class="row center-align">
      <a class="waves-effect waves-light btn" id="pay-button">Checkout</a>
      </div>
    </form>
  </div>
    
    
    </div>
    
    <?= $this->endSection(); ?>

