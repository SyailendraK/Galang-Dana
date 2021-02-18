<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Galang Kebaikan</title>
    <!-- materialize icons, css & js -->
    <link type="text/css" href="/css/materialize.min.css" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
      integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
      crossorigin="anonymous"
    />
    <link type="text/css" href="/css/styles.css" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap"
      rel="stylesheet"
    />
    <script type="text/javascript" src="/js/materialize.min.js"></script>
    <script
      type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-QpR_asi_tbIIhfJR"
    ></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="manifest" href="/manifest.json" />
    <link rel="icon" type="image/gif" href="/img/icon_donatur_tr.png" />
    <!-- IOS Support -->
    <link rel="apple-touch-icon" href="/icons/icon-96x96.png" />

    <meta name="apple-mobile-web-app-status-bar" content="#FFFFFF" />
    <!-- theme color -->
    <meta name="theme-color" content="#FFFFFF" />
  </head>

  <header>
    <!-- navbar -->
    <?= $this->include('layout/navbar');?>
    <!-- endnavbar -->

    <!-- login modal -->
    <?= $this->include('layout/loginModal');?>
    <!-- end login modal -->

    <!-- sign up modal -->
    <?= $this->include('layout/signUpModal');?>
    <!-- end sign up modal -->
  </header>

  <body>
    <!-- body -->
    <?= $this->renderSection('content'); ?>
    <!-- endbody -->
  </body>

  <footer class="hide-on-large-only fixed">
    <?= $this->include('layout/navbarMobile');?>
  </footer>
  <script type="text/javascript">
    $("#pay-button").click(function (event) {
      event.preventDefault();
      // $(this).attr("disabled", "disabled");
      let nama = 'Anonim';
      if($("#nama").val() != ''){
        nama = $("#nama").val();
      }
      let jumlah = $("#jumlah").val();
      let email = $("#email").val();

      if (email && jumlah && jumlah >= 1000) {
        $("#labelNama").html("Nama (Kosong = Anonim)");
        $("#labelJumlah").html("Jumlah (Rp.1.000)");
        $("#labelEmail").html("Email (Untuk informasi pembayaran)");
        $.ajax({
          type: "POST",
          url: "<?=site_url()?>snap/token",
          data: { nama: nama, email: email, jumlah: jumlah },
          cache: false,

          success: function (data) {
            //location = data;

            console.log("token = " + data);

            var resultType = document.getElementById("result-type");
            var resultData = document.getElementById("result-data");

            function changeResult(type, data) {
              $("#result-type").val(type);
              $("#result-data").val(JSON.stringify(data));
              //resultType.innerHTML = type;
              //resultData.innerHTML = JSON.stringify(data);
            }

            snap.pay(data, {
              onSuccess: function (result) {
                changeResult("success", result);
                console.log(result.status_message);
                console.log(result);
                $("#payment-form").submit();
              },
              onPending: function (result) {
                changeResult("pending", result);
                console.log(result.status_message);
                $("#payment-form").submit();
              },
              onError: function (result) {
                changeResult("error", result);
                console.log(result.status_message);
                $("#payment-form").submit();
              },
            });
          },
        });
      } else {
        if (!email) {
          $("#labelEmail").html(
            'Email <span class="red-text" style="font-size: 0.7rem"> Tidak boleh kosong</span>'
          );
        } else {
          $("#labelEmail").html("Email");
        }
        if (!jumlah) {
          $("#labelJumlah").html(
            'Jumlah (Rp.1000) <span class="red-text" style="font-size: 0.7rem"> Tidak boleh kosong</span>'
          );
        } else {
          $("#labelJumlah").html("Jumlah (Rp.1000)");
        }
        if (jumlah < 1000) {
          $("#labelJumlah").html(
            'Jumlah (Rp.1000) <span class="red-text" style="font-size: 0.7rem">Minimum donasi Rp.1.000</span>'
          );
        } else {
          $("#labelJumlah").html("Jumlah (Rp.1000)");
        }
      }
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      let reload = document.querySelector("#reload");
      if (reload) {
        reload.addEventListener("click", () => {
          location.reload();
        });
      }
    });
  </script>
  <script src="/js/ui.js"></script>
</html>
