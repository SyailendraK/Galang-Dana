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
  <!-- <nav class="nav-wrapper">
    <div class="container">
      <a href="" class="brand-logo">Profile</a>
      <a href="" class="sidenav-trigger" data-target="mobile-menu">
        <i class="material-icons">menu</i>
      </a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#photo's">Photo's</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <ul class="sidenav grey lighten-2" id="mobile-menu">
        <li><a href="">Photo's</a></li>
        <li><a href="">Services</a></li>
        <li><a href="">Contact</a></li>
      </ul>
    </div>
  </nav> -->
  <nav class="z-depth-0 white z-index-1" id="top">
    <div class="nav-wrapper container">
      <a href="/index.html" class="brand-logo indigo-text text-darken-4 logo-text"><b>Dashboard</b></a>
      <a class="left grey-text text-darken-1 hide-on-large-only">
        <i class="material-icons sidenav-trigger" data-target="side-menu">menu</i>
      </a>
      <ul class="right hide-on-med-and-down">
        <li>
          <a href="/pages/profile.html" class="indigo-text text-darken-4">Profile</a>
        </li>
        <li>
          <a href="/pages/Profile/profile_donasi.html" class="indigo-text text-darken-4">Donasi</a>
        </li>
        <li>
          <a href="/pages/Profile/profile_verifikasi.html" class="indigo-text text-darken-4">Verifikasi</a>
        </li>
        <li>
          <a href="/pages/Profile/profile_pengajuan.html" class="indigo-text text-darken-4">Pengajuan</a>
        </li>
        <li>
          <a href="/pages/Profile/profile_pelaporan.html" class="indigo-text text-darken-4">Pelaporan</a>
        </li>
      </ul>
      <ul class="sidenav grey lighten-2" id="side-menu">
        <li>
          <a href="/pages/profile.html" class="indigo-text text-darken-4">Profile</a>
        </li>
        <li>
          <a href="/pages/Profile/profile_donasi.html" class="indigo-text text-darken-4">Donasi</a>
        </li>
        <li>
          <a href="/pages/Profile/profile_verifikasi.html" class="indigo-text text-darken-4">Verifikasi</a>
        </li>
        <li>
          <a href="/pages/Profile/profile_pengajuan.html" class="indigo-text text-darken-4">Pengajuan</a>
        </li>
        <li>
          <a href="/pages/Profile/profile_pelaporan.html" class="indigo-text text-darken-4">Pelaporan</a>
        </li>
      </ul>
    </div>
  </nav>
</header>

<body>
  <h4 class="center">Edit profile</h4>

  <div class="row container">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="name" type="text" class="validate">
          <label for="name">Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <button class="btn amber waves-effect waves-light">Save</button>
    </form>
  </div>
</body>

<script src="/js/ui_profile.js"></script>
<!-- <script src="/js/transaction.js"></script> -->


</html>