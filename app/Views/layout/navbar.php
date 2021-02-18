<nav class="z-depth-0 white z-index-1" id="top">
    <div class="nav-wrapper container">
      <a href="/" class="brand-logo indigo-text text-darken-4 logo-text"><b>Galang Kebaikan</b></a>
      <!-- <a class="right grey-text text-darken-1 hide">
        <i class="material-icons sidenav-trigger" data-target="side-menu">menu</i>
      </a> -->
      <ul class="right hide-on-med-and-down">
        <li>
          <a href="/home" class="indigo-text text-darken-4">Home</a>
        </li>
        <li>
          <a href="/donasi" class="indigo-text text-darken-4">Donasi</a>
        </li>
        <li>
          <a href="/informasi" class="indigo-text text-darken-4">Informasi</a>
        </li>
        <?php if(!logged_in()): ?>
        <li>
          <a href="/login" class="indigo-text text-darken-4">Login</a>
        </li>
        <?php else: ?>
        <li>
        <?php if(in_groups('admin') || in_groups('super')): ?>
          <a href="/dashboardAdmin" class="indigo-text text-darken-4">Dashboard</a>
        <?php else: ?>
          <a href="/dashboard" class="indigo-text text-darken-4">Dashboard</a>
        <?php endif; ?>
        </li>
        <li>
          <a href="/logout" class="indigo-text text-darken-4">Logout</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>