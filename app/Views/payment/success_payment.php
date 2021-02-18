<?= $this->extend('layout/template_checkout'); ?>
<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col s12 l8 offset-l2">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
          <img class="activator" src="/img/icon_donatur_tr.png" />
        </div>
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4">Status :
        <?php if($data['status_code'] == 201){
        echo "Pending menunggu pembayaran";
        }else if($data['status_code'] == 200){
        echo "Pembayaran telah kami terima. Terimakasih";
        } ?>
            <i class="material-icons right">more_vert</i>
          </span>
          <p>
            <a href="#"
              >Order id :
              <?= $data['order_id'] ?></a
            >
          </p>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4"
            >Detail information<i class="material-icons right">close</i></span
          >
          <p>
            jumlah :
            <?= $data['gross_amount'] ?>
          </p>
        </div>
        <div class="card-action center">
          <button type="button" class="btn" id="reload">
            Saya sudah bayar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
