<ul
  class="navbar-nav <?php if(in_groups('admin')){
    echo 'bg-gradient-danger';
  }elseif(in_groups('member')){
    echo 'bg-gradient-primary';
  }else{
    echo 'bg-gradient-success';
  }  ?> sidebar sidebar-dark accordion"
  id="accordionSidebar"
>
  <!-- Sidebar - Brand -->
  <a
    class="sidebar-brand d-flex align-items-center justify-content-center"
    href=""
  >
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-code"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Dashboard</div>
  </a>
<?php if(in_groups('super')): ?>
<!-- Divider -->
<hr class="sidebar-divider my-0" />

<!-- Heading -->
<div class="sidebar-heading">User Management</div>
<!-- Nav Item - My Profile -->
<li class="nav-item">
  <a class="nav-link" href="/dashboardAdmin/userList">
    <i class="fas fa-fw fa-user"></i>
    <span>User List</span></a
  >
</li>
<?php endif; ?>
  <!-- Divider -->
  <hr class="sidebar-divider my-0" />
<br>
  <!-- Heading -->
  <div class="sidebar-heading">User Profile</div>
  <!-- Nav Item - My Profile -->

  <?php if(in_groups('member')): ?>
  <li class="nav-item">
    <a class="nav-link" href="/dashboard">
      <i class="fas fa-fw fa-user"></i>
      <span>My Profile</span></a
    >
  </li>
  <?php else: ?>
    <li class="nav-item">
    <a class="nav-link" href="/dashboardAdmin">
      <i class="fas fa-fw fa-user"></i>
      <span>My Profile</span></a
    >
  </li>
  <?php endif; ?>

  <?php if(in_groups('member')): ?>
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/editProfile">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Edit Profile</span></a
    >
  </li>
  <?php else: ?>
  <li class="nav-item">
    <a class="nav-link" href="/dashboardAdmin/editProfile">
      <i class="fas fa-fw fa-user"></i>
      <span>Edit Profile</span></a
    >
  </li>
  <?php endif; ?>

  <!-- Heading -->
  <?php if(in_groups('member')): ?>
    <hr class="sidebar-divider my-0" />
    <br>
    <div class="sidebar-heading">Pengelolaan</div>

  <li class="nav-item">
    <a class="nav-link" href="/dashboard/statusPengajuan">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Pengajuan Bantuan</span></a
    >
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/pelaporanBantuan">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Pelaporan Bantuan</span></a
    >
  </li>
  <hr class="sidebar-divider my-0" />
  <?php endif; ?>

  <?php if(in_groups('admin')): ?>
    <hr class="sidebar-divider my-0" />
    <br>
    <div class="sidebar-heading">Pengelolaan</div>
  <li class="nav-item">
    <a class="nav-link" href="/dashboardAdmin/kelolaBankKebaikan">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Bank Kebaikan</span></a
    >
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboardAdmin/kelolaGudangKebaikan">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Gudang Kebaikan</span></a
    >
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboardAdmin/daftarVerifikasi">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Verifikasi Member</span></a
    >
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboardAdmin/kelolaPengajuan">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Pengajuan Bantuan</span></a
    >
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboardAdmin/laporanBantuan">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Laporan Bantuan</span></a
    >
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboardAdmin/laporan">
      <i class="fas fa-fw fa-user-edit"></i>
      <span>Laporan Transaksi</span></a
    >
  </li>
  <?php endif; ?>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block" />

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
