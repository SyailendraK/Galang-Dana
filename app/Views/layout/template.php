<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Galang Kebaikan</title>
  <!-- materialize icons, css & js -->
  <link type="text/css" href="/css/materialize.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link type="text/css" href="/css/styles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  <script type="text/javascript" src="/js/materialize.min.js"></script>
  <link rel="manifest" href="/manifest.json">
  <link rel="icon" type="image/gif" href="/img/icon_donatur_tr.png" />
  <!-- IOS Support -->
  <link rel="apple-touch-icon" href="/icons/icon-96x96.png">

  <meta name="apple-mobile-web-app-status-bar" content="#FFFFFF">
  <!-- theme color -->
  <meta name="theme-color" content="#FFFFFF">
</head>

<header>
  <!-- navbar -->
  <?= $this->include('layout/navbar');?>
  <!-- endnavbar -->

  <!-- login modal -->
  <!-- end login modal -->

  <!-- sign up modal -->
  <?= $this->include('layout/signUpModal');?>
  <!-- end sign up modal -->
</header>

<body>
  <!-- body -->
  <?= $this->renderSection('content'); ?>
  <!-- endbody -->

  <!-- deskripsi galang kebaikan -->
  <div class="row mt-3">
    <div class="col l6 s12">
      <div class="pl-5 deskripsi">
        <b class="indigo-text text-darken-4 logo-text">Galang Kebaikan</b>
        <p class="justify">Kami merupakan wadah penampung kebaikan orang-orang baik yang ingin mendonasikan hartanya untuk menolong mereka yang membutuhkan, mari saling membantu karena kebaikan membuat hidup lebih bermakna.</p>
      </div>
    </div>

    <div class="col l2 s4">
      <div class="">
        <h6 class="center-align pb-4">Media Sosial</h6>
        <ul class="ml-40">
          <li>
            <a href="" class=" btn-floating btn-small indigo darken-4" data-tooltip="Instagram">
              <i class="fab fa-instagram"></i>
            </a>
            <span>Instagram</span>
          </li>
          <br>
          <li>
            <a href="" class=" btn-floating btn-small indigo darken-4" data-tooltip="Facebook">
              <i class="fab fa-facebook"></i>
            </a>
            <span>Facebook</span>
          </li>
          <br>
          <li>
            <a href="" class=" btn-floating btn-small indigo darken-4" data-tooltip="Twitter">
              <i class="fab fa-twitter"></i>
            </a>
            <span>Twitter</span>
          </li>
        </ul>
      </div>
    </div>

    <div class="col l2 s4">
      <div class="center-align">
        <h6 class="pb-4">Layanan</h6>
        <p>Donasi Uang</p>
        <p>Donasi Barang</p>
      </div>
    </div>

    <div class="col l2 s4">
      <div class="center-align">
        <h6 class="pb-4">Informasi</h6>
        <p>Tentang Kami</p>
        <p>FAQ</p>
        <p>Syarat Pengguna</p>
      </div>
    </div>

  </div>

  <div class="amber darken-4 center white-text pt-1 pb-1">
    &copy; Copyright Galang kebaikan 2020
  </div>
</body>

<footer class="hide-on-large-only fixed">
  <?= $this->include('layout/navbarMobile');?>
</footer>
    <script src="/js/app15.js"></script>
    <script src="/js/ui.js"></script>
</html>